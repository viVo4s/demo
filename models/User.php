<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $phone
 * @property string $fio
 * @property string $email
 * @property int $role
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role'], 'default', 'value' => 0],
            [['username', 'password', 'phone', 'fio', 'email'], 'required'],
            [['role'], 'integer'],
            [['username', 'password', 'phone', 'fio', 'email'], 'string', 'max' => 100],
            ['username', 'unique', 'message' => 'логин занят'],
            ['username', 'match', 'pattern' => '/^[A-z0-9]*$/u'],
            ['fio', 'match', 'pattern' => '/^[А-яЁё - ]*$/u'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'password' => 'Пароль',
            'phone' => 'Номер телефона',
            'fio' => 'ФИО',
            'email' => 'Почта',
            'role' => 'Role',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }

    public function beforeSave($insert)
    {
        $this->password = md5($this->password);
        return parent::beforeSave($insert);
    }

    public function validatePassword($password)
    {
        return md5($password) == $this->password;
    }

    public function isAdmin()
    {
        return $this->role == 1;
    }
}
