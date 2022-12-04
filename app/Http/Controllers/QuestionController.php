<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function createQuestion(Request $request)
    {
        if($request && $request->questionTitle && $request->questionBody)
        {
            $question = new Question;
            $question->question_title = $request->questionTitle;
            if(!$request->author)
            {
                $question->author_id=0;
            }
            $question->question_body = $request->questionBody;
            $question->save();
            return redirect("/");
        }else
        {
            $_POST["redirected"] = true;
            return redirect("/newQuestion");
        }
    }

    public function deleteQuestion(Request $request)
    {
        if(Question::find($request->id)->delete())
        {
            if(Answer::where("question_id", $request->id)->delete())
            {
                return response()->json(['success'=>true]);
            }
        }
        return response()->json(['success'=>false]);
    }

    public function updateQuestion(Request $request)
    {
        $question = Question::find($request->id);
        if($request->body && $request->title)
        {
            $question->question_title = $request->title;
            $question->question_body = $request->body;
            $question->save();
            return redirect("/");
        }else
        {
            return view("updateQuestion", ["question" => $question]);
        }
    }

    public function index()
    {
        return view('welcome', ['listItems' => Question::all()]);
    }

    public function listAnswers(Request $request)
    {
        $answers = Answer::where("question_id", $request->questionId)->get();
        $question = Question::where("id", $request->questionId)->get();
        return view('questionDetails', ['answers' => $answers, "question" => $question]);
    }

    
}
