<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    public function index()
    {
        $results = Result::orderByDesc('updated_at')->where('kurum_id', '=', Auth::user()->kurum_id)->paginate(10);



        return view('results.index', compact('results'));
    }

    public function show($id)
    {
        //return Question::find(276)->GetCorrectAnswer();

        $result = Result::findOrFail($id);

        $quiz = Quiz::where('uniqe_id',$result->quiz_uniqe_id)->first();

        $questions = $quiz->Questions;

        $totalquestions = $questions->count();
        $correct = 0;

        $answers = json_decode($result->answers, true);



        foreach ($answers[0] as $keys => $answer){

            if(Question::find($keys)->GetCorrectAnswer() == $answer)
                $correct++;

        }
        $finalescore = $correct/$totalquestions*100;
        //return $finalescore;



       //dd($answers[0][323]);

        return view('results.show',compact('finalescore','questions','quiz','answers','correct','totalquestions','result'));
    }
}
