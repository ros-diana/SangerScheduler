<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MataPelajaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="daftar-kelas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jumlah_siswa')->textInput() ?>

    <?= $form->field($model, 'harga')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'persyaratan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'durasi_kursus')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'materi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'jenis_id')->textInput() ?>

    <?= $form->field($model, 'pengajar_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
