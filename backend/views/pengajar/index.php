<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PengajarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'DaftarPengajar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengajar-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Pengajar', ['create'], ['class' => 'btn btn-success']) ?> &nbsp; &nbsp; <?= Html::a('Lihat Daftar Siswa', ['/siswa/index'], ['class' => 'btn btn-success']) ?>
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
