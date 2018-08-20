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
                        ['label' => 'Kelas Reguler', 'icon' => 'fa fa-users', 'url' => ['/ruangan']],
                        ['label' => 'Kelas Intensif', 'icon' => 'fa fa-user', 'url' => ['/']], 
                        ['label' => 'Akun user', 'icon' => 'fa fa-user', 'url' => ['/siswa']],
                        ['label' => 'Penjadwalan', 'icon' => 'fa fa-calendar', 'url' => ['/jadwal']],
                        ['label' => 'Daftar Ruangan', 'icon' => 'fa fa-list', 'url' => ['/ruangan']],
                       
                    ],
                ]
        )
        ?>
        
    </section>
</aside>
