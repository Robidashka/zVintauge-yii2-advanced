<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Comment;

class CommentForm extends Model
{
    public $comment;
    
    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string', 'length' => [3,250]]
        ];
    }

    public function saveComment($article_id, $textComment)
    {
        $comment = new Comment;
        $comment->text = $textComment;
        $comment->user_id = Yii::$app->user->id;
        $comment->article_id = $article_id;
        $comment->status = 0;
        $comment->date = date('Y-m-d');
        if ($comment->save()) {
            return $comment;
        }
    }
}