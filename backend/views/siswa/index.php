<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SiswaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Siswa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Siswa', ['create'], ['class' => 'btn btn-success']) ?> &nbsp; &nbsp; &nbsp; <?= Html::a('Lihat Daftar Pengajar', ['/pengajar/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'nama',
            'alamat',
            'nomor_hp',
            'email_akun:email',
            //'pendaftaran_id',
            //'jadwal_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
