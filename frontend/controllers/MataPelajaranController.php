<?php

namespace frontend\controllers;

use Yii;
use backend\models\MataPelajaran;
use backend\models\MataPelajaranSearch;
use backend\models\Pendaftaran;
use backend\models\Siswa;
use backend\models\Status;
use backend\models\User;
use backend\models\Role;
use frontend\models\form\DaftarKelasForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;


/**
 * MataPelajaranController implements the CRUD actions for MataPelajaran model.
 */
class MataPelajaranController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['daftar-kelas'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->isGuest || Yii::$app->user->identity->isSiswa;
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MataPelajaran models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MataPelajaranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = $dataProvider->query;
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages->pageSize=10;

        $models = $query->offset($pages->offset)
	        ->limit($pages->limit)
            ->all();
            
        $matpel = MataPelajaran::find()->orderBy(['id' => SORT_DESC])->limit(5)->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $models,
            'pages' => $pages,
            'matpel' => $matpel,
        ]);
    }

    public function actionIntensif()
    {
        $searchModel = new MataPelajaranSearch();
        $dataProvider = $searchModel->searchIntensif(Yii::$app->request->queryParams);

        $query = $dataProvider->query;
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages->pageSize=10;

        $models = $query->offset($pages->offset)
	        ->limit($pages->limit)
            ->all();
            
        $matpel = MataPelajaran::find()->orderBy(['id' => SORT_DESC])->limit(5)->all();

        return $this->render('intensif', [
            'searchModel' => $searchModel,
            'dataProvider' => $models,
            'pages' => $pages,
            'matpel' => $matpel,
        ]);
    }

    /**
     * Displays a single MataPelajaran model.
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
     * Creates a new MataPelajaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MataPelajaran();

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
    public function actionDaftarKelas($id)
    {
        $model = new DaftarKelasForm();
        $kelas = $this->findModel($id);
        // var_dump($kelas);
        // die();
        $user = User::find()->where(['id'=> \Yii::$app->user->identity->id])->one();
        // var_dump($user);
        // die();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Start transaction
            $transaction = Yii::$app->db->beginTransaction();

            try {
                $user->role_id = Role::getUserRoleId('Siswa');
                //  checking
                // var_dump($user->role_id);
                // die();
                $user->save(false);
                // if(!$user->save()) {
                    // Rollback if user not saved
                    // throw new Exception('Failed to save User');
                // }

                $pendaftaran = new Pendaftaran();
                $pendaftaran->status_id = Status::getStatusId('Request');
                $pendaftaran->mapel_id = $kelas->id;
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

                return $this->render('DaftarKelas', [
                    'model' => $user,
                ]);
            }

            // Commit Transaction
            $transaction->commit();

            return $this->redirect(['index']);
        } else {
            return $this->render('DaftarKelas', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing MataPelajaran model.
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
     * Deletes an existing MataPelajaran model.
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
     * Finds the MataPelajaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MataPelajaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MataPelajaran::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
