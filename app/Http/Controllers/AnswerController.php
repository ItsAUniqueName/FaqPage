<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;

class AnswerController extends Controller
{
    /**
     * create new answer
     * @param request->questionId question title
     * @param request->answerBody question title
     * author is set to 0 by default because the application doesn't handles users
     * like and dislike is set to 0 by default
     */
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

    /**
     * delete answer
     * @param request->id the id of the answer we want to delete
     */
    public function deleteAnswer(Request $request)
    {
        if(Answer::find($request->id)->delete())
        {
            return response()->json(['success'=>true]);
        }
        return response()->json(['success'=>false]);
    }

    /**
     * update answer
     * @param request->id id of the answer we want to modify
     * @param request->question_id id of the question which we are answering
     * @param request->body body of answer
     * if any of the required values isn't given we return to the update page again
     */
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
    
    /**
     * ajax function handle likes and dislikes
     * @param request->id id of the answer
     * @param request->type type of the like, like or dislike
     * @return array we return that the modification succeeded
     * if modification was successful we return the value of the modified row and the name of the row
     */
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
