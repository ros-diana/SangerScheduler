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
 * @property string $email_akun
 * @property int $pendaftaran_id
 * @property int $jadwal_id
 *
 * @property TbAkun $emailAkun
 * @property TbJadwal $jadwal
 * @property TbPendaftaran $pendaftaran
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
            [['nama', 'alamat', 'nomor_hp', 'email_akun', 'pendaftaran_id', 'jadwal_id'], 'required'],
            [['pendaftaran_id', 'jadwal_id'], 'integer'],
            [['nama', 'alamat', 'nomor_hp', 'email_akun'], 'string', 'max' => 255],
            [['email_akun'], 'exist', 'skipOnError' => true, 'targetClass' => Akun::className(), 'targetAttribute' => ['email_akun' => 'email']],
            [['jadwal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jadwal::className(), 'targetAttribute' => ['jadwal_id' => 'id']],
            [['pendaftaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pendaftaran::className(), 'targetAttribute' => ['pendaftaran_id' => 'id']],
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
            'email_akun' => 'Email Akun',
            'pendaftaran_id' => 'Pendaftaran ID',
            'jadwal_id' => 'Jadwal ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailAkun()
    {
        return $this->hasOne(Akun::className(), ['email' => 'email_akun']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwal()
    {
        return $this->hasOne(Jadwal::className(), ['id' => 'jadwal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPendaftaran()
    {
        return $this->hasOne(Pendaftaran::className(), ['id' => 'pendaftaran_id']);
    }
}
