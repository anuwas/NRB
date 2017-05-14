<?php

namespace app\controllers;
use Yii;
use app\models\DBUser;
use app\models\Events;
use app\models\Appuser;
use yii\data\Pagination;
use app\models\Gallery;
use app\models\Contactus;
use app\models\Featuregallery;
use app\models\Eventcommentreply;
use app\models\Yearspan;
use yii\db\Command;
use app\models\Eventcomment;

class IndexController extends \yii\web\Controller
{
    public function actionHome()
    {
    	$query='';
    	$srcdata='';
    	$this->layout = 'nrb';
    	$data=Yii::$app->request->get();
    	$query = Appuser::find()->where(['not' , ['appuserid'=>null]]);
    	if($data){
    		if(isset($data['search'])){
    			$srcdata=$data['search'];
    			$query->andFilterWhere([ 'or',['like', 'username', $srcdata],['like', 'email', $srcdata],]);
    		}
    		$countQuery = clone $query;
    		
    	}else{
    		$query = Appuser::find()->where(['not' , ['appuserid'=>null]]);
    		$countQuery = clone $query;
    	}
    	
    	
    	$pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>15]);
    	$models = $query->offset($pages->offset)->limit($pages->limit)->all();
    	
    	
    	
    	return $this->render('index', [
    			'models' => $models,
    			'pages' => $pages,
    			'srcdata'=>$srcdata,
    	]);
        
    }
    public function actionProfile()
    {
    	$this->layout = 'nrb';
    	$session = Yii::$app->session;
    	$loggeduser = $session->get('loggeduser');
    	$dbuser=DBUser::find($loggeduser->id)->one();
    	$current_date=date("Y-m-d");
    	$current_event = Events::find()->where(['>=', 'event_date', $current_date])->all();
    	$allcommentsr=array();
    	$commentreply=array();
    	$selectedEventId='';
    	
    	/*
    	$comments=Events::find()->joinWith('eventcommentsuser')->where(['not' , ['events.eventid'=>null]])->all();
    	foreach ($comments as $values){
    		foreach ($values->eventcommentsuser as $cvalues){
    			$comment=$cvalues->comment;
    			$user=$cvalues->appuser->username;
    			$allcommentsr[]=array('user'=>$user,'comment'=>$comment);
    		}
    	}
    	*/
    	
    	if(isset($_REQUEST['eventid'])){
    		$selectedEventId=$_REQUEST['eventid'];
    		$replycomment=Eventcommentreply::find()->joinWith('appuser')->where(['eventcommentreply.eventid'=>$_REQUEST['eventid']])->all();
    		
    		$comments=Events::find()->joinWith('eventcommentsuser')->where(['events.eventid'=>$_REQUEST['eventid']])->all();
    		foreach ($comments as $values){
    			foreach ($values->eventcommentsuser as $cvalues){
    				$comment=$cvalues->comment;
    				$user=$cvalues->appuser->username;
    				$eventcommentid=$cvalues->eventcommentid;
    				$commentreply=Yii::$app->commentcomp->eventCommentReplyByCommentid($eventcommentid,$replycomment);
    				$allcommentsr[]=array('user'=>$user,'comment'=>$comment,'eventcommentid'=>$eventcommentid,'commentreply'=>$commentreply);
    			}
    		}
    	}else{
    		$current_event_one = Events::find()->where(['>=', 'event_date', $current_date])->orderBy('event_date')->one();
    		if($current_event_one){
    			$selectedEventId=$current_event_one->eventid;
    			$replycomment=Eventcommentreply::find()->joinWith('appuser')->where(['eventcommentreply.eventid'=>$selectedEventId])->all();
    			
    			
    			$comments=Events::find()->joinWith('eventcommentsuser')->where(['events.eventid'=>$current_event_one->eventid])->all();
    			foreach ($comments as $values){
    				foreach ($values->eventcommentsuser as $cvalues){
    					$comment=$cvalues->comment;
    					$user=$cvalues->appuser->username;
    					$eventcommentid=$cvalues->eventcommentid;
    					$commentreply=Yii::$app->commentcomp->eventCommentReplyByCommentid($eventcommentid,$replycomment);
    					$allcommentsr[]=array('user'=>$user,'comment'=>$comment,'eventcommentid'=>$eventcommentid,'commentreply'=>$commentreply);
    				}
    			}
    		}
    	}
    	 
    	
    	
    	
    	$allevents=Events::find()->all();
    	
    	$totalLike = (new \yii\db\Query())->from('events')->sum('total_like');
    	$totalComments = (new \yii\db\Query())->from('events')->sum('total_comment');
    	return $this->render('profile',['adminuser'=>$dbuser,'upcoming_events'=>$current_event,'comments'=>$allcommentsr,'totalLike'=>$totalLike,'totalComments'=>$totalComments,'allevents'=>$allevents,'selectedEventId'=>$selectedEventId]);
               
    }
    public function actionEvents()
    {
    	
    	$this->layout = 'nrb';
    	$current_date=date("Y-m-d");
    	
    	$current_event = Events::find()->where(['>=', 'event_date', $current_date])->orderBy('event_date')->all();
    	$past_event = Events::find()->where(['<', 'event_date', $current_date])->orderBy(['event_date'=> SORT_DESC])->all();
    	return $this->render('events',['current_event'=>$current_event,'past_event'=>$past_event]);
    }
    
    public function actionComments(){
    	$this->layout = 'nrb';
    	$session = Yii::$app->session;
    	$loggeduser = $session->get('loggeduser');
    	$dbuser=DBUser::find($loggeduser->id)->one();
    	$current_date=date("Y-m-d");
    	$current_event = Events::find()->where(['>=', 'event_date', $current_date])->all();
    	$allcommentsr=array();
    	$commentreply=array();
    	$selectedEventId='';
    	$unpublishcommentcounter=0; 
    	$unpublishcommensarr=array();
    	 
    	if(isset($_REQUEST['eventid'])){
    		$selectedEventId=$_REQUEST['eventid'];
    		$replycomment=Eventcommentreply::find()->joinWith('appuser')->where(['eventcommentreply.eventid'=>$_REQUEST['eventid']])->all();
    	
    		$comments=Events::find()->joinWith('eventcommentsuser')->where(['events.eventid'=>$_REQUEST['eventid']])->all();
    		foreach ($comments as $values){
    			foreach ($values->eventcommentsuser as $cvalues){
    				$comment=$cvalues->comment;
    				$publish=$cvalues->publish;
    				$user=$cvalues->appuser->username;
    				$eventcommentid=$cvalues->eventcommentid;
    				$commentreply=Yii::$app->commentcomp->eventCommentReplyByCommentid($eventcommentid,$replycomment);
    				$allcommentsr[]=array('user'=>$user,'comment'=>$comment,'publish'=>$publish,'eventcommentid'=>$eventcommentid,'commentreply'=>$commentreply);
    			}
    		}
    	}else{
    		$current_event_one = Events::find()->where(['>=', 'event_date', $current_date])->orderBy('event_date')->one();
    		if($current_event_one){
    			$selectedEventId=$current_event_one->eventid;
    			$replycomment=Eventcommentreply::find()->joinWith('appuser')->where(['eventcommentreply.eventid'=>$selectedEventId])->all();
    			 
    			 
    			$comments=Events::find()->joinWith('eventcommentsuser')->where(['events.eventid'=>$current_event_one->eventid])->all();
    			foreach ($comments as $values){
    				foreach ($values->eventcommentsuser as $cvalues){
    					$comment=$cvalues->comment;
    					$publish=$cvalues->publish;
    					$user=$cvalues->appuser->username;
    					$eventcommentid=$cvalues->eventcommentid;
    					$commentreply=Yii::$app->commentcomp->eventCommentReplyByCommentid($eventcommentid,$replycomment);
    					$allcommentsr[]=array('user'=>$user,'comment'=>$comment,'publish'=>$publish,'eventcommentid'=>$eventcommentid,'commentreply'=>$commentreply);
    				}
    			}
    		}
    		
    		$unpublishcommens=Events::find()->joinWith('eventcomments')->joinWith('eventcommentreplies')->all();
    		
    		$unpublishcommensarr=array();
    		foreach ($unpublishcommens as $value) {
    			$commentarr=array();
    			$replyarr=array();
    			$chkevent=0;
    			foreach ($value->eventcomments as $cvalues){
    				
    				if($cvalues->publish==0){
    					array_push($commentarr, $cvalues->comment);
    					$unpublishcommentcounter++;
    					$chkevent=1;
    				}
    				
    			}
    			foreach ($value->eventcommentreplies as $cvalues){
    				if($cvalues->publish==0){
    					array_push($replyarr, $cvalues->comment);
    					$unpublishcommentcounter++;
    					$chkevent=1;
    				}
    				
    			}
    			if($chkevent==1){
    				$unpublishcommensarr[$value->event_name]=array('comments'=>$commentarr,'commentsreply'=>$replyarr);
    			}
    			
    		}    		
    		
    	}
    	 
    	 
    	$allevents=Events::find()->all();
    	 
    	$totalLike = (new \yii\db\Query())->from('events')->sum('total_like');
    	$totalComments = (new \yii\db\Query())->from('events')->sum('total_comment');
    	return $this->render('comments',
    			['adminuser'=>$dbuser,
    					'upcoming_events'=>$current_event,
    					'comments'=>$allcommentsr,
    					'totalLike'=>$totalLike,
    					'totalComments'=>$totalComments,
    					'allevents'=>$allevents,
    					'selectedEventId'=>$selectedEventId,
    					'unpublishcommentcounter'=>$unpublishcommentcounter,
    					'unpublishcomments'=>$unpublishcommensarr
    			]);
    }
    public function actionUsers()
    {
    	$query='';
    	$srcdata='';
    	$this->layout = 'nrb';
    	$data=Yii::$app->request->get();
    	$query = Appuser::find()->where(['not' , ['appuserid'=>null]]);
    	if($data){
    		if(isset($data['search'])){
    			$srcdata=$data['search'];
    			$query->andFilterWhere([ 'or',['like', 'username', $srcdata],['like', 'email', $srcdata],]);
    		}
    		
    		$countQuery = clone $query;
    		
    	}else{
    		$query = Appuser::find()->where(['not' , ['appuserid'=>null]]);
    		$countQuery = clone $query;
    	}
    	
    	
    	$pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>15]);
    	$models = $query->offset($pages->offset)->limit($pages->limit)->all();
    	
    	
    	
    	return $this->render('users', [
    			'models' => $models,
    			'pages' => $pages,
    			'srcdata'=>$srcdata,
    	]);
    	
    	
    }
    
    public function actionLogout(){
    	$session = Yii::$app->session;
    	$session->remove('loggeduser');
    	$session->destroy();
    	$this->redirect(['dbuser/login']);
    }
    
    public function actionShowgallery(){
    	$this->layout = 'nrb';
    	$data=Yii::$app->request->get();
    	$searchid='all';
    	$query=Gallery::find()->joinWith('yearspan')->orderBy(['yearspan.year_start' => SORT_ASC]);
    	if(isset($data['searchyearspanid']))
    	{
    		$searchid=$data['searchyearspanid'];
    		if($data['searchyearspanid']!='all'){
    			$query=Gallery::find()->joinWith('yearspan')->where(['gallery.yearspanid' => $data['searchyearspanid']]);
    		}
    	}
    	
    	$countQuery = clone $query;
    	
    	$pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>15]);
    	$gallerdata = $query->offset($pages->offset)->limit($pages->limit)->all();
    	
    	$yesarspan=Yearspan::find()->orderBy(['year_start' => SORT_DESC])->all();
    	
    	
    	return $this->render('gallery',['gallerdata'=>$gallerdata,'pages' => $pages,'yesarspan'=>$yesarspan,'searchid'=>$searchid]);
    }
    
    public function actionFeaturegallery()
    {
    	$this->layout = 'nrb';
    	$query=Featuregallery::find()->orderBy(['featuregallery_id' => SORT_DESC]);
    	$countQuery = clone $query;
    	 
    	$pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>15]);
    	$gallerdata = $query->offset($pages->offset)->limit($pages->limit)->all();
    	 
    	return $this->render('featuregallery',['gallerdata'=>$gallerdata,'pages' => $pages,]);
    }
    
	public function actionFblogin(){
		$this->layout = 'empty';
		return $this->render('fblogin');
		
    }
    
    public function actionContactus(){
    	$this->layout = 'nrb';
    	$query='';
    	$this->layout = 'nrb';
    	$query=Contactus::find()->orderBy(['contactusid' => SORT_DESC]);
    	$countQuery = clone $query;
    	$pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>15]);
    	$models = $query->offset($pages->offset)->limit($pages->limit)->all();
    	 
    	return $this->render('contactus', [
    			'models' => $models,
    			'pages' => $pages
    	]);
    	
    
    }
    
    public function actionYearspan(){
    	$this->layout = 'nrb';
    	$query=Yearspan::find()->orderBy(['year_start' => SORT_DESC]);
    	$countQuery = clone $query;
    	$pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>15]);
    	$models = $query->offset($pages->offset)->limit($pages->limit)->all();
    	 
    	return $this->render('yearspan', [
    			'models' => $models,
    			'pages' => $pages
    	]);
    	
    }
    
    public function actionTotalunpublishcomment(){
    	
    	$toalcomment=Eventcomment::find()->where(['publish' => 0])->count();
    	$toalcommentreplay=Eventcommentreply::find()->where(['publish' => 0])->count();
    	$total=($toalcomment+$toalcommentreplay);
    	echo $total;
    }

}
