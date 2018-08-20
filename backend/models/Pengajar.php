<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_pengajar".
 *
 * @property int $id
 * @property string $nama
 * @property string $alamat
 * @property string $nomor_hp
 * @property string $email_akun
 *
 * @property TbMataPelajaran[] $tbMataPelajarans
 * @property TbAkun $emailAkun
 */
class Pengajar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_pengajar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'alamat', 'nomor_hp', 'email_akun'], 'required'],
            [['nama', 'alamat', 'nomor_hp', 'email_akun'], 'string', 'max' => 255],
            [['email_akun'], 'exist', 'skipOnError' => true, 'targetClass' => Akun::className(), 'targetAttribute' => ['email_akun' => 'email']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMataPelajarans()
    {
        return $this->hasMany(MataPelajaran::className(), ['pengajar_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailAkun()
    {
        return $this->hasOne(Akun::className(), ['email' => 'email_akun']);
    }
}
