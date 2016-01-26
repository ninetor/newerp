<?php
namespace app\controllers;

use app\models\Branch;
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
//    public $serializer = [
//        'class' => 'yii\rest\Serializer',
//        'collectionEnvelope' => 'items',
//    ];
    public function behaviors()
    {
//        return
//            \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
//                'corsFilter' => [
//                 [
//        [
//            'class' => Cors::className(),
//            'cors' => [
//                'Origin' => ['http://erp.local'],
//                'Access-Control-Request-Method' => ['GET', 'HEAD', 'OPTIONS'],
//            ],
//        ],
//                ],
//            ]);
        $behaviors = parent::behaviors();
//        $behaviors['contentNegotiator']['formats']['tex'] = Response::FORMAT_JSON;
        $behaviors['corsFilter'] =
            [
                    'class' => Cors::className(),
                    'cors' => [
                        'Origin' => ['http://erp.local'],
                        'Access-Control-Request-Method' => ['GET', 'HEAD', 'OPTIONS'],
                    ],
            ];
        return $behaviors;
    }

    public function actionBranches()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $branches = Branch::find()->asArray()->all();
//        header('Access-Control-Allow-Origin: http://erp.local');
        return $branches;
    }

}