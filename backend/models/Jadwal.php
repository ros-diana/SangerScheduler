<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_jadwal".
 *
 * @property int $id
 * @property string $keterangan
 * @property int $hari_id
 * @property int $ruangan_id
 * @property int $mapel_id
 *
 * @property TbHari $hari
 * @property TbMataPelajaran $mapel
 * @property TbRuangan $ruangan
 * @property TbSiswa[] $tbSiswas
 */
class Jadwal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_jadwal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['keterangan', 'hari_id', 'ruangan_id', 'mapel_id'], 'required'],
            [['keterangan'], 'string'],
            [['hari_id', 'ruangan_id', 'mapel_id'], 'integer'],
            [['hari_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hari::className(), 'targetAttribute' => ['hari_id' => 'id']],
            [['mapel_id'], 'exist', 'skipOnError' => true, 'targetClass' => MataPelajaran::className(), 'targetAttribute' => ['mapel_id' => 'id']],
            [['ruangan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ruangan::className(), 'targetAttribute' => ['ruangan_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keterangan' => 'Keterangan',
            'hari_id' => 'Hari ID',
            'ruangan_id' => 'Ruangan ID',
            'mapel_id' => 'Mapel ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHari()
    {
        return $this->hasOne(Hari::className(), ['id' => 'hari_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMapel()
    {
        return $this->hasOne(MataPelajaran::className(), ['id' => 'mapel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuangan()
    {
        return $this->hasOne(Ruangan::className(), ['id' => 'ruangan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswas()
    {
        return $this->hasMany(Siswa::className(), ['jadwal_id' => 'id']);
    }
}
