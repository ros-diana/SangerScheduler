<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<?php
if(Yii::$app->session->hasFlash('userStatus'))
    echo \yii\bootstrap\Alert::widget([
        'options' => ['class' => 'alert-warning'],
        'body' => Yii::$app->session->getFlash('userStatus'),
    ]);
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Sanger Scheduler</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <!--        <p class="login-box-msg">Silahkan Sign-in</p>-->

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <!-- /.col -->
            <div class="col-xs-12">
                <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

        <!--        <a href="#">I forgot my password</a><br>-->

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
