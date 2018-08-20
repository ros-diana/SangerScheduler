<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_mata_pelajaran".
 *
 * @property int $id
 * @property string $nama
 * @property int $jenis_id
 * @property int $pengajar_id
 *
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
            [['nama', 'jenis_id', 'pengajar_id'], 'required'],
            [['jenis_id', 'pengajar_id'], 'integer'],
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
            'nama' => 'Nama',
            'jenis_id' => 'Jenis ID',
            'pengajar_id' => 'Pengajar ID',
        ];
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
    public function getPendaftarans()
    {
        return $this->hasMany(Pendaftaran::className(), ['mapel_id' => 'id']);
    }
}
