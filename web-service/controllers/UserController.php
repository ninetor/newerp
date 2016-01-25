<?php
namespace app\controllers;

use yii\rest\ActiveController;

class UserController extends ActiveController
{
    // adjust the model class to match your model
    public $modelClass = 'app\models\User';

    public function behaviors()
    {
        return
            \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
                'corsFilter' => [
                    'class' => \yii\filters\Cors::className(),
                ],
            ]);
    }
}