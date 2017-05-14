<?php

namespace app\controllers;

use Yii;
use app\models\Eventcommentreply;
use app\models\EventcommentreplySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventcommentreplyController implements the CRUD actions for Eventcommentreply model.
 */
class EventcommentreplyController extends Controller
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
     * Lists all Eventcommentreply models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventcommentreplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Eventcommentreply model.
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
     * Creates a new Eventcommentreply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Eventcommentreply();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->eventcommentreplyid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Eventcommentreply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->eventcommentreplyid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Eventcommentreply model.
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
     * Finds the Eventcommentreply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Eventcommentreply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Eventcommentreply::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function beforeAction($action)
    {
    	if ($action->id == 'insertreply') {
    		$this->enableCsrfValidation = false;
    	}    	
    
    	return parent::beforeAction($action);
    }
    
    public function actionInsertreply(){
    	if (Yii::$app->request->isPost)
    	{
    		$model=new Eventcommentreply();
    		$data = Yii::$app->request->post();
    		$model->eventcommentid=$data['eventcommentid'];
    		$model->appuserid=$data['appuserid'];
    		$model->eventid=$data['eventid'];
    		$model->comment=$data['comment'];
    		$model->publish=1;
    		$model->save();
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
}
