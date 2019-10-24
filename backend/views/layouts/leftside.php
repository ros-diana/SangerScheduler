<?php

use adminlte\widgets\Menu;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<aside class="main-sidebar">
  
    <section class="sidebar">

        <?=
        Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Menu', 'options' => ['class' => 'header']],
                        ['label' => 'Beranda', 'icon' => 'fa fa-home', 'url' => ['/site']],
                        ['label' => 'Users', 'icon' => 'fa fa-users', 'url' => ['/user'], 'visible' => Yii::$app->user->identity->isAdmin],
                        ['label' => 'Kelas', 'icon' => 'fa fa-book', 'url' => ['/mata-pelajaran']],
                        // ['label' => 'Pendaftaran', 'icon' => 'fa fa-user', 'url' => ['/pendaftaran']], 
                        
                        ['label' => 'Siswa', 'icon' => 'fa fa-male', 'url' => ['/siswa']],
                        // ['label' => 'Penjadwalan', 'icon' => 'fa fa-calendar', 'url' => ['/jadwal']],
                        ['label' => 'Daftar Ruangan', 'icon' => 'fa fa-building', 'url' => ['/ruangan'],  'visible' => Yii::$app->user->identity->isAdmin],
                       
                    ],
                ]
        )
        ?>
        
    </section>
</aside>
