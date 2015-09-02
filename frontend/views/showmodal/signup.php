<?php
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

Modal::begin([
    'header' => '<h2>Signup</h2>',
    'id' =>'sign-modal'
]);

$form = ActiveForm::begin(['id' => 'signup-form', 'method' =>'post']);
echo $form->field($sign_model, 'username') ;
echo $form->field($sign_model, 'password')->passwordInput();
echo $form->field($sign_model, 'password_repeat')->passwordInput();
echo $form->field($sign_model, 'homepage') ;

echo $form->field($sign_model, 'email') ;
echo Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ;


ActiveForm::end();

Modal::end();