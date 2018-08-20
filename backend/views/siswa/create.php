<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Siswa */

$this->title = 'Create Siswa';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Siswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Silahkan isi kolom berikut untuk menambahkan siswa</p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
