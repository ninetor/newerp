<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property integer $id
 * @property string $name
 * @property integer $active
 * @property string $estimate_url
 * @property integer $hourly_payment
 * @property integer $budget
 * @property string $description
 * @property string $created
 * @property string $customer_info
 * @property integer $archive
 * @property integer $product_id
 * @property integer $total_amount
 *
 * @property Expense[] $expenses
 * @property Payment[] $payments
 * @property Product $product
 * @property ProjectBranchPlan[] $projectBranchPlans
 * @property ProjectInfo[] $projectInfos
 * @property Task[] $tasks
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'product_id', 'total_amount'], 'required'],
            [['active', 'hourly_payment', 'budget', 'archive', 'product_id', 'total_amount'], 'integer'],
            [['description', 'customer_info'], 'string'],
            [['created'], 'safe'],
            [['name'], 'string', 'max' => 450],
            [['estimate_url'], 'string', 'max' => 400]
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
            'active' => 'Active',
            'estimate_url' => 'Estimate Url',
            'hourly_payment' => 'Hourly Payment',
            'budget' => 'Budget',
            'description' => 'Description',
            'created' => 'Created',
            'customer_info' => 'Customer Info',
            'archive' => 'Archive',
            'product_id' => 'Product ID',
            'total_amount' => 'Total Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenses()
    {
        return $this->hasMany(Expense::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBranchPlans()
    {
        return $this->hasMany(ProjectBranchPlan::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectInfos()
    {
        return $this->hasMany(ProjectInfo::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['project_id' => 'id']);
    }
}
