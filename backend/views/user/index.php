<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar User';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .label { 
        font-size: 90%; 
    }
</style>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <?= Yii::$app->user->identity->isAdmin ? Html::a('Tambah Pengajar', ['pengajar-add'], ['class' => 'btn btn-success']) : '' ?>
    <?= Yii::$app->user->identity->isAdmin ? Html::a('Tambah Siswa', ['siswa-add'], ['class' => 'btn btn-success']) :'' ?>
    </p>
   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            //'status',
            //'created_at',
            //'updated_at',
            // 'role_id',

            [
                'label' => 'Role',
                'format' => 'raw',
                // 'value' => 'role.nama',
                'value' => function($model, $key, $index, $column) {
                    
                    if($model->role->id == \backend\models\Role::getUserRoleId('Admin'))
                        $label_tag = 'label-danger';
                    else if($model->role->id == \backend\models\Role::getUserRoleId('Staff Pengajar'))
                        $label_tag = 'label-success';
                    else if($model->role->id == \backend\models\Role::getUserRoleId('Siswa'))
                        $label_tag = 'label-info';
                    else
                        $label_tag = 'label-warning';
                    return Html::tag('span', $model->role->nama, ['class' => 'label ' . $label_tag]);
                },
                'filter' => Html::activeDropDownList($searchModel, 'user_role', \backend\models\Role::getUserRoleList(),['class'=>'form-control','prompt' => 'All']),
            ],
            
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
