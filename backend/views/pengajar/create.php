<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Pengajar */

$this->title = 'Tambah Pengajar';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Pengajar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengajar-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Silahkan isi kolom berikut untuk menambahkan pengajar</p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
