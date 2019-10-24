<?php
namespace frontend\models;

use yii\base\Model;
use backend\models\User;
use backend\models\Role;
use yii\base\Exception;
use yii;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $verifyCode;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\backend\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\backend\models\User', 'message' => 'This email address has already been taken.'],
            
            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }


    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        // Start transaction
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->role_id = Role::getUserRoleId('Guest');

            if(!$user->save()) {
                throw new Exception('Failed to save User');
            }

        } catch (Exception $ex) {
            // Rollback if any save() failed
            $transaction->rollBack();
//            return null;
            die($ex->getMessage());
        }

        // Commit Transaction
        $transaction->commit();

        return $user;
    }
}
