<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_info_user".
 *
 * @property integer $id
 * @property integer $project_info_id
 * @property integer $user_id
 *
 * @property ProjectInfo $projectInfo
 * @property User $user
 */
class ProjectInfoUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_info_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_info_id', 'user_id'], 'required'],
            [['project_info_id', 'user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_info_id' => 'Project Info ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectInfo()
    {
        return $this->hasOne(ProjectInfo::className(), ['id' => 'project_info_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
