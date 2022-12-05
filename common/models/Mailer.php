<?php

namespace common\models;

use Yii;
use common\models\Article;

class Mailer extends \yii\db\ActiveRecord
{
    public $agree = true;

    public static function tableName()
    {
        return 'mailer';
    }

    public function rules()
    {
        return [
            [['post_id', 'subscriber_id'], 'required'],
            [['post_id', 'subscriber_id'], 'integer'],
            [['agree'], 'unique'],
            [['end', 'agree'],'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'subscriber_id' => 'Subscriber ID',
            'end' => 'End',
        ];
    }

    public function send()
    {
        $query = $this->find()->limit(1)->orderBy('post_id DESC')->all();
        $last_subscribe = $query[0];

        if ($last_subscribe->end == 1 or count($last_subscribe) == 0) {
            $last_post = $last_subscribe->post_id or $last_post = 0;
            $post = Article::find()->limit(1)->where(['>', 'id', $last_post])->andWhere(['status' => self::ARTICLE_POSTED])->all();

            if (!$post) exit;
            $this->post_id = $post[0]->id;
            $this->subscriber_id = 0;
            $this->end = 0;
            $this->save();
            exit;
        }

        $last_id = $last_subscribe->subscriber_id;
        $subscriptions = Subscription::find()->where(['>', 'id', $last_id])->all();
        $max_count = count($subscriptions);

        if ($max_count > 10) $max_count = 10;
        foreach ($subscriptions as $key => $sub){
            $subscriber_id = $sub->id;
            $this->sendSub($sub->email, $last_subscribe->post_id);
            if ($key >= ($max_count-1)) {
                $send_subscr = self::findOne($last_subscribe->id);
                $send_subscr->subscriber_id = $subscriber_id;
                $send_subscr->update();
                break;
            }
        }

        if(count($subscriptions) <= $max_count){
            $send_subscr = self::findOne($last_subscribe->id);
            $send_subscr->end = 1;
            $send_subscr->update();
        }    
    }

    public static function sendEmail()
    {
        Yii::$app->mailer->compose()
        ->setTo('test@mail.ru')
        ->setFrom(Yii::$app->params['adminEmail'])
        ->setSubject('test')
        ->setTextBody('test')
        ->send();
    }
}