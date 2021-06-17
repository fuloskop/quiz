<?php

namespace App\Http\Controllers;

use App\Models\Kurum;
use App\Models\Quiz;
use App\Models\Result;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\File;
use ReallySimpleJWT\Token;

use Illuminate\Support\Facades\Validator;

use Session;

class QuizController extends Controller
{

    protected $model;

    public function __construct(Quiz $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        //$quizzes = Quiz::orderByDesc('updated_at')->where('kurum_id', '=', Auth::user()->kurum_id)->paginate(10);
        $query = $this->model->orderByDesc('updated_at')->where('kurum_id', '=', Auth::user()->kurum_id)->with('kurum');

        if($request->search)
        {
            $query = $query->Where('quiz_title','LIKE','%'.$request->search.'%',);
        }
        /*
        if(isset($request->search)){
            $quizzes = Quiz::orderByDesc('updated_at')->where('kurum_id', '=', Auth::user()->kurum_id)
                ->Where('quiz_title','LIKE','%'.$request->search.'%',)->paginate(10);
        }
        */
        $quizzes = $query->paginate(10);
        return view('quiz', compact('quizzes'));
    }

    public function create()
    {


        return view('quiz.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'quiz_title' => 'required|unique:quizzes|max:255',
            'date' => 'nullable|date|after:' . now(),
        ]);

        // Auth::user()->kurum_id; // giriş yapmış kullanıcının kurum id si için
        $isnotuniqe=true;
        while($isnotuniqe){
            $uniqe_id=bin2hex(random_bytes(10));
            if(Quiz::where('uniqe_id', $uniqe_id)->first()==null){
                $isnotuniqe=false;
            }

        }


        Quiz::Create([
            'kurum_id' => Auth::user()->kurum_id,
            'quiz_title' => $request->quiz_title,
            'quiz_finished_at' => $request->date,
            'quiz_description' => $request->quiz_description,
            'uniqe_id' => $uniqe_id,
        ]);


        return redirect('quiz')->with('success', 'Başarılı bir şekilde eklendi.');
    }

    public function edit(Quiz $quiz)
    {
        //return $quiz;
        return view('quiz.edit', compact('quiz'));
    }

    public function update(Quiz $quiz, Request $request)
    {
        $validated = $request->validate([
            'quiz_title' => 'required|max:255|unique:quizzes,quiz_title,' . $quiz->id,
            'date' => 'nullable|date',
            'quiz_status' => 'in:publish,passive,draft',
        ]);


        Quiz::find($quiz->id)->update([
            'quiz_title' => $request->quiz_title,
            'quiz_finished_at' => $request->date,
            'quiz_status' => $request->quiz_status,
            'quiz_description' => $request->quiz_description,
        ]);


        //return $quiz;
        return redirect('quiz')->with('success', 'Başarılı bir şekilde güncellendi.');
    }

    public function destroy($id)
    {
        $quiz = Quiz::find($id);


        foreach ($quiz->questions as $question){
            if(isset($question->image)){
                $oldimg = public_path('files/'.$question->image['img']);
                $delimg=File::delete($oldimg);
            }
        }


        $quiz->delete();

        return redirect('quiz')->with('success', 'Başarılı bir şekilde silindi.');
    }

    public function show(Quiz $quiz)
    {

        return view('quiz.show', compact('quiz'));
    }

    public function check_quiz_page()
    {
        return view('checkquiz');
    }

    public function check_quiz_withform(Request $request)
    {
        $validated = $request->validate([
            'quiz_uniqe_id' => 'required|min:16|max:20',
        ]);

        $quiz = Quiz::where('uniqe_id', $request->quiz_uniqe_id)->firstOrFail();

        session(['quizcode' => $quiz->uniqe_id]);

        return redirect()->route('join', ['quizcode' => $quiz->uniqe_id]);
    }

    public function check_quiz_withlink($quizcode) // /checkcodeurl/{quizcode}
    {
        if (empty($quizcode) || strlen($quizcode)<15 || strlen($quizcode)>20) {
            abort(404);
        }

        $quiz = Quiz::where('uniqe_id', $quizcode)->firstOrFail();

        session(['quizcode' => $quiz->uniqe_id]);

        return redirect()->route('join',['quizcode'=>$quiz->uniqe_id]);
    }

    public function join($quizcode)
    {
        if($quizcode!=session('quizcode')){
            abort(403,'Yetkisiz işlem. Lütfen işlemleri tekrarlayın.');
        }
        return view('join');
    }

    public function getjoinner(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'phone' => 'required|digits_between:10,10|numeric',
            'email' => 'required|email',
        ]);

        $payload = [
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' =>  $request->phone,
            'email' =>  $request->email,
            'ip' => $request->ip()
        ];

        $secret =  config("constant.JTW_SECRET_KEY");

        $token = Token::customPayload($payload, $secret);

        session(['token' => $token]);

        //$sonuc = Token::getPayload($token, $secret);

        return redirect()->route('start',['quizcode'=>session('quizcode'),'token'=>$token]);

    }

    public function start($quizcode,$token)
    {
        if(session('token')!=$token){
            abort(403,'Yetkisiz işlem. Lütfen işlemleri tekrarlayın.');
        }

        $quiz = Quiz::where('uniqe_id', $quizcode)->firstOrFail();

        if($quiz->quiz_status!='publish'){
            return $quiz->quiz_title.' isimli quizini henüz başlamamış.';
        }
        if($quiz->quiz_finished_at<now() && isset($quiz->quiz_finished_at)){
            return $quiz->quiz_title.' isimli quiz '.Carbon::parse($quiz->quiz_finished_at)->diffForHumans().' sonlanmıştır.';
        }

        return view('quizstart', compact('quiz','quizcode','token'));
    }

    public function finish(Request $request,$quizcode,$token)
    {

        if(session('token')!=$token){
            abort(403,'Yetkisiz işlem. Lütfen işlemleri tekrarlayın.');
        }


        $secret =  config("constant.JTW_SECRET_KEY");

        $quiz = Quiz::where('uniqe_id',$quizcode)->first();

        $participant = Token::getPayload($token, $secret);

        $validator = Validator::make($participant, [
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $answers = array($request->post());

        $result = Result::firstOrNew([
                'kurum_id' => $quiz->kurum_id,
                'quiz_uniqe_id' => $quizcode,
                'fullname' => $participant['name'].' '.$participant['surname'],
                'email' => $participant['email'],
                'phone' => $participant['phone']
            ]
        );

        $result->answers = json_encode($answers);

        $result->save();


        return "Sınav işlemi tamamlanmıştır.";
    }
}
