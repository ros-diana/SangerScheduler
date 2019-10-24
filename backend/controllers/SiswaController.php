<?php

namespace backend\controllers;

use Yii;
use backend\models\Siswa;
use backend\models\SiswaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\User;
use yii\helpers\Html;
use backend\models\Pendaftaran;
use backend\models\MataPelajaran;
use backend\models\Status;


/**
 * SiswaController implements the CRUD actions for Siswa model.
 */
class SiswaController extends Controller
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
     * Lists all Siswa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SiswaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Siswa model.
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
        $user = User::find()->where(['id'=>$model->id_user])->one();
        $pendaftaran = Pendaftaran::find()->where(['id'=>$model->pendaftaran_id])->one();
        $mapel = MataPelajaran::find()->where(['id'=>$pendaftaran->mapel_id])->one();
        $mapel_link = Html::a($mapel->nama, ['mata-pelajaran/view', 'id' => $mapel->id]) . "  ";
        // $user_link = Html::a($user->username, ['user/view', 'id' => $user->id], ['class' => 'btn btn-primary']) . "  ";
        $user_link = Html::a($user->username, ['user/view', 'id' => $user->id]) . "  ";
        return $this->render('view', [
            'model' => $model,
            'user' => $user_link,
            'mapel' => $mapel_link
        ]);
    }

    /**
     * Creates a new Siswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Siswa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Siswa model.
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

    public function actionReject($id)
    {
        $model = $this->findModel($id);
        $pendaftaran = Pendaftaran::find()->where(['id'=>$model->pendaftaran_id])->one();
        $pendaftaran->status_id = Status::getStatusId("Rejected");
        $pendaftaran->save();
        return $this->redirect(['index']);
    }

    public function actionAccept($id)
    {
        $model = $this->findModel($id);
        $pendaftaran = Pendaftaran::find()->where(['id'=>$model->pendaftaran_id])->one();
        $pendaftaran->status_id = Status::getStatusId("Confirmed");
        $pendaftaran->save();
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Siswa model.
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
     * Finds the Siswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Siswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Siswa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
