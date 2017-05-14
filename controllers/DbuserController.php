<?php

namespace app\controllers;

use Yii;
use app\models\DBUser;
use app\models\DBUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DbuserController implements the CRUD actions for DBUser model.
 */
class DbuserController extends Controller
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
     * Lists all DBUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DBUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DBUser model.
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
     * Creates a new DBUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DBUser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionLogin()
    {
    	$this->layout = 'login';
        $dbpass='';
    	$model = new DBUser();
    	$message='';
    	if ($model->load(Yii::$app->request->post())) {
    		
    		$dbuser=DBUser::find()->where(['email' => $model->email])->one();
             if($dbuser){
                $dbpass=$dbuser->password;
             }
           
			
    		if($dbpass==md5($model->password)){
                $session = Yii::$app->session;
                $session->set('loggeduser', $dbuser);
    			return $this->redirect(['/home']);
    		}else{
    			$message='Invalid email/Password';
    			return $this->render('login', [
    					'model' => $model,'message'=>$message
    			]);
    		}
    	} else {
    		return $this->render('login', [
    				'model' => $model,'message'=>$message
    		]);
    	}
    }
    
    
    public function actionUpdateuserinfo(){
    	$session = Yii::$app->session;
    	$id=$session->get('loggeduser')->id;
    	
    	if(Yii::$app->request->post()){
    		$data=Yii::$app->request->post();
    		 $model = $this->findModel($id);
    		 $model->username=$data['username'];
    		 $model->email=$data['email'];
    		 if($data['password']!=''){
    		 	$model->password=md5($data['password']);
    		 }
    		 
    		 $model->save();
    	}
    	
    }
    

    /**
     * Updates an existing DBUser model.
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
     * Deletes an existing DBUser model.
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
     * Finds the DBUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DBUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DBUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
