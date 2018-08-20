<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_role".
 *
 * @property int $id
 * @property string $nama
 *
 * @property TbAkun[] $tbAkuns
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAkuns()
    {
        return $this->hasMany(Akun::className(), ['role_id' => 'id']);
    }
}
