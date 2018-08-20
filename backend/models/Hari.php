<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_hari".
 *
 * @property int $id
 * @property string $nama
 * @property int $waktu_id
 *
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
            [['nama', 'waktu_id'], 'required'],
            [['waktu_id'], 'integer'],
            [['nama'], 'string', 'max' => 255],
            [['waktu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Waktu::className(), 'targetAttribute' => ['waktu_id' => 'id']],
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
            'waktu_id' => 'Waktu ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWaktu()
    {
        return $this->hasOne(Waktu::className(), ['id' => 'waktu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwals()
    {
        return $this->hasMany(Jadwal::className(), ['hari_id' => 'id']);
    }
}
