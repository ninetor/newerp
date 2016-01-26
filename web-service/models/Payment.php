<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $datetime
 * @property integer $amount
 * @property integer $project_id
 *
 * @property Project $project
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'project_id'], 'required'],
            [['description'], 'string'],
            [['datetime'], 'safe'],
            [['amount', 'project_id'], 'integer'],
            [['name'], 'string', 'max' => 450]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'datetime' => 'Datetime',
            'amount' => 'Amount',
            'project_id' => 'Project ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
