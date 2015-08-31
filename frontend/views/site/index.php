<?php

$this->title = 'Chat';

if (!\Yii::$app->user->isGuest) {

    echo \common\widgets\ChatRoom::widget([
        'url' => \yii\helpers\Url::to(['/site/send']),
        'userModel' => frontend\models\User::className()
    ]);

}
