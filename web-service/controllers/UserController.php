<?php
namespace app\controllers;

use app\models\Branch;
use app\models\User;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\Response;

class UserController extends ActiveController
{
    // adjust the model class to match your model
    public $modelClass = 'app\models\User';
    public function behaviors()
    {
        $behaviors = parent::behaviors();
//        $behaviors['corsFilter'] =
//            [
//                    'class' => Cors::className(),
//                    'cors' => [
//                        'Origin' => ['http://erp.local'],
//                        'Origin' => ['*'],
//                        'Access-Control-Request-Method' => ['GET', 'HEAD', 'OPTIONS'],
//                    ],
//            ];

        $behaviors['cors'] = [ 'class' => Cors::className() ];
        return $behaviors;
    }
    protected function verbs()
    {
        $verbs = parent::verbs();
        $verbs['roles'] = ['GET', 'HEAD'];
        return $verbs;
    }


    public function actionRoles()
    {
        return [];
    }

}