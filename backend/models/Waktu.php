<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tb_waktu".
 *
 * @property int $id
 * @property string $wkt_mulai
 * @property string $wkt_berakhir
 *
 * @property TbHari[] $tbHaris
 */
class Waktu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_waktu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wkt_mulai', 'wkt_berakhir'], 'required'],
            [['wkt_mulai', 'wkt_berakhir'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wkt_mulai' => 'Wkt Mulai',
            'wkt_berakhir' => 'Wkt Berakhir',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHaris()
    {
        return $this->hasMany(Hari::className(), ['waktu_id' => 'id']);
    }
}
