<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_status".
 *
 * @property int $id
 * @property string $nama
 *
 * @property TbPendaftaran[] $tbPendaftarans
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_status';
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
            'nama' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPendaftarans()
    {
        return $this->hasMany(Pendaftaran::className(), ['status_id' => 'id']);
    }

      /**
     * Get Status Id
     */
    public static function getStatusId($name)
    {
        $status = Status::find()->where(['nama' => $name])->one();
        return $status->id;
    }
}
