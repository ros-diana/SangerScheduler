<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model backend\models\form\MataPelajaranAddForm */
/* @var $form yii\widgets\ActiveForm */
?>



<?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]); ?>

<div class="container-fluid">
    <div class="header-container"></div>
      <div class="col-md-8">
        <div class="panel box box-primary">
            <div class="box-header with-border">

                <div class="row">
                    <div class="col-md-12">
                        <?= Form::widget([
                            'model' => $model,
                            'form' => $form,
                            'columns' => 1,
                            'attributes' => [
                                'nama' => [
                                    'type' => Form::INPUT_TEXT,
                                    'options' => [
                                        'maxlength' => true,
                                    ],
                                ],
                            ],
                        ]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                    <?= Form::widget([
                        'model' => $model,
                        'form' => $form,
                        'attributes' => [
                            'jenis_id' => [
                                'type'=>Form::INPUT_WIDGET,
                                'widgetClass'=>'\kartik\widgets\Select2',
                                'options'=>[
                                    'data'=> \backend\models\JenisKelas::getKelasList(),
                                    'options' => ['placeholder' => 'Pilih Jenis Kelas'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                ],
                            ],
                        ]
                    ]) ?>
                    </div>
                    <div class="col-md-6">
                    <?= Form::widget([
                        'model' => $model,
                        'form' => $form,
                        'attributes' => [
                            'pengajar_id' => [
                                'type'=>Form::INPUT_WIDGET,
                                'widgetClass'=>'\kartik\widgets\Select2',
                                'options'=>[
                                    'data'=> \backend\models\Pengajar::getPengajarList(),
                                    'options' => ['placeholder' => 'Pilih Pengajar'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                ],
                            ],
                        ]
                    ]) ?>
                    </div>
                </div>
  
                <div class="row">
                    <div class="col-md-6">
                       <?= $form->field($model, 'jumlah_siswa', [
                                'addon' => ['append' => ['content'=>'Orang']]
                           ]);
                        ?>
                    </div>
                    <div class="col-md-6">
                    <?= Form::widget([
                            'model' => $model,
                            'form' => $form,
                            'columns' => 1,
                            'attributes' => [
                                'harga' => [
                                    'type' => Form::INPUT_TEXT,
                                    'options' => [
                                        'maxlength' => true,
                                        'placeholder' => 'Rp.'
                                    ],
                                ],
                            ],
                        ]) ?>
                    </div>
                </div>

                 <div class="row">
                
                    <div class="col-md-12">
                    <?= Form::widget([
                            'model' => $model,
                            'form' => $form,
                            'columns' => 1,
                            'attributes' => [
                                'durasi_kursus' => [
                                    'type' => Form::INPUT_TEXT,
                                    'options' => [
                                        'maxlength' => true,
                                    ],
                                ],
                            ],
                        ]) ?>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                       
                    <?= Form::widget([       // 1 column layout
                            'model'=>$model,
                            'form'=>$form,
                            'columns'=>1,
                            'attributes'=>[
                                'persyaratan'=>[
                                    'type'=>Form::INPUT_TEXTAREA,
                                    'options' => [
                                        'rows' => 2,
                                    ]
                                ],
                            ]
                        ]) ?>

                        <?= Form::widget([       // 1 column layout
                            'model'=>$model,
                            'form'=>$form,
                            'columns'=>1,
                            'attributes'=>[
                                'keterangan'=>[
                                    'type'=>Form::INPUT_TEXTAREA,
                                    'options' => [
                                        'rows' => 2,
                                    ]
                                ],
                            ]
                        ]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                       
                        <?= Form::widget([       // 1 column layout
                            'model'=>$model,
                            'form'=>$form,
                            'columns'=>1,
                            'attributes'=>[
                                'materi'=>[
                                    'type'=>Form::INPUT_TEXTAREA,
                                    'options' => [
                                        'rows' => 2,
                                    ]
                                ],
                            ]
                        ]) ?>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>