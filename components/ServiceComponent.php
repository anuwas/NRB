<?php
namespace app\components;


use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use app\models\Appuser;
use app\models\Events;
use yii\helpers\Url;
use app\models\Gallery;
use app\models\Eventlike;
use app\models\Eventcomment;
use app\models\Contactus;
use app\models\Featuregallery;
use app\models\Eventcommentreply;
use app\models\Yearspan;

class ServiceComponent extends Component
{
	public function register($inputJSON){
		Yii::info('Inside ServiceComponent.register', 'service');
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		
			
		$input= json_decode( $inputJSON, TRUE ); //convert JSON into array
		
		try {
			$model = Appuser::find()->where(['email' => $input['emailAddress']])->count();
			Yii::info('Check email exist or not from App user ', 'service');
			if($model>0){
				Yii::info('Email already exist, user cannot be register ', 'service');
				$retun=array('action'=>'already-registered','status'=>'fail');
			}else{
				$model=new Appuser();
				$model->email=$input['emailAddress'];
				$model->username=$input['fullName'];
				$model->phone=$input['phoneNumber'];
				$model->password=hash("SHA256", $input['password']);
					
				if($model->save()){
					$retun=array('action'=>'registered','status'=>'success');
				}
				Yii::info('ServiceComponent.register saving value to the Appuser ', 'service');
			}
		} catch (Exception $e) {
			Yii::error('Exception inside ServiceComponent.register ['.$e.']', 'service');
			$retun=array('action'=>'Exception Occued','status'=>'fail');
		}
		
		Yii::info('Rendering from ServiceComponent.register with status ['.json_encode($retun).']', 'service');
		print_r(json_encode($retun)); 
	}
	
	public function Login($input){
		Yii::info('Inside ServiceComponent.Login', 'service');
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$retun=array();
		$email=$input['emailAddress'];
		try {
			Yii::info('Checking email exist or not from Appuser', 'service');
			$model=Appuser::findOne(['email'=>$email]);
			if($model){
				$retun=$model->password;
				if($model->password==hash("SHA256", $input['password'])){
					Yii::info('Login credential match', 'service');
					$retun=array('action'=>'login','status'=>'success','appUserID'=>ServiceValidationComponent::encodeUserId($model->appuserid));
				}else{
					Yii::info('Login credential not match', 'service');
					$retun=array('action'=>'password-not-match','status'=>'fail');
				}
			}else{
				Yii::info('Email id does not exist', 'service');
				$retun=array('action'=>'email-not-exist','status'=>'fail');
			}
		} catch (Exception $e) {
			Yii::error('Exception ServiceComponent.Login ['.$e.']', 'service');
			$retun=array('action'=>'Exception Occued','status'=>'fail');
		}
		
		Yii::info('Rendering from ServiceComponent.Login with status ['.json_encode($retun).']', 'service');
		print_r(json_encode($retun)); 
	}
	
