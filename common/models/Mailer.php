<?php

namespace common\models;

use Yii;
use common\models\Article;

class Mailer extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'mailer';
    }

    public function rules()
    {
        return [
            [['post_slug', 'subscriber_id'], 'required'],
            [['subscriber_id', 'post_id'], 'integer'],
            [['end'],'boolean'],
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
        $query = Mailer::find()->limit(1)->orderBy('post_id DESC')->all();
        $last_subscribe = $query[0];
        // echo '<pre>';
        // var_dump($query);die;
        if ($last_subscribe->end == 1 || count($last_subscribe) == 0) {
            $last_post = $last_subscribe->post_id or $last_post = 0;
            $post = Article::find()->limit(1)->where(['>', 'id', $last_post])->andWhere(['status' => 1])->all();

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
            $this->sendEmail($sub->email, $last_subscribe->post_id);
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

    public function sendEmail($email,$post_id)
    {
        $home_url = 'http://zvintauge-yii2-advanced';
        $article = Article::find()->where(['post_id'=>$post_id])->one();
        $post_url = $home_url.'/article/view?slug='. $article->slug;
        $msg = "Hello! You have subscribed to receive notifications about new articles on the $home_url site. We inform you that a new article has been published. To view go to $post_url";
        $msg_html  = "<html><body style='font-family:Arial,sans-serif;'>";
        $msg_html .= "<h3 style='font-weight:bold;border-bottom:1px dotted #ccc;'>Hello! You are subscribed to receive notifications about new articles on the site " . $home_url . "</h3>\r\n";
        $msg_html .= "<p><strong>We inform you that a new article has been published. To view go to </strong><a href='". $post_url ."'>$post_url</a></p>\r\n";
        $msg_html .= "</body></html>";
        Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo($email) 
            ->setSubject('New article notification')
            ->setTextBody($msg)
            ->setHtmlBody($msg_html)
            ->send();    
    }
}