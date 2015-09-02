<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
/**
 * This is the model class for table "chat".
 *
 * @property integer $id
 * @property string $message
 * @property integer $userId
 * @property string $updateDate
 *
 */
class Chat extends Model {

    public $userModel;
    public $message;
    public $userId;
    public $updateDate;

    /**
     * @return array
     */
    public function rules() {
        return [
            [['message'], 'required'],
            [['userId'], 'integer'],
            [['updateDate', 'message'], 'safe']
        ];
    }

    /**
     * @return mixed
     */
    public function getUser() {
        if (isset($this->userModel))
            return $this->hasOne($this->userModel, ['id' => 'userId']);
        else
            return $this->hasOne(Yii::$app->getUser()->identityClass, ['id' => 'userId']);
    }

    /**
     * @return array
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'message' => 'Message',
            'userId' => 'User',
            'updateDate' => 'Update Date',
        ];
    }

    public function beforeSave($insert) {
        $this->userId = Yii::$app->user->id;
        $this->updateDate = date('Y-m-d H:i:s');
        return parent::beforeSave($insert);
    }
    /**
     * @return array
     */
    public function my_attributes()
    {
        $arr =[];
        $arr['userId'] = $this->userId;
        $arr['updateDate'] = date('Y-m-d H:i:s');
        $arr['message'] = $this->message;
        return $arr;
    }
    /**
     *
     * cохранение чата в файлик
     *
     *
     * @return bool
     */
    public function save_to_file(){
        if(file_exists('../data/chat.txt')){
            $is_arr = json_decode(file_get_contents('../data/chat.txt'),true);
                array_push($is_arr, $this->my_attributes());
                file_put_contents('../data/chat.txt', json_encode( $is_arr ) );
            return true;
        }
        return false;
    }

    /**
     * @return string
     */
    public function data_from_file(){

        $output = '';
        if(file_exists('../data/chat.txt')){
            $is_arr = json_decode(file_get_contents('../data/chat.txt'),true);
            if ($is_arr)
                foreach ($is_arr as $model) {
                        $output .= '<div class="chat-box-left">'.$model["message"].'</div>
                                <div class="chat-box-name-left">'.User::findIdentity($model["userId"])->username.'</div>
                                <hr class="hr-clas" />';
                }

            return $output;
        }
    }
}