	public function PastEvent($inputJSON){
		Yii::info('Inside ServiceComponent.PastEvent', 'service');
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$input= json_decode( $inputJSON, TRUE );
		if(!isset($input['appUserId'])){
			$retun=array('action'=>'appUserId Missing','status'=>'fail');
			Yii::info('appUserId Missing ServiceComponent.PastEvent', 'service');
		}else{
			$current_date=date("Y-m-d");
			$retun=array();
			try {
				Yii::info('getting past events', 'service');
				$past_event = Events::find()->joinWith('eventcomments')->joinWith('eventlikes')->where(['<', 'event_date', $current_date])->orderBy('event_date')->all();
				
				$comments=Eventcomment::find()->joinWith('appuser')->where(['publish' => 1])->all();
				
				$replycomment=Eventcommentreply::find()->joinWith('appuser')->where(['publish' => 1])->all();
				
				foreach ($past_event as $values){
					$allcomments=array();
					$userlikestatus=0;
					$commentDetail=array();
					foreach ($values->eventcomments as $cvalues){
						if($cvalues->publish==1 || $cvalues->appuserid==ServiceValidationComponent::decodeUserId($input['appUserId'])){
							array_push($allcomments, $cvalues->comment);
						}
						
						//$allcomments[]=array('comment'=>$cvalues->comment,'userID'=>$cvalues->appuserid,'commentId'=>$cvalues->eventcommentid);
					}
					foreach ($values->eventlikes as $lvalue) {
						if($lvalue->appuserid== ServiceValidationComponent::decodeUserId($input['appUserId'])){
							$userlikestatus=1;
						}
					}
					$commentDetail=Yii::$app->commentcomp->generateCommentWithReply($values->eventid,$comments,$replycomment);
					
					$retun[]=array('eventId'=>$values->eventid,'eventName'=>$values['event_name'],'eventDate'=>$values['event_date'],'eventImage'=>Url::home(true).'uploads/event/'.$values->event_image,'comments'=>$values['total_comment'],'allComments'=>$allcomments,'likes'=>$values['total_like'],'currentUserIsLike'=>$userlikestatus,'commentDetail'=>$commentDetail);
				}
			} catch (Exception $e) {
				Yii::error('Exception occured in ServiceComponent.PastEvent ['.$e.']', 'service');
				$retun=array('action'=>'Exception Occued','status'=>'fail');
			}
		}
		
    	
		Yii::info('Rendering from ServiceComponent.PastEvent with status ['.json_encode($retun).']', 'service');
		print_r(json_encode($retun));
	}
	
	public function UpcomingEvent($inputJSON){
		Yii::info('Inside ServiceComponent.UpcomingEvent', 'service');
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$input= json_decode( $inputJSON, TRUE );
		if(!isset($input['appUserId'])){
			$retun=array('action'=>'appUserId Missing','status'=>'fail');
			Yii::info('appUserId Missing ServiceComponent.UpcomingEvent', 'service');
		}else{
			$current_date=date("Y-m-d");
			$retun=array();
			try {
				Yii::info('Getting ServiceComponent.UpcomingEvent', 'service');
				$comments=Eventcomment::find()->joinWith('appuser')->where(['publish' => 1])->all();
				$replycomment=Eventcommentreply::find()->joinWith('appuser')->where(['publish' => 1])->all();
				
				
				$past_event = Events::find()->joinWith('eventcomments')->joinWith('eventlikes')->where(['>', 'event_date', $current_date])->orderBy('event_date')->all();
				foreach ($past_event as $values){
					$allcomments=array();
					$userlikestatus=0;
					$commentDetail=array();
					foreach ($values->eventcomments as $cvalues){
						if($cvalues->publish==1 || $cvalues->appuserid== ServiceValidationComponent::decodeUserId($input['appUserId']) ){
							array_push($allcomments, $cvalues->comment);
						}
						
						//$allcomments[]=array('comment'=>$cvalues->comment,'userID'=>$cvalues->appuserid,'commentId'=>$cvalues->eventcommentid);
					}
					foreach ($values->eventlikes as $lvalue) {
						if($lvalue->appuserid== ServiceValidationComponent::decodeUserId($input['appUserId'])){
							$userlikestatus=1;
						}
					}
					
					$commentDetail=Yii::$app->commentcomp->generateCommentWithReply($values->eventid,$comments,$replycomment);
					
					$retun[]=array('eventId'=>$values->eventid,'eventName'=>$values['event_name'],'eventDate'=>$values['event_date'],'eventImage'=>Url::home(true).'uploads/event/'.$values->event_image,'comments'=>$values['total_comment'],'allComments'=>$allcomments,'likes'=>$values['total_like'],'currentUserIsLike'=>$userlikestatus,'commentDetail'=>$commentDetail);
				}
			} catch (Exception $e) {
				Yii::error('Exception inside ServiceComponent.UpcomingEvent ['.$e.']', 'service');
				$retun=array('action'=>'Exception Occued','status'=>'fail');
			}
		}
		
	
		Yii::info('Rendering from ServiceComponent.UpcomingEvent with status ['.json_encode($retun).']', 'service');
		print_r(json_encode($retun));
	}
	
