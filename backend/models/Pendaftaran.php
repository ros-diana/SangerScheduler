<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_pendaftaran".
 *
 * @property int $id
 * @property string $waktu_pendaftaran
 * @property int $status_id
 * @property int $mapel_id
 *
 * @property TbMataPelajaran $mapel
 * @property TbStatus $status
 * @property TbSiswa[] $tbSiswas
 */
class Pendaftaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_pendaftaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_id', 'mapel_id'], 'required'],
            [['waktu_pendaftaran'], 'safe'],
            [['status_id', 'mapel_id'], 'integer'],
            [['mapel_id'], 'exist', 'skipOnError' => true, 'targetClass' => MataPelajaran::className(), 'targetAttribute' => ['mapel_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'waktu_pendaftaran' => 'Waktu Pendaftaran',
            'status_id' => 'Status ID',
            'mapel_id' => 'Mapel ID',
        ];
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
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswas()
    {
        return $this->hasMany(Siswa::className(), ['pendaftaran_id' => 'id']);
    }
}
