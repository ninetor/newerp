<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $created
 * @property integer $branch_id
 *
 * @property Branch $branch
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'branch_id'], 'required'],
            [['text'], 'string'],
            [['created'], 'safe'],
            [['branch_id'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'created' => 'Created',
            'branch_id' => 'Branch ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }
}
