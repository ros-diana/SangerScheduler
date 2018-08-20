<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Ruangan */

$this->title = 'Tambahkan Ruangan';

$this->params['breadcrumbs'][] = ['label' => 'Daftar Ruangan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ruangan-create">

    <h1><?= Html::encode($this->title) ?></h1>
<p>Silahkan isi kolom berikut untuk menambahkan ruangan</p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
