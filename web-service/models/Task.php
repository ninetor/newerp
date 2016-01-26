<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $link
 * @property integer $hours
 * @property string $datetime
 * @property integer $user_id
 * @property integer $project_id
 * @property integer $amount
 *
 * @property Project $project
 * @property User $user
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'user_id', 'project_id'], 'required'],
            [['description'], 'string'],
            [['hours', 'user_id', 'project_id', 'amount'], 'integer'],
            [['datetime'], 'safe'],
            [['name', 'link'], 'string', 'max' => 450]
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
            'link' => 'Link',
            'hours' => 'Hours',
            'datetime' => 'Datetime',
            'user_id' => 'User ID',
            'project_id' => 'Project ID',
            'amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
