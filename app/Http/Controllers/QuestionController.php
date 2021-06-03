<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{

    public function create(Quiz $quiz)
    {

        return view('question.create', compact('quiz'));
    }

    public function store(Quiz $quiz,Request $request)
    {
        if(Auth::user()->kurum_id!=$quiz->kurum_id)
        {abort(401, 'Yetkisiz işlem');}

        $validated = $request->validate([
            'question_title' => 'required|max:255',
            'chose1' => 'required|max:255',
            'chose2' => 'required|max:255',
            'chose3' => 'required|max:255',
            'chose4' => 'required|max:255',
            'answer'=> 'required',
        ]);

        Question::create([
            'quiz_id' => $quiz->id,
            'question_title' => $request->question_title,
            'chose1' => $request->chose1,
            'chose2' => $request->chose2,
            'chose3' => $request->chose3,
            'chose4' => $request->chose4,
            'answer'=> $request->answer,
        ]);

        return redirect()->route('question.index',$quiz->id)->with('success', 'Başarılı bir şekilde soru eklendi.');;
    }

    public function index(Quiz $quiz)
    {
        $quiz = Quiz::with('questions')->find($quiz->id);

        //return $quiz;

        return view('question.index', compact('quiz'));
    }

    public function destroy(Quiz $quiz,Question $question)
    {
        if (Result::where('quiz_uniqe_id', '=', $quiz->uniqe_id)->count() > 0) {
            return redirect()->route('question.index',$quiz->id)->with('error', 'Soru silinemez. Bu sınava ait sonuç var.');
        }

        $question->delete();

        return redirect()->route('question.index',$quiz->id)->with('success', 'Başarılı bir şekilde soru silindi.');
    }

    public function edit(Quiz $quiz,Question $question)
    {
        return view('question.edit', compact('quiz','question'));
    }

    public function update(Quiz $quiz,Question $question,Request $request)
    {
        $validated = $request->validate([
            'question_title' => 'required|max:255',
            'chose1' => 'required|max:255',
            'chose2' => 'required|max:255',
            'chose3' => 'required|max:255',
            'chose4' => 'required|max:255',
            'answer'=> 'required',
        ]);


        Question::find($question->id)->update($request->post());
        return redirect()->route('question.index',$quiz->id)->with('success', 'Başarılı bir şekilde soru değiştirildi.');
    }

    public function ChangeOrder(Request $request)
    {
        //$questions = Question::findMany($request['names']);

        $count = 1;
        foreach ($request->names as $name){
            Question::find($name)->update(['order' => $count]);
            $count++;
        }
        return 'success';

        $placeholders = implode(',',array_fill(0, count($request['names']), '?')); // string for the query

        $questions = Question::whereIn('id', $request['names'])
            ->orderByRaw("field(id,{$placeholders})", $request['names'])->get();

        foreach($request['names'] as $key => $question_id){
            $neworder = [
                'order' => $key,
            ];
            Question::find($question_id)->update($neworder);
        }

        return 'success';
    }
}
