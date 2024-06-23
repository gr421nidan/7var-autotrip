<?php

namespace app\controllers;

use app\models\Order;
use app\models\Trip;
use app\models\TripSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TripController implements the CRUD actions for Trip model.
 */
class TripController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Trip models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TripSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Trip model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Trip model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Trip();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionOrder($id)
    {
        $model = new Order();
        $tripModel = Trip::findOne(['id' => $id]);
        if ($this->request->isPost) {
            $count_seat = \Yii::$app->request->post('count_seat', 0);
            if ($tripModel->count_seats < $count_seat) {
                \Yii::$app->session->setFlash('error', 'Вы не можете купить столько билетов');
                return $this->redirect(['trip/index']);
            }
            $tripModel->count_seats = $tripModel->count_seats - $count_seat;
            if (!$tripModel->save()) {
                \Yii::$app->session->setFlash('error', 'Ошибка сохранения данных рейса: ' . json_encode($tripModel->errors));
                return $this->redirect(['trip/index']);
            }
            $model->username = \Yii::$app->user->identity->username;
            $model->count_seat = (int)$count_seat;
            $model->trip_id = $id;
            $model->price_end = (float)$count_seat * (float)$tripModel->price;
            if ($model->save()) {
                \Yii::$app->session->setFlash('success', 'Вы успешно заказали билеты!');
                return $this->redirect(['trip/index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('//order/view', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Trip model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Trip model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Trip model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Trip the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Trip::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
