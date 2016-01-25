<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_branch_plan".
 *
 * @property integer $id
 * @property integer $branch_id
 * @property integer $project_id
 * @property integer $budget
 * @property integer $hours
 *
 * @property Branch $branch
 * @property Project $project
 */
class ProjectBranchPlan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_branch_plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_id', 'project_id'], 'required'],
            [['branch_id', 'project_id', 'budget', 'hours'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'branch_id' => 'Branch ID',
            'project_id' => 'Project ID',
            'budget' => 'Budget',
            'hours' => 'Hours',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
