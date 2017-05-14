<?php

namespace app\controllers;

use Yii;
use app\models\Test;
use app\models\TestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Events;
use yii\helpers\BaseUrl;
use yii\helpers\Url;
use app\models\Gallery;
use app\models\Eventlike;
use app\models\Eventcomment;
use app\models\Eventcommentreply;
use app\models\Yearspan;

/**
 * TestController implements the CRUD actions for Test model.
 */
class TestController extends Controller
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
     * Lists all Test models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Test model.
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
     * Creates a new Test model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionQtest()
    {
    	/*
    	 * comments with user
    	Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$current_date=date("Y-m-d");
		$retun=array();
		$past_event = Events::find()->joinWith('eventcommentsuser')->where(['>', 'event_date', $current_date])->orderBy('event_date')->all();
	
		 foreach ($past_event as $values){
			$allcomments=array();
			$allerss=array();
			
			foreach ($values->eventcommentsuser as $cvalues){				
				$allcomments[]=array('comment'=>$cvalues->comment,'userID'=>$cvalues->appuserid,'userName'=>$cvalues->appuser->username,'commentId'=>$cvalues->eventcommentid);
			}
			$retun[]=array('eventId'=>$values->eventid,'eventName'=>$values['event_name'],'eventDate'=>$values['event_date'],'eventImage'=>Url::home(true).'uploads/'.$values->event_image,'comments'=>$values['total_comment'],'allComments'=>$allcomments,'likes'=>$values['total_like']);
		} 
	
		print_r(json_encode($retun));
		$eventid=1;
    	$commentarr=array();
    	$dbuser=Events::find()->joinWith('eventcommentsuser')->where(['events.eventid'=>$eventid])->all();
    	foreach ($dbuser as $values){
    		foreach ($values->eventcommentsuser as $cvalues){
    			$comment=$cvalues->comment;
    			$user=$cvalues->appuser->username;
    			$commentarr[]=array('user'=>$user,'comment'=>$comment);
    		}
    	}
    	
    	print_r($commentarr);
		*/
    	
    	//$eventlikeCount = Eventlike::findOne(['eventid' => 2,'appuserid'=>2]);
    	//echo count($eventlikeCount);
		
		//print_r(json_encode($retun));
		//print_r($eventlikeCount->eventlikeid);
		//$comments=Events::find()->joinWith('eventcommentsuser')->where(['events.eventid'=>1])->all();
    	
    	header('Content-type: application/json');
    	//Yii::$app->servicecomp->showGallery();
    	Yii::$app->servicecomp->getSlider();
    }
    public function actionCreate()
    {
        $model = new Test();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            echo 'in post';
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Test model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Test model.
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
     * Finds the Test model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Test the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Test::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
