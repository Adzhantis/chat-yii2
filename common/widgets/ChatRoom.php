<?php

/**
 * @link https://github.com/sintret/yii2-chat-adminlte
 * @copyright Copyright (c) 2015 Andy fitria <sintret@gmail.com>
 * @license MIT
 */

namespace common\widgets;

use Yii;
use yii\base\Widget;
use frontend\models\Chat;
use frontend\assets\ChatJs;
use frontend\models\UploadForm;
use yii\web\BadRequestHttpException;
use League\Flysystem\AdapterInterface;
/**
 * Class ChatRoom
 * @package common\widgets
 */
class ChatRoom extends Widget {

    public $sourcePath = '@vendor/sintret/yii2-chat-adminlte/assets';
    public $css = [
    ];
    public $js = [ // Configured conditionally (source/minified) during init()
        'js/chat.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
    public $models;
    public $url;
    public $userModel;
    public $model;

    public function init() {
        $this->model = new Chat();
        if ($this->userModel === NULL) {
            $this->userModel = Yii::$app->getUser();
        }

        $this->model->userModel = $this->userModel;

        parent::init();
    }

    public function run() {
        parent::init();
        ChatJs::register($this->view);
        $model =        new Chat();
        $upload_model = new UploadForm();
        $model->userModel = $this->userModel;
        $data = $model->data();
        return $this->render('index', [
                    'data' => $data,
                    'url' => $this->url,
                    'userModel' => $this->userModel,
                    'upload_model' => $upload_model,
        ]);
    }

    /**
     * @param $post
     */
    public static function sendChat($post) {


        if (isset($post['message']))
            $message = $post['message'];

        if (isset($post['model']))
            $userModel = $post['model'];
        else
            $userModel = Yii::$app->getUser()->identityClass;

        $model = new Chat;
        $model->userModel = $userModel; 

        if ($message) {
            $model->message = $message;
            $model->userId = Yii::$app->user->id;

            /**
             * сохраняем сообщения в frontend/web/files/chat/chat.txt
             */
            if (Yii::$app->fs->getVisibility('chat/chat.txt') === AdapterInterface::VISIBILITY_PRIVATE) {
                Yii::$app->fs->setVisibility('chat/chat.txt', AdapterInterface::VISIBILITY_PUBLIC);
            }
            if(!$model->to_file()){
                throw new BadRequestHttpException("can't save messages to file", 405);
            }

            if ($model->save()) {
                echo $model->data();
            } else {
                print_r($model->getErrors());
                exit(0);
            }
        } else {
            echo $model->data();
        }
    }
}
