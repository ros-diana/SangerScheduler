<?php

namespace backend\models\form;

use Yii;
use yii\base\Model;

class MataPelajaranAddForm extends Model
{
    public $nama;
    public $jumlah_siswa;
    public $harga;
    public $jenis_id;
    public $pengajar_id;
    public $durasi_kursus;
    public $persyaratan;
    public $keterangan;
    public $materi;
    public $isNewRecord = true;
    
    public function rules()
    {
        return [
            [['nama', 'jumlah_siswa', 'jenis_id','pengajar_id','durasi_kursus','persyaratan','keterangan','materi','harga'], 'required', 'message' => '{attribute} tidak boleh kosong.'],
            [['jenis_id','jumlah_siswa','pengajar_id','harga'], 'integer'],
            [['nama','durasi_kursus','persyaratan','keterangan','materi'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'nama' => 'Mata Pelajaran',
            'jumlah_siswa' => 'Jumlah Siswa',
            'harga' => 'Harga',
            'jenis_id' => 'Jenis Kelas',
            'pengajar_id' => 'Nama Pengajar',
            'durasi_kursus' => 'Durasi Kursus',
            'persyaratan' => 'Persyaratan',
            'keterangan' => 'Deskripsi',
            'materi' => 'Materi'
        ];
    }

}
