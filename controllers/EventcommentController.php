<?php

namespace app\controllers;

use Yii;
use app\models\Eventcomment;
use app\models\EventcommentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventcommentController implements the CRUD actions for Eventcomment model.
 */
class EventcommentController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Eventcomment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventcommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Eventcomment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Eventcomment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Eventcomment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->eventcommentid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Eventcomment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->eventcommentid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Eventcomment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Eventcomment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Eventcomment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Eventcomment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionPulishcomment(){
    	if(Yii::$app->request->post()){
    		$data=Yii::$app->request->post();
    		$model = $this->findModel($data['id']);
    		$model->publish=1;
    		$model->save();
    	}
    }
    
    public function actionUnpulishcomment(){
    	if(Yii::$app->request->post()){
    		$data=Yii::$app->request->post();
    		$model = $this->findModel($data['id']);
    		$model->publish=0;
    		$model->save();
    	}
    }
    
    public function actionCheckcommentpublishstatus()
    {
    	if(Yii::$app->request->post()){
    		$data=Yii::$app->request->post();
    		$model = $this->findModel($data['id']);
    		if($model->publish==0){
    			echo 'notpublish';
    		}else{
    			echo 'published';
    		}
    	}
    }
    
    
}
