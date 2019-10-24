<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tb_pengajar".
 *
 * @property int $id
 * @property string $nama
 * @property string $alamat
 * @property string $nomor_hp
 * @property int $id_user
 *
 * @property TbMataPelajaran[] $tbMataPelajarans
 * @property User $user
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
            [['nama', 'alamat', 'nomor_hp', 'id_user'], 'required'],
            [['id_user'], 'integer'],
            [['nama', 'alamat', 'nomor_hp'], 'string', 'max' => 255],
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
            'nama' => 'Nama Pengajar',
            'alamat' => 'Alamat',
            'nomor_hp' => 'Nomor Hp',
            'id_user' => 'Id User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbMataPelajarans()
    {
        return $this->hasMany(MataPelajaran::className(), ['pengajar_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

     /**
     * Get List of Pengajar
     */
    public static function getPengajarList()
    {
        $droptions = Pengajar::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'nama');
    }

    /**
     * Get Pengajar Id
     */
    public static function getPengajarId($name)
    {
        $pengajar = Pengajar::find()->where(['nama' => $name])->one();
        return $pengajar->id;
    }


}
