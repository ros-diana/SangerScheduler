<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Pengajar */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Pengajar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengajar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama',
            'alamat',
            'nomor_hp',
            'email_akun:email',
        ],
    ]) ?>

</div>
