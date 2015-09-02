<?php

namespace frontend\models;

use Yii;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $homepage;
    public $authKey;
    public $accessToken;

    /***
     * @param int|string $id
     * @return null|static
     */

    public static function findIdentity($id)
    {
        $file = file_get_contents('../data/users.txt');
        $users = (array)json_decode($file);

        foreach ($users as $user) {
            $user = (array)$user;
            if (strcasecmp($user['id'], $id) === 0) {
                return new static($user);
            }
        }

        return null;
    }


    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null){}


    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsernameFromJson($username)
    {
        $file = file_get_contents('../data/users.txt');
        $users = (array)json_decode($file);

        foreach ($users as $user) {
            $user = (array)$user;
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
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

    /**
     * @return array
     */
    public function my_attributes()
    {
        $arr =[];
        $arr['id'] = $this->id;
        $arr['username'] = $this->username;
        $arr['password'] = $this->password;
        $arr['email'] = $this->email;
        $arr['homepage'] = $this->homepage;
        return $arr;
    }

    /**
     *
     * cохранение чата в файлик
     * адрес где лежит файлик прописан frontend/config/params
     *
     * @return bool
     */
    public function save_to_file(){



        if(file_exists('../data/users.txt')){
            $is_arr = json_decode(file_get_contents('../data/users.txt'),true);
            if($is_arr){
                array_push($is_arr, $this->my_attributes());
                file_put_contents('../data/users.txt', json_encode( $is_arr ) );
            }else{
                file_put_contents('../data/users.txt', json_encode( $this->my_attributes() ) );
            }

            return true;
        }
        return false;
    }


    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsernameFromJsonValidate($username, $attribute = false)
    {
        if(!isset($attribute) && !$attribute || empty($attribute))return null;

        $file = file_get_contents('../data/users.txt');
        $users = (array)json_decode($file);

        foreach ($users as $user) {
            $user = (array)$user;
            if (strcasecmp($user[$attribute], $username) === 0) {
                return true;
            }
        }

        return null;
    }

    /**
     * @return int
     */
    public static function findCountUsers()
    {
        $file = file_get_contents('../data/users.txt');
        $users = (array)json_decode($file);
        return count($users);
    }
}
