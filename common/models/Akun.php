<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tb_akun".
 *
 * @property string $email
 * @property string $password
 * @property int $role_id
 *
 * @property TbRole $role
 * @property TbPengajar[] $tbPengajars
 * @property TbSiswa[] $tbSiswas
 */
class Akun extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_akun';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password', 'role_id'], 'required'],
            [['role_id'], 'integer'],
            [['email', 'password'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => TbRole::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
            'role_id' => 'Role ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(TbRole::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPengajars()
    {
        return $this->hasMany(TbPengajar::className(), ['email_akun' => 'email']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbSiswas()
    {
        return $this->hasMany(TbSiswa::className(), ['email_akun' => 'email']);
    }
}
