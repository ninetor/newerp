<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property integer $id
 * @property string $message
 * @property string $update_date
 * @property integer $user_id
 *
 * @property User $user
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message', 'user_id'], 'required'],
            [['message'], 'string'],
            [['update_date'], 'safe'],
            [['user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => 'Message',
            'update_date' => 'Update Date',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
