<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Exception;
use yii\db\IntegrityException;

use backend\models\form\PengajarAddForm;
use backend\models\form\SiswaAddForm;
use backend\models\Pendaftaran;
use backend\models\Status;
use backend\models\Siswa;
use backend\models\Pengajar;
use backend\models\Role;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

     /**
     * Creates a new Pengajar.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionPengajarAdd()
    {
        $model = new PengajarAddForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Start transaction
            $transaction = Yii::$app->db->beginTransaction();

            try {
                $user = new User();
                $user->username = $model->username;
                $user->email = $model->email;
                $user->setPassword($model->password);
                $user->role_id = Role::getUserRoleId('Staff Pengajar');
                //  checking
                // var_dump($user);
                // die();
                if(!$user->save()) {
                    // Rollback if user not saved
                    throw new Exception('Failed to save User');
                }

                $pengajar = new Pengajar();
                $pengajar->nama = $model->nama;
                $pengajar->alamat = $model->alamat;
                $pengajar->nomor_hp = $model->nomor_hp;
                $pengajar->id_user = $user->id;

                if(!$pengajar->save()) {
                    // Rollback if user not saved
                    throw new Exception('Failed to save Pengajar');
                }

            } catch (Exception $ex) {
                // Rollback if any save() failed
                $transaction->rollBack();
                die($ex->getMessage());

                return $this->render('PengajarAdd', [
                    'model' => $user,
                ]);
            }

            // Commit Transaction
            $transaction->commit();

            return $this->redirect(['index']);
        } else {
            return $this->render('PengajarAdd', [
                'model' => $model,
            ]);
        }
    }

     /**
     * Creates a new Pengajar.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSiswaAdd()
    {
        $model = new SiswaAddForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Start transaction
            $transaction = Yii::$app->db->beginTransaction();

            try {
                $user = new User();
                $user->username = $model->username;
                $user->email = $model->email;
                $user->setPassword($model->password);
                $user->role_id = Role::getUserRoleId('Siswa');
                //  checking
                // var_dump($user);
                // die();
                if(!$user->save()) {
                    // Rollback if user not saved
                    throw new Exception('Failed to save User');
                }

                $pendaftaran = new Pendaftaran();
                $pendaftaran->status_id = Status::getStatusId('Confirmed');
                $pendaftaran->mapel_id = $model->mapel_id;
                // var_dump($pendaftaran->mapel_id);
                // die();

                if(!$pendaftaran->save()) {
                    // Rollback if user not saved
                    throw new Exception('Failed to save Pendaftaran');
                }

                $siswa = new Siswa();
                $siswa->nama = $model->nama;
                $siswa->alamat = $model->alamat;
                $siswa->nomor_hp = $model->nomor_hp;
                $siswa->pendaftaran_id = $pendaftaran->id;
                $siswa->id_user = $user->id;

                if(!$siswa->save()) {
                    // Rollback if user not saved
                    throw new Exception('Failed to save Siswa');
                }

            } catch (Exception $ex) {
                // Rollback if any save() failed
                $transaction->rollBack();
                die($ex->getMessage());

                return $this->render('SiswaAdd', [
                    'model' => $user,
                ]);
            }

            // Commit Transaction
            $transaction->commit();

            return $this->redirect(['index']);
        } else {
            return $this->render('SiswaAdd', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
