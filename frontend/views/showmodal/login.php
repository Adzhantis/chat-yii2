<?php
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

Modal::begin([
    'header' => '<h2>Please Login or Sign up</h2>',
    'id'=>'login-modal',
]);

$form = ActiveForm::begin(['id' => 'login-form', 'method' =>'post']);

echo $form->field($login_model, 'username') ;

echo $form->field($login_model, 'password')->passwordInput();


echo Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ;
echo '<a style="float:right;margin-top: 15px;" href="index.php?r=showmodal/signup">Go to Sign up form</a>';

ActiveForm::end();

Modal::end();