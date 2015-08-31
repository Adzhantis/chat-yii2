<?php
namespace frontend\models;

use frontend\models\User;
use yii\base\Model;
use Yii;
use \yii\web\NotFoundHttpException;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $homepage;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'match', 'pattern'=>'/[a-zA-Z0-9]+$/'],
            ['username', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'This email address has already been taken.'],

            ['homepage', 'filter', 'filter' => 'trim'],
            ['homepage', 'match', 'pattern'=>'/[a-zA-Z0-9-_.]+$/'],
            ['homepage', 'string', 'max' => 255],
            ['homepage', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'This homepage address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email =    $this->email;
            $user->password = $this->password;

            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
