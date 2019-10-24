<?php
namespace frontend\models\form;

use Yii;
use yii\base\Model;

/**
 * Signup form for Siswa
 */
class DaftarKelasForm extends Model
{  

    public $nama;
    public $alamat;
    public $nomor_hp;

    // public $mapel_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['alamat','required'],
            
            ['nomor_hp','required'],
            
            ['nama','required'],
            // ['mapel_id','required']
        ];
    }

}
