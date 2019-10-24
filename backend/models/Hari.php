<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_hari".
 *
 * @property int $id
 * @property string $nama
 * @property int $id_waktu
 * @property int $id_mapel
 *
 * @property TbMataPelajaran $mapel
 * @property TbWaktu $waktu
 * @property TbJadwal[] $tbJadwals
 */
class Hari extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_hari';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'id_waktu', 'id_mapel'], 'required'],
            [['id_waktu', 'id_mapel'], 'integer'],
            [['nama'], 'string', 'max' => 255],
            [['id_mapel'], 'exist', 'skipOnError' => true, 'targetClass' => TbMataPelajaran::className(), 'targetAttribute' => ['id_mapel' => 'id']],
            [['id_waktu'], 'exist', 'skipOnError' => true, 'targetClass' => TbWaktu::className(), 'targetAttribute' => ['id_waktu' => 'id']],
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
            'id_waktu' => 'Id Waktu',
            'id_mapel' => 'Id Mapel',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMapel()
    {
        return $this->hasOne(TbMataPelajaran::className(), ['id' => 'id_mapel']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWaktu()
    {
        return $this->hasOne(TbWaktu::className(), ['id' => 'id_waktu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbJadwals()
    {
        return $this->hasMany(TbJadwal::className(), ['hari_id' => 'id']);
    }
}
