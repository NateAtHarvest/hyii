<?php

namespace hyii\models;

use Hyii;
use yii\base\Model;
use yii\debug\models\search\Base;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
        ];
    }

    public function validatePassword($password, $hash)
    {
        return Hyii::$app->getSecurity()->validatePassword($password, $hash);
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $user = User::find()
                ->where(['username' => $this->username])
                ->one();

            if ($user) {
                if ($this->validatePassword($this->password, $user->password)) {
                    $this->_user = $user;
                    Hyii::$app->user->login($user);
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        return false;
    }



}