	public function CurrentEvent(){
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$current_date=date("Y-m-d");
		$retun=array();
		$past_event = Events::find()->joinWith('eventcomments')->where(['>=', 'event_date', $current_date])->orderBy('event_date')->one();
	
		$retun=array('eventId'=>$past_event->eventid,'eventName'=>$past_event['event_name'],'eventDate'=>$past_event['event_date'],'eventImage'=>Url::home(true).'uploads/event/'.$past_event->event_image,'comments'=>$past_event['total_comment'],'allComments'=>$past_event->eventcomments,'likes'=>$past_event['total_like']);
	
		print_r(json_encode($retun));
	}
	

	
	public function showGallery(){
		Yii::info('Inside ServiceComponent.showGallery', 'service');
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		try {
			Yii::info('Getting gallery from db ', 'service');
			
			//$gallery=Gallery::find()->all();
			$yearapan=Yearspan::find()->joinWith('galleries')->orderBy(['year_start' => SORT_ASC])->all();
			
			
			foreach ($yearapan as $value) {
				$gallery=array();
				foreach ($value->galleries as $gvalue) {
					$gallery[]=array('galleryImage'=>Url::home(true).'uploads/gallery/'.$gvalue->image,'imageTitle'=>$gvalue->image_title,'imageAlt'=>$gvalue->image_alt);
				}
				$retun[$value->year_start.'-'.$value->year_end]=$gallery;
			}
			
			/* foreach ($gallery as $values) {
				$retun[]=array('galleryImage'=>Url::home(true).'uploads/gallery/'.$values->image,'imageTitle'=>$values->image_title,'imageAlt'=>$values->image_alt);
			} */
		} catch (Exception $e) {
			Yii::error('Exception inside ServiceComponent.showGallery ['.$e.']', 'service');
			$retun=array('action'=>'Exception Occued','status'=>'fail');
		}
		
		Yii::info('Rendering from ServiceComponent.showGallery with status ['.json_encode($retun).']', 'service');
		print_r(json_encode($retun));
	}
	
	public function showFeatureGallery(){
		Yii::info('Inside ServiceComponent.showFeatureGallery', 'service');
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		try {
			Yii::info('Getting showFeatureGallery from db ', 'service');
			
			$gallery=Featuregallery::find()->all();
			foreach ($gallery as $values) {
				$retun[]=array('galleryImage'=>Url::home(true).'uploads/featuregallery/'.$values->image,'imageTitle'=>$values->image_title,'imageAlt'=>$values->image_alt);
			}
		} catch (Exception $e) {
			Yii::error('Exception inside ServiceComponent.showFeatureGallery ['.$e.']', 'service');
			$retun=array('action'=>'Exception Occued','status'=>'fail');
		}
	
		Yii::info('Rendering from ServiceComponent.showFeatureGallery with status ['.json_encode($retun).']', 'service');
		print_r(json_encode($retun));
	}
	
	public function getSlider(){
		Yii::info('Inside ServiceComponent.getSlider', 'service');
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		try {
			Yii::info('Getting getSlider from db ', 'service');
				
			$gallery=Gallery::findAll(['slider'=>'1']);
			foreach ($gallery as $values) {
				$retun[]=array('galleryImage'=>Url::home(true).'uploads/gallery/'.$values->image,'imageTitle'=>$values->image_title,'imageAlt'=>$values->image_alt);
			}
		} catch (Exception $e) {
			Yii::error('Exception inside ServiceComponent.getSlider ['.$e.']', 'service');
			$retun=array('action'=>'Exception Occued','status'=>'fail');
		}
	
		Yii::info('Rendering from ServiceComponent.getSlider with status ['.json_encode($retun).']', 'service');
		print_r(json_encode($retun));
	}
	
