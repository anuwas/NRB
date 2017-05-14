<?php
namespace app\components;

use yii\base\Component;

class ServiceValidationComponent extends Component
{
	/*
	public static function checkTokenWithId($inputJSON,$fromAction){
		Yii::info('Inside ServicevalidationComponent.commonCheckParam', 'service');
		Yii::info('Input parameter '.$inputJSON.' From Action '.$fromAction, 'service');
		$status=true;
		$input= json_decode($inputJSON, TRUE );
		if(!isset($input['token'])){
			$status=false;
		}else{
			$token=$input['token'];
			$marchent=Merchant::findOne(['merchant_id'=>$input['merchantId']]);
			if($marchent['login_token']!==$input['token']){
				$status=false;
			}
		}
		return $status;
	}
	
	public static function checkOnlyToken($inputJSON,$fromAction){
		Yii::info('Inside ServicevalidationComponent.checkOnlyToken', 'service');
		Yii::info('Input parameter '.$inputJSON.' From Action '.$fromAction, 'service');
		$status=true;
		$input= json_decode($inputJSON, TRUE );
		if(!isset($input['token'])){
			$status=false;
		}else{
			$token=$input['token'];
			$marchent=Merchant::find()->where(['login_token' =>$input['token']])->count();
			if($marchent!=1){
				$status=false;
			}
		}
		return $status;
	}
	*/
	
	public static function encodeUserId($userId){
		$current=date('Y-m-d-h-m-s');
		$str=$current.'-'.$userId;
		return base64_encode($str);
	}
	
	public static function decodeUserId($encapStr){
		$decoded=base64_decode($encapStr);
		$strarr=explode("-", $decoded);
		$len=sizeof($strarr);
		return $strarr[$len-1];
	}
}