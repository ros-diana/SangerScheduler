<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MataPelajaran */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mata-pelajaran-view">
<h1>Detail Kelas</h1>
<p>
    <?= Yii::$app->user->identity->isAdmin ? Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) : '' ?>
    <?= Yii::$app->user->identity->isAdmin ? Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) : '' ?>
    </p>

     <div class="box box-solid box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Mata Pelajaran : <?= Html::encode($this->title) ?></h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'nama',
            'jumlah_siswa',
            [
                'label' => 'Harga',
                'value' => 'Rp. ' .$model->harga ,
            ],
            'keterangan:ntext',
            'persyaratan:ntext',
            'durasi_kursus:ntext',
            'materi:ntext',
            'jenis.jenis',
            // 'pengajar.nama',
        ],
    ]) ?>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
  
    
      <div class="box box-solid box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Pengajar</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
        <?= DetailView::widget([
        'model' => $pengajar,
        'attributes' => [
            // 'id',
            'nama',
            'alamat',
            'nomor_hp',
        ],
    ]) ?>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

   

</div>
