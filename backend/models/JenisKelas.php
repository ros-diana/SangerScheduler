<?php

namespace backend\models;

use Yii;

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
}
