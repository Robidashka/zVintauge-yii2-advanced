<?php

namespace common\widgets;

use Yii;
use yii\base\Widget;
use common\models\Subscription;

class SubscriptionWidget extends Widget 
{
    public $subscription;

    public function init() 
    {
        $this->subscription = new Subscription();        
    }
    public function run() 
    {
    return $this->render('subscription',[
            'subscription' => $this->subscription,            
        ]);
    }
}