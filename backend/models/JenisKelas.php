<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tb_jenis_kelas".
 *
 * @property int $id
 * @property string $jenis
 *
 * @property TbMataPelajaran[] $tbMataPelajarans
 */
class JenisKelas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_jenis_kelas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenis'], 'required'],
            [['jenis'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenis' => 'Jenis',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMataPelajarans()
    {
        return $this->hasMany(MataPelajaran::className(), ['jenis_id' => 'id']);
    }

     /**
     * Get List of Kelas
     */
    public static function getKelasList()
    {
        $droptions = JenisKelas::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'jenis');
    }

    /**
     * Get Kelas Id
     */
    public static function getKelasId($name)
    {
        $kelas = JenisKelas::find()->where(['jenis' => $name])->one();
        return $kelas->id;
    }
}
