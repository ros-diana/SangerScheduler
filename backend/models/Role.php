<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tb_role".
 *
 * @property int $id
 * @property string $nama
 *
 * @property User[] $users
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
            'nama' => 'Role',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['role_id' => 'id']);
    }

    /**
     * Get User Role Id
     */
    public static function getUserRoleId($name)
    {
        $role = Role::find()->where(['nama' => $name])->one();

        return $role->id;
    }

     public static function getUserRoleList()
    {
        $droptions = Role::find()->asArray()->all();

        return ArrayHelper::map($droptions, 'id', 'nama');
    }

    /**
     * Get List of User Admin Roles
     */
    // public static function getUserAdminRoleList()
    // {
    //     $droptions = Role::find()->where(['like', 'nama', 'Admin'])->asArray()->all();
    //     return ArrayHelper::map($droptions, 'id', 'nama');
    // }

     /**
     * Get List of User Pengajar Roles
     */
    // public static function getUserPengajarRoleList()
    // {
    //     $droptions = Role::find()->where(['like', 'nama', 'Pengajar'])->asArray()->all();
    //     return ArrayHelper::map($droptions, 'id', 'nama');
    // }

    
    
}
