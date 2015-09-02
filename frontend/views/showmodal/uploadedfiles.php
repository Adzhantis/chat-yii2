<?php
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

Modal::begin([
    'header' => '<h2>Uploaded Files</h2>',
    'id' =>'uploadedfiles-modal'
]);

$path = '/files/';
foreach($contents as $k){
   $str =  $k['type']=='file' ? '<a href="'.$path.$k['basename'].'" download> '.$k['basename'].'</a><br>':'';
    echo $str;
}

Modal::end();?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    console.log(window.hostname);
    $('#uploadedfiles-modal').on('hide.bs.modal', function (e) {
        alert(window.location.hash.toString());
        window.location = 'google.com';
        console.log(window.hostname);
    });
</script>