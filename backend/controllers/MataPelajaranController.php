<?php

namespace backend\controllers;

use Yii;
use backend\models\MataPelajaran;
use backend\models\form\MataPelajaranAddForm;
use backend\models\MataPelajaranSearch;
use backend\models\JenisKelas;
use backend\models\Pengajar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
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
        $dataProvider = $searchModel->searchAll(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        if (\Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $model = $this->findModel($id);
        $pengajar = Pengajar::find()->where(['id'=>$model->pengajar_id])->one();
        // $pengajar_link = Html::a($pengajar->nama, ['pengajar/view', 'id' => $pengajar->id], ['class' => 'btn btn-default']) . "  ";
        return $this->render('view', [
            'model' => $model,
            'pengajar' => $pengajar,
        ]);

        
    }

    /**
     * Creates a new MataPelajaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionMataPelajaranAdd()
    {
        $model = new MataPelajaranAddForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Start transaction
            $transaction = Yii::$app->db->beginTransaction();

            try {
                $matpel = new MataPelajaran();
                $matpel->nama = $model->nama;
                $matpel->jumlah_siswa = $model->jumlah_siswa;
                $matpel->harga = $model->harga;
                $matpel->durasi_kursus = $model->durasi_kursus;
                $matpel->keterangan = $model->keterangan;
                $matpel->persyaratan = $model->persyaratan;
                $matpel->materi = $model->materi;
                $matpel->jenis_id = $model->jenis_id;
                $matpel->pengajar_id = $model->pengajar_id;
                if(!$matpel->save()) {
                    throw new Exception('Failed to save Mata Pelajaran');
                }

            } catch (Exception $ex) {
                // Rollback if any save() failed
                $transaction->rollBack();
                die($ex->getMessage());

            }

            // Commit Transaction
            $transaction->commit();

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
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
