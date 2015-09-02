<?php
namespace frontend\models;


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
    public $password_repeat;
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
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'validateUsername'],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'validateEmail'],

            ['homepage', 'filter', 'filter' => 'trim'],
            ['homepage', 'match', 'pattern'=>'/[a-zA-Z0-9:\/]+$/'],
            ['homepage', 'string', 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
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
            $user->id = 1 + User::findCountUsers();
            $user->username = $this->username;
            $user->email =    $this->email;
            $user->password = $this->password;

           // if ($user->save()) {
           //     return $user;
            //}
            if ($user->save_to_file()) {
                return $user;
            }
        }

        return null;
    }


    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateUsername($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user_username = User::findByUsernameFromJsonValidate($this->username,'username');

            if ($user_username) {
                $this->addError($attribute, 'This username has already been taken.');
            }
        }
    }
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user_email = User::findByUsernameFromJsonValidate($this->email,'email');

            if($user_email){
                $this->addError($attribute,  'This email address has already been taken.');
            }
        }
    }
}
