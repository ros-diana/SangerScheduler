<?php
namespace backend\models\form;

use Yii;
use yii\base\Model;

/**
 * Signup form for Siswa
 */
class SiswaAddForm extends Model
{  
    public $username;
    public $email;
    public $password;

    public $nama;
    public $alamat;
    public $nomor_hp;

    public $mapel_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username','required', 'message' => '{attribute} tidak boleh kosong.'],
            ['username', 'string', 'max' => 255],
            ['username', 'unique', 'targetClass' => '\backend\models\User', 'message' => 'Username ini telah digunakan.'],

            ['email', 'trim'],
            ['email', 'required', 'message' => '{attribute} tidak boleh kosong.'],
            ['email', 'email', 'message' => 'Gunakan email yang benar.'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\backend\models\User', 'message' => 'Email ini telah digunakan.'],

            ['password', 'required', 'message' => '{attribute} tidak boleh kosong.'],
            ['password', 'string', 'min' => 6],

            ['alamat','required'],
            
            ['nomor_hp','required'],
            
            ['nama','required'],
            ['mapel_id','required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'mapel_id' => 'Mata Pelajaran'
        ];
    }
}