	public function likeEvent($inputJSON){
		Yii::info('Inside ServiceComponent.likeEvent', 'service');
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$input= json_decode( $inputJSON, TRUE );
		
		if(!isset($input['appUserId']) || !isset($input['eventId'])){
			$retun=array('action'=>'value-missing','status'=>'fail');
			Yii::info('Appuser id and event id not found ServiceComponent.likeEvent', 'service');
		}else{
			
			try {
				Yii::info('Getting event like from event like', 'service');
				//$eventlikeCount = Eventlike::find()->where(['eventid' => $input['eventId'],'appuserid'=>$input['appUserId']])->count();
				$eventlikeCount=Eventlike::findOne(['eventid' => $input['eventId'],'appuserid'=>ServiceValidationComponent::decodeUserId($input['appUserId'])]);
				if(count($eventlikeCount)>0){
					$eventmodel=Events::findOne(['eventid'=>$input['eventId']]);
					$retun=array('action'=>'Already Liked','status'=>'success','totalLike'=>$eventmodel->total_like);
				}else{
					Yii::info('User Like the event', 'service');
					$eventlike=new Eventlike();
					$eventlike->eventid=$input['eventId'];
					$eventlike->appuserid=ServiceValidationComponent::decodeUserId($input['appUserId']);
					$eventlike->save();
					$eventmodel=Events::findOne(['eventid'=>$input['eventId']]);
					$count=($eventmodel->total_like)+1;
					$eventmodel->total_like=$count;
					$eventmodel->save();
					$retun=array('action'=>'Liked','status'=>'success','totalLike'=>$count);
					Yii::info('Saving values to the eventlike ', 'service');
				}
			} catch (Exception $e) {
				Yii::error('Exception inside ServiceComponent.likeEvent ['.$e.']', 'service');
				$retun=array('action'=>'Exception Occued','status'=>'fail');
			}
							
		}
		Yii::info('Rendering from ServiceComponent.likeEvent with status ['.json_encode($retun).']', 'service');
		print_r(json_encode($retun));
	}
	
	public function UnlikeEvent($inputJSON){
		Yii::info('Inside ServiceComponent.UnlikeEvent', 'service');
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$input= json_decode( $inputJSON, TRUE );
	
		if(!isset($input['appUserId']) || !isset($input['eventId'])){
			$retun=array('action'=>'value-missing','status'=>'fail');
			Yii::info('Appuser id and event id not found ServiceComponent.likeEvent', 'service');
		}else{
				
			try {
				Yii::info('Getting event like from event like', 'service');
				//$eventlikeCount = Eventlike::find()->where(['eventid' => $input['eventId'],'appuserid'=>$input['appUserId']])->count();
				$eventlikeCount=Eventlike::findOne(['eventid' => $input['eventId'],'appuserid'=>ServiceValidationComponent::decodeUserId($input['appUserId']) ]);
				if(count($eventlikeCount)>0){
					Yii::info('User Un Like the event', 'service');
					Eventlike::findOne($eventlikeCount->eventlikeid)->delete();
					$eventmodel=Events::findOne(['eventid'=>$input['eventId']]);
					$count=($eventmodel->total_like)-1;
					$eventmodel->total_like=$count;
					$eventmodel->save();
					if($eventmodel->save()){
						$retun=array('action'=>'UnLiked','status'=>'success','totalLike'=>$count);
					}else{
						$retun=array('action'=>'UnLiked','status'=>'fail','totalLike'=>$count);
					}
					$retun=array('action'=>'UnLiked','status'=>'success','totalLike'=>$count);
				}else{
					$eventmodel=Events::findOne(['eventid'=>$input['eventId']]);
					$retun=array('action'=>'Not liked yet','status'=>'success','totalLike'=>$eventmodel->total_like);
					Yii::info('Saving values to the eventlike ', 'service');
				}
			} catch (Exception $e) {
				Yii::error('Exception inside ServiceComponent.UnlikeEvent ['.$e.']', 'service');
				$retun=array('action'=>'Exception Occued','status'=>'fail');
			}
				
		}
		Yii::info('Rendering from ServiceComponent.UnlikeEvent with status ['.json_encode($retun).']', 'service');
		print_r(json_encode($retun));
	}
	
	
	public function CommentEvent($inputJSON){
		Yii::info('Inside ServiceComponent.CommentEvent', 'service');
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$input= json_decode( $inputJSON, TRUE );
		
		if(!isset($input['appUserId']) || !isset($input['eventId'])){
			$retun=array('action'=>'value-missing','status'=>'fail');
			Yii::info('Appuserid and event id not found', 'service');
		}else{
			try {
				$eventcomment=new Eventcomment();
				$eventcomment->eventid=$input['eventId'];
				$eventcomment->appuserid=ServiceValidationComponent::decodeUserId($input['appUserId']) ;
				$eventcomment->comment=$input['eventComment'];
				if($eventcomment->save()){
					$retun=array('action'=>'comment-updated','status'=>'success');
				}else{
					$retun=array('action'=>'comment-not-updated','status'=>'fail');
				}
				
				
			} catch (Exception $e) {
				Yii::error('Exception inside ServiceComponent.CommentEvent ['.$e.']', 'service');
				$retun=array('action'=>'Exception Occued','status'=>'fail');
			}
		}
		Yii::info('Rendering from ServiceComponent.CommentEvent with status ['.json_encode($retun).']', 'service');
		print_r(json_encode($retun));
	}
	
