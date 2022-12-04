<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * counts the answers given to a specific question
     * @return integer number of the answers
     */
    public function getAnswersNumber()
    {
        $answers = Answer::where("question_id", $this->id)->get();
        return count($answers);
    }
}
