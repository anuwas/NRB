<?php

namespace app\controllers;

use Yii;
use app\models\Featuregallery;
use app\models\FeaturegallerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * FeaturegalleryController implements the CRUD actions for Featuregallery model.
 */
class FeaturegalleryController extends Controller
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
     * Lists all Featuregallery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FeaturegallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Featuregallery model.
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
     * Creates a new Featuregallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Featuregallery();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->featuregallery_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Featuregallery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->featuregallery_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Featuregallery model.
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
     * Finds the Featuregallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Featuregallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Featuregallery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function beforeAction($action)
    {
    	if ($action->id == 'insertitem') {
    		$this->enableCsrfValidation = false;
    	}
    	 
    	if ($action->id == 'updategallery') {
    		$this->enableCsrfValidation = false;
    	}
    	if ($action->id == 'deletegallerybyid') {
    		$this->enableCsrfValidation = false;
    	}
    	 
    
    	return parent::beforeAction($action);
    }
    
    public function actionInsertitem(){
    	
    	$imgmodel = new UploadForm();
    	
    	$model = new Featuregallery();
    	if (Yii::$app->request->isPost) {
    		$data = Yii::$app->request->post();
    		$uploadedfile = UploadedFile::getInstance($imgmodel, 'myimageFile');
    		if($uploadedfile){
    			$imgmodel->imageFile=$uploadedfile;
    			$filename=$imgmodel->featuregalleryUpload();
    			$model->image=$filename;
    			 
    			//Image::frame('uploads/gallery/'.$filename)->thumbnail(new Box(100, 100))->save('uploads/gallery/thumb/'.$filename, ['quality' => 50]);
    
    
    		}else{
    			$model->event_image='avatar.jpg';
    		}
    		 
    
    		$model->image_title=$data['image_title'];
    		$model->image_alt=$data['image_alt'];
    		 
    		 
    		$model->save();
    		 
    		return $this->redirect(['/feature-gallery']);
    		 
    	}
    }
    
    public function actionUpdategallery(){
    	$imgmodel = new UploadForm();
    	 
    	if (Yii::$app->request->isPost) {
    		$data = Yii::$app->request->post();
    		$model=$this->findModel($data['featuregallery_id']);
    		$uploadedfile = UploadedFile::getInstance($imgmodel, 'myimageFile');
    		if($uploadedfile){
    			 
    			$imgmodel->imageFile=$uploadedfile;
    			$filename=$imgmodel->featuregalleryUpload();
    			$model->image=$filename;
    		}
    
    		$model->image_title=$data['edit_image_title'];
    		$model->image_alt=$data['edit_image_alt'];
    		 
    		$model->save();
    		 
    		return $this->redirect(['/feature-gallery']);
    	}
    }
    
    public function actionGatgalleryid(){
    	 
    	$model=new Featuregallery();
    	if (Yii::$app->request->isAjax) {
    		$data = Yii::$app->request->get();
    		$galleryid=$data['featuregallery_id'];
    
    		$dbuser=Featuregallery::find()->where(['featuregallery_id' =>$galleryid])->one();
    		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    		return $dbuser;
    
    	}
    }
    
    public function actionDeletegallerybyid($id){
    	$this->findModel($id)->delete();
    	return $this->redirect(['/feature-gallery']);
    }
}
