<?php
namespace console\controllers;
 
use Yii;
use yii\console\Controller;
use common\models\Mailer;
 
 
class SendController extends Controller
{
    public $defaultAction = 'mail';
 
    public function actionMail(){    
        $model = new Mailer();
        $model->sendEmail(); 
        return 0;
    }
}