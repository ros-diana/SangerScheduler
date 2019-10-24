<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Tambah Pengajar';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">

    <div class="col-md-6">
        <h2><?= Html::encode($this->title) ?></h2>
        <div class="panel box box-primary">
            <div class="box-header with-border">

            <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput()?>

                 <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

             <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

                 <?= $form->field($model, 'nomor_hp')->textInput(['maxlength' => true]) ?>


            <div class="form-group">
                <?= Html::submitButton('Tambah', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>

</div>
