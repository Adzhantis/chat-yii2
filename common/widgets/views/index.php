<?php
use yii\widgets\ActiveForm;
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<div class="container">
    <div class="row pad-top pad-bottom">


        <div class=" col-lg-6 col-md-6 col-sm-6">
            <div class="chat-box-div">
                <div class="chat-box-head">
                    GROUP CHAT HISTORY

                </div>
                <div class="panel-body chat-box-main" id="chat-box">
                    <?php echo $data;?>
                </div>

                <div class="chat-box-footer">
                            <div class="input-group">

                                <?php $form = ActiveForm::begin([ 'action'=>['/site/upload'],'options' => ['enctype' => 'multipart/form-data']]) ?>

                                <?= $form->field($upload_model, 'file')->fileInput() ?>

                                <button>Отправить</button>

                                <?php ActiveForm::end() ?>
                            </div>
                    <div class="input-group" style="bottom: 50px;">
                                <input name="Chat[message]" id="chat_message" placeholder="Type message..." class="form-control">
                                <div class="input-group-btn">
                                    <button class="btn btn-success btn-send-comment" data-url="<?=$url;?>" data-model="<?=$userModel;?>">
                                        <i class="fa fa-plus"></i></button>
                                </div>
                                </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>