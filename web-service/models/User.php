<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $fio
 * @property string $email
 * @property string $image
 * @property integer $hour_price
 * @property string $created
 * @property integer $branch_id
 * @property string $role
 * @property string $auth_key
 * @property string $login
 * @property string $password
 * @property string $access_token
 *
 * @property Chat[] $chats
 * @property ProjectInfoUser[] $projectInfoUsers
 * @property Task[] $tasks
 * @property Branch $branch
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fio', 'email', 'branch_id', 'login', 'password'], 'required'],
            [['hour_price', 'branch_id'], 'integer'],
            [['created'], 'safe'],
            [['role'], 'string'],
            [['fio'], 'string', 'max' => 200],
            [['email'], 'string', 'max' => 100],
            [['image'], 'string', 'max' => 450],
            [['auth_key'], 'string', 'max' => 32],
            [['login', 'password', 'access_token'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Fio',
            'email' => 'Email',
            'image' => 'Image',
            'hour_price' => 'Hour Price',
            'created' => 'Created',
            'branch_id' => 'Branch ID',
            'role' => 'Role',
            'auth_key' => 'Auth Key',
            'login' => 'Login',
            'password' => 'Password',
            'access_token' => 'Access Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectInfoUsers()
    {
        return $this->hasMany(ProjectInfoUser::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
//        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
//        foreach (self::$users as $user) {
//            if ($user['accessToken'] === $token) {
//                return new static($user);
//            }
//        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
//        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }


}
