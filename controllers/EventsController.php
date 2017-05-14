<?php

namespace app\controllers;

use Yii;
use app\models\Events;
use app\models\EventsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Event;
use yii\web\UploadedFile;
use app\models\UploadForm;
use app\models\Eventcommentreply;

/**
 * EventsController implements the CRUD actions for Events model.
 */
class EventsController extends Controller
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
     * Lists all Events models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Events model.
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
     * Creates a new Events model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Events();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->eventid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function beforeAction($action)
    {
    	if ($action->id == 'newevent') {
    		$this->enableCsrfValidation = false;
    	}
    	if ($action->id == 'uploadimg') {
    		$this->enableCsrfValidation = false;
    	}
    	if ($action->id == 'updateevent') {
    		$this->enableCsrfValidation = false;
    	}
    	
    	if ($action->id == 'neweventprofile') {
    		$this->enableCsrfValidation = false;
    	}
    	
    	if ($action->id == 'updateeventprofile') {
    		$this->enableCsrfValidation = false;
    	}
    	
    	if ($action->id == 'deleteprofileeventbyid') {
    		$this->enableCsrfValidation = false;
    	}
    	
    	
    	
    
    	return parent::beforeAction($action);
    }
    
    public function actionNewevent()
    {
    	/* $userid=Yii::app()->session['user_id'];
    	$model=Users::model()->findByPk($userid);
    	$oldpassword=$model->pass_word;
    	if(isset($_POST['Users']))
    	{
    		$model->attributes=$_POST['Users'];
    		$image_before_post = $model->profile_picture;
    		$image_before_post_logo = $model->customer_logo;
    		$rnd  = rand(0,9999);
    		$uploadedFile_app_icon=CUploadedFile::getInstance($model,'profile_picture');
    		if($uploadedFile_app_icon)
    		{
    			$fileName_icon = "{$rnd}-{$uploadedFile_app_icon}";
    			$model->profile_picture = $fileName_icon;
    			$uploadedFile_app_icon->saveAs(Yii::app()->basePath.'/../upload/profile/'.$fileName_icon);
    			$image = Yii::app()->image->load(Yii::app()->basePath.'/../upload/profile/'.$fileName_icon);
    			$image->resize(196, 196);
    			$image->save(Yii::app()->basePath.'/../upload/profile/thumb/'.$fileName_icon);
    		}
    		else
    		{
    			$model->profile_picture = $image_before_post;
    		} */
    	
    	
    	$imgmodel = new UploadForm();
    	$model = new Events();
    	if (Yii::$app->request->isPost) {
    		$data = Yii::$app->request->post();
    		
    		$uploadedfile = UploadedFile::getInstance($imgmodel, 'myimageFile');
    		if($uploadedfile){
    			$imgmodel->imageFile=$uploadedfile;
    			$filename=$imgmodel->upload();
    			$model->event_image=$filename;
    		}else{
    			$model->event_image='avatar.jpg';
    		}
    	
    		
    		$model->user_id=1;
    		$model->event_date=$data['event_date'];
    		$model->event_name=$data['event_name'];
    		
    		
    		$model->save(); 
    		
    		return $this->redirect(['/events']);
    		
    	}
    	
    }
    
    public function actionUpdateevent(){
    	$imgmodel = new UploadForm();
    	
    	if (Yii::$app->request->isPost) {
    		$data = Yii::$app->request->post();
    		$model=$this->findModel($data['eventid']);
    		$uploadedfile = UploadedFile::getInstance($imgmodel, 'myimageFile');
    		if($uploadedfile){
    			
    			$imgmodel->imageFile=$uploadedfile;
    			$filename=$imgmodel->upload();
    			$model->event_image=$filename;
    		}
    		$model->user_id=1;
    		$model->event_date=$data['edit_event_date'];
    		$model->event_name=$data['edit_event_name'];
    		
    	
    		$model->save();
    	
    		return $this->redirect(['/events']);
    	
    	}
    }
    
    public function actionNeweventprofile()
    {
    	
    	 
    	$imgmodel = new UploadForm();
    	$model = new Events();
    	if (Yii::$app->request->isPost) {
    		$data = Yii::$app->request->post();
    
    		$uploadedfile = UploadedFile::getInstance($imgmodel, 'myimageFile');
    		if($uploadedfile){
    			$imgmodel->imageFile=$uploadedfile;
    			$filename=$imgmodel->upload();
    			$model->event_image=$filename;
    		}else{
    			$model->event_image='avatar.jpg';
    		}
    		 
    
    		$model->user_id=1;
    		$model->event_date=$data['event_date'];
    		$model->event_name=$data['event_name'];
    
    
    		$model->save();
    
    		return $this->redirect(['/profile']);
    
    	}
    	 
    }
    
    public function actionUpdateeventprofile(){
    	$imgmodel = new UploadForm();
    	 
    	if (Yii::$app->request->isPost) {
    		$data = Yii::$app->request->post();
    		$model=$this->findModel($data['eventid']);
    		$uploadedfile = UploadedFile::getInstance($imgmodel, 'myimageFile');
    		if($uploadedfile){
    			 
    			$imgmodel->imageFile=$uploadedfile;
    			$filename=$imgmodel->upload();
    			$model->event_image=$filename;
    		}
    		$model->user_id=1;
    		$model->event_date=$data['edit_event_date'];
    		$model->event_name=$data['edit_event_name'];
    
    		$model->save();
    		 
    		return $this->redirect(['/profile']);
    	}
    }
    
    public function actionUploadimg()
    {
    	
    	$model = new UploadForm();
    
    	if (Yii::$app->request->isPost) {
    		$model->imageFile = UploadedFile::getInstance($model, 'myimageFile');
    		
    		if ($model->upload()) {
    			// file is uploaded successfully
    			return;
    		}
    	}
    
    	return $this->render('upload', ['model' => $model]);
    }
    
    public function actionGeteventbyid(){
    	$model=new Events();
    	if (Yii::$app->request->isAjax) {
    		$data = Yii::$app->request->get();
    		$eventid=$data['eventid'];
    		
     		$dbuser=Events::find()->where(['eventid' =>$eventid])->one();
     		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
     		return $dbuser;
 
    	}
    }
    
    public function actionGeteventlikeuserbyeventid(){
    	$model=new Events();
    	$arr=array();
    	if (Yii::$app->request->isAjax) {
    		$data = Yii::$app->request->get();
    		$eventid=$data['eventid'];
    
    		$dbuser=Events::find()->joinWith('eventlikesuser')->where(['events.eventid'=>$eventid])->all();
    		foreach ($dbuser as $values){
    			foreach ($values->eventlikesuser as $avalues){
    				array_push($arr, $avalues->appuser->username);
    				
    			}
    			
    		}
    		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    		return $arr;
    
    	}
    }
    
    public function actionGeteventcommentuserbyeventid(){
    	$model=new Events();
    	$arr=array();
    	$commentreply=array();
    	if (Yii::$app->request->isAjax) {
    		$data = Yii::$app->request->get();
    		$eventid=$data['eventid'];
    
    	$commentarr=array();
    	
    	$replycomment=Eventcommentreply::find()->joinWith('appuser')->where(['eventcommentreply.eventid'=>$eventid])->all();
    	$dbuser=Events::find()->joinWith('eventcommentsuser')->where(['events.eventid'=>$eventid])->all();
    	foreach ($dbuser as $values){
    		foreach ($values->eventcommentsuser as $cvalues){
    			$comment=$cvalues->comment;
    			$user=$cvalues->appuser->username;
    			$eventcommentid=$cvalues->eventcommentid;
    			$commentreply=Yii::$app->commentcomp->eventCommentReplyByCommentid($eventcommentid,$replycomment);
    			$commentarr[]=array('user'=>$user,'comment'=>$comment,'commentreply'=>$commentreply);
    		}
    	}
    	
    		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    		return $commentarr;
    
    	}
    }
    
    public function actionDeleteeventbyid($id){
    	$this->findModel($id)->delete();
    	return $this->redirect(['/events']);
    }
    
    public function actionDeleteeventbyidajax(){
    	$status=array();
    	$model=new Events();
    	if (Yii::$app->request->isAjax) {
    		$data = Yii::$app->request->get();
    		$eventid=$data['eventid'];
    		
    		if($this->findModel($eventid)->delete())    
    		{
    			$status=array('action'=>'success');
    		}else{
    			$status=array('action'=>'fail');
    		}
    	}
    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	return $status;
    }
    
    public function actionDeleteprofileeventbyid($id){
    	$this->findModel($id)->delete();
    	return $this->redirect(['/profile']);
    }
    
    public function actionImageupload()
    {
    	$model = new ResourceManager();
        $uploadPath = Yii::getAlias('@root') .'/uploads/';

        if (isset($_FILES['image'])) {
            $file = \yii\web\UploadedFile::getInstanceByName('images');
          $original_name = $file->baseName;  
          $newFileName = \Yii::$app->security
                            ->generateRandomString().'.'.$file->extension;
           // you can write save code here before uploading.
            if ($file->saveAs($uploadPath . '/' . $newFileName)) {
                $model->image = $newFileName;
                $model->original_name = $original_name;
                if($model->save(false)){
                    echo \yii\helpers\Json::encode($file);
                }
                else{
                    echo \yii\helpers\Json::encode($model->getErrors());
                }

            }
        }
        else {
            return $this->render('upload', [
                'model' => $model,
            ]);
        }

        return false;
    	
    	 
    }
    
    

    /**
     * Updates an existing Events model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->eventid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Events model.
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
     * Finds the Events model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Events the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Events::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionIncrementcoumentcounter(){
    	if(Yii::$app->request->post()){
    		$data=Yii::$app->request->post();
    		$model = $this->findModel($data['enventid']);
    		$count=($model->total_comment)+1;
    		$model->total_comment=$count;
    		$model->save();
    	}
    	
    	/* $eventmodel=Events::findOne(['eventid'=>$input['eventId']]);
    	 $count=($eventmodel->total_comment)+1;
    	 $eventmodel->total_comment=$count;
    	 $eventmodel->save(); */
    }
    
    public function actionDecrementcomentcounter(){
    	if(Yii::$app->request->post()){
    		$data=Yii::$app->request->post();
    		$model = $this->findModel($data['enventid']);
    		$count=($model->total_comment)-1;
    		$model->total_comment=$count;
    		$model->save();
    	}
    }
}
