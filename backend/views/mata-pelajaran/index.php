<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MataPelajaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Kelas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mata-pelajaran-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Yii::$app->user->identity->isAdmin ? Html::a('Tambah Mata Pelajaran', ['mata-pelajaran-add'], ['class' => 'btn btn-success']) : ''?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'nama',
            // 'jumlah_siswa',
            // 'keterangan:ntext',
            //'persyaratan:ntext',
            //'durasi_kursus:ntext',
            //'materi:ntext',
            'jenis.jenis',
            'pengajar.nama',

            [
                'label' => 'Action',
                'format' => 'raw',
                'value' => function($model, $key, $index, $column) {
                    return Html::a('Detail', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']);
                }
            ],
        ],
    ]); ?>
</div>
