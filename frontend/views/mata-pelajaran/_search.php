<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MataPelajaranSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mata-pelajaran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'jumlah_siswa') ?>

    <?= $form->field($model, 'harga') ?>

    <?= $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'persyaratan') ?>

    <?php // echo $form->field($model, 'durasi_kursus') ?>

    <?php // echo $form->field($model, 'materi') ?>

    <?php // echo $form->field($model, 'jenis_id') ?>

    <?php // echo $form->field($model, 'pengajar_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
