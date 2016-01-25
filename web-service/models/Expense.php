<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expense".
 *
 * @property integer $id
 * @property string $name
 * @property integer $amount
 * @property string $description
 * @property string $datetime
 * @property integer $project_id
 *
 * @property Project $project
 */
class Expense extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expense';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'project_id'], 'required'],
            [['amount', 'project_id'], 'integer'],
            [['description'], 'string'],
            [['datetime'], 'safe'],
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
            'amount' => 'Amount',
            'description' => 'Description',
            'datetime' => 'Datetime',
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
