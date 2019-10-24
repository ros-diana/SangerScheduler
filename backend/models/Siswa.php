<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_siswa".
 *
 * @property int $id
 * @property string $nama
 * @property string $alamat
 * @property string $nomor_hp
 * @property int $pendaftaran_id
 * @property int $id_user
 *
 * @property TbPendaftaran $pendaftaran
 * @property User $user
 */
class Siswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_siswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'alamat', 'nomor_hp', 'pendaftaran_id', 'id_user'], 'required'],
            [['pendaftaran_id', 'id_user'], 'integer'],
            [['nama', 'alamat', 'nomor_hp'], 'string', 'max' => 255],
            [['pendaftaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pendaftaran::className(), 'targetAttribute' => ['pendaftaran_id' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
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
            'alamat' => 'Alamat',
            'nomor_hp' => 'Nomor Hp',
            'pendaftaran_id' => 'Pendaftaran ID',
            'id_user' => 'Id User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPendaftaran()
    {
        return $this->hasOne(Pendaftaran::className(), ['id' => 'pendaftaran_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
