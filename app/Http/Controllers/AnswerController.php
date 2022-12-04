<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;

class AnswerController extends Controller
{
    public function createAnswer(Request $request)
    {
        $answer = new Answer;
        $answer->question_id = $request->questionId;
        $answer->author_id = 0;
        $answer->answer_body=$request->answerBody;
        $answer->like_count=0;
        $answer->dislike_count=0;
        $answer->save();
        return redirect("/");
    }

    public function deleteAnswer(Request $request)
    {
        if(Answer::find($request->id)->delete())
        {
            return response()->json(['success'=>true]);
        }
        return response()->json(['success'=>false]);
    }

    public function updateAnswer(Request $request)
    {
        $answer = Answer::find($request->id);
        $question = Question::find($answer->question_id);
        if($request->body)
        {
            $answer->answer_body = $request->body;
            $answer->save();
            return redirect("/");
        }else
        {
            return view("updateAnswer", ["answer" => $answer, "question" => $question]);
        }
    }
    
    public function dislikeAnswerAjax(Request $request)
    {
        $answer = Answer::find($request->id);
        $columnName = $request->type."_count";
        $answer->$columnName += 1;
        if($answer->save())
        {
            return response()->json(['success'=>true, 'id' =>$answer->id ,'type' => $request->type, 'number' => $answer->$columnName]);
        }else{
            return response()->json(['success'=>false]);
        }
        
    }
}