	public function deleteComment($inputJSON){
		Yii::info('Inside ServiceComponent.deleteComment', 'service');
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$input= json_decode( $inputJSON, TRUE );
	
		if($input['commentId']==''){
			$retun=array('action'=>'value-missing','status'=>'fail');
		}else{
			Eventcomment::findOne($input['commentId'])->delete();
			$retun=array('action'=>'deleted','status'=>'success');
		}
	
		print_r(json_encode($retun));
	
	}
	
	public function checkUser($inputJSON){
		Yii::info('Inside ServiceComponent.checkUser', 'service');
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$input= json_decode( $inputJSON, TRUE );
		if($input['emailId']==''){
			$retun=array('action'=>'email-missing','status'=>'fail');
			Yii::info('Email id missing ServiceComponent.checkUser', 'service');
		}else{
			try {
				Yii::info('getting Appuser missing ServiceComponent.checkUser', 'service');
				$model = Appuser::find()->where(['email' => $input['emailId']])->count();
				if($model>0){
					$retun=array('action'=>'Email-Exist','status'=>'success');
				}else{
					$retun=array('action'=>'Email-Not-Exist','status'=>'success');
				}
			} catch (Exception $e) {
				Yii::error('Exception inside ServiceComponent.checkUser ['.$e.']', 'service');
				$retun=array('action'=>'Exception Occued','status'=>'fail');
			}
			
		}
		
		Yii::info('Rendering from ServiceComponent.checkUser with status ['.json_encode($retun).']', 'service');
		print_r(json_encode($retun));
	}
	
	public function contactUs($inputJSON){
		Yii::info('Inside ServiceComponent.contactUs', 'service');
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$input= json_decode( $inputJSON, TRUE );
		$from=$input['emailId'];
		
		$phone=$input['phoneNo'];
		$name=$input['userName'];
		$comment=$input['comment'];
		
		
		$to = "anupam.b@indware.com,am@indware.com";
		$subject = "Netaji Research Bureau";
		
		$message = "
		<html>
		<head>
		<title>HTML email</title>
		</head>
		<body>
		<p>Hi,</p>
		<p>$comment</p>
		<table>
		<tr>
		<th></th><th></th><th></th>
		</tr>
		<tr>
		<td>Name </td><td>:</td><td>$name</td>
		</tr>
		<tr>
		<td>Phone </td><td>:</td><td>$phone</td>
		</tr>
		<tr>
		<td>Email </td><td>:</td><td>$from</td>
		</tr>
		</table>
		</body>
		</html>
		";
		
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		// More headers
		$headers .= 'From: <info@indware.com>' . "\r\n";
		$headers .= 'Cc: sudhu.void@gmail.com' . "\r\n";
		if(mail($to,$subject,$message,$headers)){
			$retun=array('action'=>'contact-email-sent','status'=>'success');
		}else{
			$retun=array('action'=>'email-not-sent','status'=>'fail');
		}
		
		$contactmodel=new Contactus();
		$contactmodel->fullname=$name;
		$contactmodel->emailid=$from;
		$contactmodel->phone_number=$phone;
		$contactmodel->contat_message=$comment;
		$contactmodel->save();
		
		Yii::info('Rendering from ServiceComponent.contactUs with status ['.json_encode($retun).']', 'service');
		print_r(json_encode($retun));
		
	}
	
	

}