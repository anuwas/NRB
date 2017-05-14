<?php

namespace app\controllers;

use Yii;
use app\models\Yearspan;
use app\models\YearspanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * YearspanController implements the CRUD actions for Yearspan model.
 */
class YearspanController extends Controller
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
     * Lists all Yearspan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new YearspanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Yearspan model.
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
     * Creates a new Yearspan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Yearspan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->yearspanid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function beforeAction($action)
    {
    	return parent::beforeAction($action);
    }
    
    public function actionAdd()
    {
    	if (Yii::$app->request->isPost)
    	{
    		$model= new Yearspan();
    		$data = Yii::$app->request->post();
    		$model->year_start=$data['year_start'];
    		$model->year_end=$data['year_end'];
    		
    		$model->save();
    	}
    }
    public function actionGetyearspanbyid(){
    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	if (Yii::$app->request->isPost)
    	{
    		$data = Yii::$app->request->post();
    		$model = $this->findModel($data['id']);
    		$arr=array('year_start'=>$model->year_start,'year_end'=>$model->year_end);
    		return $arr;
    	}
    }
    public function actionEdit()
    {
    	if(Yii::$app->request->isPost){
    		$data=Yii::$app->request->post();
    		$model = $this->findModel($data['id']);
    		$model->year_start=$data['year_start'];
    		$model->year_end=$data['year_end'];
    		$model->save();
    	}
    }
    public function actionRemove($id)
    {
    	$this->findModel($id)->delete();
        return $this->redirect(['/year-span']);
    }
    
    

    /**
     * Updates an existing Yearspan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->yearspanid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Yearspan model.
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
     * Finds the Yearspan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Yearspan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Yearspan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
