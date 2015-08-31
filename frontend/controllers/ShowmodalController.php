<?php
namespace frontend\controllers;

use Yii;
use frontend\models\LoginForm;
use frontend\models\SignupForm;
use yii\web\Controller;

/**
 * ShowModal controller
 */
class ShowmodalController extends Controller
{

    /**
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    function actionSignup(){

        $sign_model = new SignupForm();
        if ($sign_model->load(Yii::$app->request->post())) {
            if ($user = $sign_model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
            $js='$("#sign-modal").modal("show")';
            $this->getView()->registerJs($js);

            return $this->render('signup',['sign_model' => $sign_model]);
    }

    /**
     * @return string
     */
    function actionLogin(){

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $login_model = new LoginForm();
        if ($login_model->load(Yii::$app->request->post()) && $login_model->login()) {
            return $this->goBack();
        } else {
            $js='$("#login-modal").modal("show")';
            $this->getView()->registerJs($js);

            return $this->render('login',['login_model' => $login_model]);
        }
    }

    function actionUploadedfiles(){

            $js='$("#uploadedfiles-modal").modal("show");
            $("#uploadedfiles-modal").on("hide.bs.modal", function (e) {
                     window.location.href = "../";
                });';
            $this->getView()->registerJs($js);

            $contents = Yii::$app->fs->listContents();

            return $this->render('uploadedfiles', ['contents'=>$contents]);
    }

}