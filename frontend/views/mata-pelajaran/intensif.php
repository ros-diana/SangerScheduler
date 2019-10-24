<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MataPelajaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Kelas Intensif';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="mata-pelajaran-index">

    <h1><?= Html::encode($this->title) ?></h1>

     <div class="row">
            <div class="col-md-8">
                <?php
                if(count($dataProvider) == 0){
                    echo '<p class="alert-danger">Maaf daftar kelas yang anda cari tidak tersedia.</p>';
                }
                foreach ($dataProvider as $dp)
                {
                    echo '<div class="box box-default">'
                        .'<div class="box-body">'
                        .'<div class="row">'
                        .'<div class="col-md-8">'
                        .'<h3>'
                        .'<strong>' .Html::encode($dp->nama) . '</strong>'
                        .'<br/>'
                        .'</h3>'
                        .'</div>'
                        .'<div class="col-md-4">'
                        .'<div class="col-md-12" align="right">'
                        .'<br/>'
                        . Html::a('Rincian', ['view', 'id' => $dp->id], ['class' => 'btn btn-primary'])
                        .'</div>'
                        .'<br/>'
                        .'</div>'
                        .'</div>';

                    echo '</div>'
                        .'</div>';
                        
                }
                echo LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>
            </div>
                </div>
</div>
