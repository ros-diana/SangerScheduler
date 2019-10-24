<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Siswa */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Daftar Siswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-view">

<h1>Detail Siswa</h1>
<?php 
    if($model->pendaftaran->status_id == \backend\models\Status::getStatusId('Request')){
      ?> 
      <p>
        <?= Html::a('Confirm', ['accept', 'id' => $model->id], [
            'class' => 'btn btn-primary',
            'data' => [
                'confirm' => 'Are you sure you want to confirm this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Reject', ['reject', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
      <?php  
    }
?>


<div class="box box-solid box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'nama',
            'alamat',
            'nomor_hp',
            // 'pendaftaran.mapel.nama',
            'pendaftaran.status.nama',
            [
                'label' => 'Mata Pelajaran',
                'format' => 'raw',
                'value' => $mapel,
                // 'filter' => Html::activeDropDownList($searchModel, 'user_role', \backend\models\Role::getUserRoleList(),['class'=>'form-control','prompt' => 'All']),
            ],
            // 'user.username',
            [
                'label' => 'Username',
                'format' => 'raw',
                'value' => $user,
                // 'filter' => Html::activeDropDownList($searchModel, 'user_role', \backend\models\Role::getUserRoleList(),['class'=>'form-control','prompt' => 'All']),
            ],
        ],
    ]) ?>
        </div><!-- /.box-body -->
      </div><!-- /.box -->


  

</div>
