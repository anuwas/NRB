<?php
namespace app\components;

use Yii;
use yii\base\Component;
use app\models\Eventcomment;
use app\models\Eventcommentreply;

class CommenthelperComponent extends Component
{
	public function generateCommentWithReply($eventid,$comments,$replycomment)
	{
		$carr=array();
		$comments=Eventcomment::find()->joinWith('appuser')->where(['publish' => 1])->all();
		$replycomment=Eventcommentreply::find()->joinWith('appuser')->where(['publish' => 1])->all();
		foreach ($comments as $c){
			if($c->eventid==$eventid){
				$rarr=array();
				foreach ($replycomment as $r){
					if($r->eventcommentid==$c->eventcommentid){
						$rarr[]=array('user'=>$r->appuser->username,'comment'=>$r->comment,'datetime'=>$r->created_date);
					}
				}
				$carr[]=array('user'=>$c->appuser->username,'comment'=>$c->comment,'datetime'=>$c->commentdate,'reply'=>$rarr);
			}
		}
		 
		return $carr;
	}
	
	public function eventCommentReplyByCommentid($eventcommentid,$commentreply)
	{
		$carr=array();
		foreach ($commentreply as $value) {
			
			if($value->eventcommentid==$eventcommentid)
			{
				$carr[]=array('eventcommentreplyid'=>$value->eventcommentreplyid,'eventcommentid'=>$eventcommentid,'appuserid'=>$value->appuserid,'user'=>$value->appuser->username,'comment'=>$value->comment,'publish'=>$value->publish);
			}
		}
		return $carr;
	}
}