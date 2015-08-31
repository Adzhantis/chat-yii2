<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property integer $id
 * @property string $message
 * @property integer $userId
 * @property string $updateDate
 */
class Chat extends \yii\db\ActiveRecord {

    public $userModel;
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'chat';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['message'], 'required'],
            [['userId'], 'integer'],
            [['updateDate', 'message'], 'safe']
        ];
    }

    public function getUser() {
        if (isset($this->userModel))
            return $this->hasOne($this->userModel, ['id' => 'userId']);
        else
            return $this->hasOne(Yii::$app->getUser()->identityClass, ['id' => 'userId']);
    }

    /**
     * @inheritdoc
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
        return parent::beforeSave($insert);
    }

    public static function records() {
        return static::find()->orderBy('id desc')->limit(10)->all();
    }

       public static function records2() {
           //Yii::$app->fs->
        return static::find()->orderBy('id desc')->limit(10)->all();
    }


    /**
     * @return string
     */
    public function data() {
        $output = '';
        $i = 0;
        $models = Chat::records();
        if ($models)
            foreach ($models as $model) {

                    if(is_object($model->user)) {
                        $output .= '<div class="chat-box-left">'.$model->message.'</div>
                                <div class="chat-box-name-left">'.$model->user->username.'</div>
                                <hr class="hr-clas" />';
                        $i++;
                    }
            }

        return $output;
    }

    public function to_file(){
        $exists = Yii::$app->fs->has('chat/chat.txt');

        if($exists){
            $is_arr = json_decode(Yii::$app->fs->read('chat/chat.txt'), true);
            if( is_array($is_arr)){
                array_push($is_arr, $this->attributes);
                if(!Yii::$app->fs->put('chat/chat.txt', json_encode($is_arr))){
                    return false;
                }
            }
        }else{
            if(!Yii::$app->fs->put('chat/chat.txt', json_encode($this->attributes))){
                return false;
            }
        }
        return true;
    }

}
