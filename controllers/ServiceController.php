<?php

namespace app\controllers;
use Yii;
use yii\filters\Cors;
use app\models\Appuser;
use app\components\ServiceValidationComponent;

class ServiceController extends \yii\web\Controller
{
	public function behaviors()
	{
		return array_merge([
				'cors' => [
						'class' => Cors::className(),
						#special rules for particular action
						'actions' => [
								'registeruser' => [
										#web-servers which you alllow cross-domain access
										'Origin' => ['*'],
										'Access-Control-Request-Method' => ['POST'],
										'Access-Control-Request-Headers' => ['*'],
										'Access-Control-Allow-Credentials' => null,
										'Access-Control-Max-Age' => 86400,
										'Access-Control-Expose-Headers' => [],
								],
								'call' => [
										#web-servers which you alllow cross-domain access
										'Origin' => ['*'],
										'Access-Control-Request-Method' => ['POST'],
										'Access-Control-Request-Headers' => ['*'],
										'Access-Control-Allow-Credentials' => null,
										'Access-Control-Max-Age' => 86400,
										'Access-Control-Expose-Headers' => [],
								],
						],
						#common rules
						'cors' => [
								'Origin' => [],
								'Access-Control-Request-Method' => [],
								'Access-Control-Request-Headers' => [],
								'Access-Control-Allow-Credentials' => null,
								'Access-Control-Max-Age' => 0,
								'Access-Control-Expose-Headers' => [],
						]
				],
		], parent::behaviors());
	}
	
	public function beforeAction($action)
	{
		if ($action->id == 'registeruser') {
			$this->enableCsrfValidation = false;
		}
		if ($action->id == 'call') {
			$this->enableCsrfValidation = false;
		}
		
	
		return parent::beforeAction($action);
	}
	
    public function actionIndex()
    {
    	/*
    	$this->layout = 'nrb';
       // return $this->render('index');
        /* echo "<br>";
       echo base64_encode(date('Y-m-d-h-m-s')."-1");
       echo "<br>";
       echo base64_decode("MjAxNy0wNC0wOC0wNy0wNC0wNDE=");
       echo "<br>"; 
       $str=date('Y-m-d-h-m-s').'-'."11";
       $sv = new ServiceValidationComponent();
       echo ServiceValidationComponent::encodeUserId(11);
       echo $sv->decodeUserId("11"); 
       */
        
    }
    
    public function actionRegisteruser()
    { 
    	Yii::info('Inside ServiceController.actionRegisteruser', 'service');
    	/* if(Yii::$app->request->post()){
    		$data = Yii::$app->request->post();
    		//
    		echo 'aa';
    	} */
    	try{
    		header('Content-type: application/json');
    		$inputJSON = file_get_contents('php://input');
    		Yii::info('ServiceController.actionRegisteruser Request parameter ['.$inputJSON.']', 'service');
    		Yii::$app->servicecomp->register($inputJSON);
    	}catch(Exception $ex){
    		Yii::error('Exception inside ServiceController.actionRegisteruser ['.$ex.']', 'service');
    	}
    	
    	
    }
    
    public function actionCall(){
    	Yii::info('Inside ServiceController.actionCall', 'service');
    	header('Content-type: application/json');
    	$inputJSON = file_get_contents('php://input');
    	$input= json_decode( $inputJSON, TRUE );
    	Yii::info('ServiceController.actionCall with parameter ['.$inputJSON.']', 'service');
    	switch ($input['action']){
    		case 'login':
    			Yii::info('Calling ServiceComponent.Login ', 'service');
    			Yii::$app->servicecomp->Login($input);
    			break;
    		case 'pastevent':
    			Yii::info('Calling ServiceComponent.PastEvent ', 'service');
    			Yii::$app->servicecomp->PastEvent($inputJSON);
    			break;
    		case 'currentevent':
    			Yii::info('Calling ServiceComponent.CurrentEvent ', 'service');
    			Yii::$app->servicecomp->CurrentEvent();
    			break;
    		case 'upcomingevent':
    			Yii::info('Calling ServiceComponent.UpcomingEvent ', 'service');
    			Yii::$app->servicecomp->UpcomingEvent($inputJSON);
    			break;
    		case 'gallery':
    			Yii::info('Calling ServiceComponent.showGallery ', 'service');
    			Yii::$app->servicecomp->showGallery();
    			break;
    		case 'featuregallery':
    			Yii::info('Calling ServiceComponent.showFeatureGallery ', 'service');
    			Yii::$app->servicecomp->showGallery();
    			break;
    		case 'getslider':
    			Yii::info('Calling ServiceComponent.getSlider ', 'service');
    			Yii::$app->servicecomp->getSlider();
    			break;
    		case 'eventlike':
    			Yii::info('Calling ServiceComponent.likeEvent ', 'service');
    			Yii::$app->servicecomp->likeEvent($inputJSON);
    			break;
    		case 'eventunlike':
    			Yii::info('Calling ServiceComponent.UnlikeEvent ', 'service');
    			Yii::$app->servicecomp->UnlikeEvent($inputJSON);
    			break;
    		case 'eventcomment':
    			Yii::info('Calling ServiceComponent.CommentEvent ', 'service');
    			Yii::$app->servicecomp->CommentEvent($inputJSON);
    			break;
    		case 'deletecomment':
    			Yii::info('Calling ServiceComponent.deleteComment ', 'service');
    			Yii::$app->servicecomp->deleteComment($inputJSON);
    			break;
    		case 'contactus':
    			Yii::info('Calling ServiceComponent.contactUs ', 'service');
    			Yii::$app->servicecomp->contactUs($inputJSON);
    			break;
    		case 'checkuser':
    			Yii::info('Calling ServiceComponent.checkUser ', 'service');
    			Yii::$app->servicecomp->checkUser($inputJSON);
    			break;
    	}
    }
    
    public function actionTest(){
    	$model=Appuser::findOne(['email'=>'anupam@gmail.com']);
    	print_r($model);
    	
    }

}
