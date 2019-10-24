<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tb_mata_pelajaran".
 *
 * @property int $id
 * @property string $nama
 * @property int $jumlah_siswa
 * @property int $harga
 * @property string $keterangan
 * @property string $persyaratan
 * @property string $durasi_kursus
 * @property string $materi
 * @property int $jenis_id
 * @property int $pengajar_id
 *
 * @property TbHari[] $tbHaris
 * @property TbJadwal[] $tbJadwals
 * @property TbJenisKelas $jenis
 * @property TbPengajar $pengajar
 * @property TbPendaftaran[] $tbPendaftarans
 */
class MataPelajaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_mata_pelajaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'jumlah_siswa', 'keterangan', 'persyaratan', 'durasi_kursus', 'materi', 'jenis_id', 'pengajar_id','harga'], 'required'],
            [['harga','jumlah_siswa', 'jenis_id', 'pengajar_id'], 'integer'],
            [['keterangan', 'persyaratan', 'durasi_kursus', 'materi'], 'string'],
            [['nama'], 'string', 'max' => 255],
            [['jenis_id'], 'exist', 'skipOnError' => true, 'targetClass' => JenisKelas::className(), 'targetAttribute' => ['jenis_id' => 'id']],
            [['pengajar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pengajar::className(), 'targetAttribute' => ['pengajar_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Mata Pelajaran',
            'jumlah_siswa' => 'Jumlah Siswa',
            'harga' => 'Harga',
            'keterangan' => 'Deskripsi',
            'persyaratan' => 'Persyaratan',
            'durasi_kursus' => 'Durasi Kursus',
            'materi' => 'Materi',
            'jenis_id' => 'Jenis Kelas',
            'pengajar_id' => 'Pengajar',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbHaris()
    {
        return $this->hasMany(Hari::className(), ['id_mapel' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbJadwals()
    {
        return $this->hasMany(Jadwal::className(), ['mapel_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenis()
    {
        return $this->hasOne(JenisKelas::className(), ['id' => 'jenis_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengajar()
    {
        return $this->hasOne(Pengajar::className(), ['id' => 'pengajar_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPendaftarans()
    {
        return $this->hasMany(Pendaftaran::className(), ['mapel_id' => 'id']);
    }
    
      /**
     * Get List of Mata Pelajaran
     */
    public static function getMapelList()
    {
        $droptions = MataPelajaran::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'nama');
    }

    /**
     * Get Mata Pelajaran Id
     */
    public static function getMapelId($name)
    {
        $mapel = MataPelajaran::find()->where(['nama' => $name])->one();
        return $mapel->id;
    }
}
