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

class BranchController extends ActiveController
{
    // adjust the model class to match your model
    public $modelClass = 'app\models\Branch';
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] =
            [
                'class' => Cors::className(),
                'cors' => [
                    'Origin' => ['http://erp.local'],
//                        'Access-Control-Request-Method' => ['GET', 'HEAD', 'OPTIONS'],
                ],
            ];
        return $behaviors;
    }

}