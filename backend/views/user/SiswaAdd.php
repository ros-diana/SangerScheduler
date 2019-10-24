<?php

use yii\helpers\Html;
use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm
use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model backend\models\form\SiswaAddForm */

$this->title = 'Tambah Siswa';
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

                 <?= Form::widget([
                        'model' => $model,
                        'form' => $form,
                        'attributes' => [
                            'mapel_id' => [
                                'type'=>Form::INPUT_WIDGET,
                                'widgetClass'=>'\kartik\widgets\Select2',
                                'options'=>[
                                    'data'=> \backend\models\MataPelajaran::getMapelList(),
                                    'options' => ['placeholder' => 'Pilih Mata Pelajaran'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                ],
                            ],
                        ]
                    ]) ?>


            <div class="form-group">
                <?= Html::submitButton('Tambah', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>

</div>
