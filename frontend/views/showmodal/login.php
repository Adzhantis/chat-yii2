<?php
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


Modal::begin([
    'header' => '<h2>Login</h2>',
    'id'=>'login-modal',
]);

$form = ActiveForm::begin(['id' => 'login-form', 'method' =>'post']);

echo $form->field($login_model, 'username') ;

echo $form->field($login_model, 'password')->passwordInput();


echo Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ;

ActiveForm::end();

Modal::end();