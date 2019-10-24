<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MataPelajaran;

/**
 * MataPelajaranSearch represents the model behind the search form of `backend\models\MataPelajaran`.
 */
class MataPelajaranSearch extends MataPelajaran
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'jumlah_siswa', 'jenis_id', 'pengajar_id','harga'], 'integer'],
            [['nama', 'keterangan', 'persyaratan', 'durasi_kursus', 'materi'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MataPelajaran::find()->where(['jenis_id'=>1]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'jumlah_siswa' => $this->jumlah_siswa,
            'jenis_id' => $this->jenis_id,
            'pengajar_id' => $this->pengajar_id,
            'harga' => $this->harga
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'persyaratan', $this->persyaratan])
            ->andFilterWhere(['like', 'durasi_kursus', $this->durasi_kursus])
            ->andFilterWhere(['like', 'materi', $this->materi]);

        return $dataProvider;
    }
	
	public function searchAll($params)
    {
        $query = MataPelajaran::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'jumlah_siswa' => $this->jumlah_siswa,
            'jenis_id' => $this->jenis_id,
            'pengajar_id' => $this->pengajar_id,
            'harga' => $this->harga
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'persyaratan', $this->persyaratan])
            ->andFilterWhere(['like', 'durasi_kursus', $this->durasi_kursus])
            ->andFilterWhere(['like', 'materi', $this->materi]);

        return $dataProvider;
    }

    public function searchIntensif($params)
    {
        $query = MataPelajaran::find()->where(['jenis_id'=>2]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'jumlah_siswa' => $this->jumlah_siswa,
            'jenis_id' => $this->jenis_id,
            'pengajar_id' => $this->pengajar_id,
            'harga' => $this->harga
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'persyaratan', $this->persyaratan])
            ->andFilterWhere(['like', 'durasi_kursus', $this->durasi_kursus])
            ->andFilterWhere(['like', 'materi', $this->materi]);

        return $dataProvider;
    }
}
