<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MataPelajaran */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Mata Pelajarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mata-pelajaran-view">

    <h1 align="center">
      <font color="black"><b>
     <!--  <span class="site-heading-upper text-primary mb-3">Sistem Informasi Rekrutmen Dosen IT Del</span> -->
     <i><?= Html::encode($this->title) ?></i></font></b>
    </h1>
    <p>
        <?= Html::a('Daftar Kelas', ['daftar-kelas', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama',
            'jumlah_siswa',
            'harga',
            'keterangan:ntext',
            'persyaratan:ntext',
            'durasi_kursus:ntext',
            'materi:ntext',
            'pengajar.nama',
        ],
    ]) ?>

    <br><br><br><br><br>


        

</div>
