    <section id="content">
      <section class="vbox">
        <header class="header bg-white b-b">
          <p>Welcome to Netaji Research Bureau application</p>
        </header>
        <section class="scrollable">
          <section class="hbox stretch">
            
            <aside class="bg-white" >
              <section class="vbox">
                <header class="header bg-light bg-gradient">
                  <ul class="nav nav-tabs nav-white">
                    <li class="active"><a href="#activity" data-toggle="tab">Comments</a></li>
                    <li class=""><a href="#events" data-toggle="tab">Events</a></li>
                  </ul>
                </header>
                <section class="scrollable">
                  <div class="tab-content" style="margin-left: 30px;">
                  
                    <div class="tab-pane active" id="activity">
                    <div style="height: 50px;margin-top: 20px;margin-bottom: 20px;">
                    <div style="float: left;margin-left: 20px;">Please Choose Event</div>
                    <div style="float: left;margin-left: 20px;">
                    <select name="allevents" id="allevents" class="form-control">
                    <?php foreach ($allevents as $allevents) { ?>
                    	<option value="<?php echo $allevents->eventid;?>" <?php if($selectedEventId==$allevents->eventid){?> selected="selected"<?php } ?>><?php echo $allevents->event_name;?></option>
                   <?php  }?>
                    </select>
                    </div>
                      <div style="float: left;margin-left: 20px;">
<input type="button" name="gotoevent" id="gotoevent" value="GO" class="form-control">
					</div>
                      </div>
                      <?php if(!isset($_REQUEST['eventid'])){ 
                      	if($unpublishcommentcounter>0)
                      	{
                      	?>
                      		<div class="alert alert-danger fade in">
	    						<a href="#" class="close" data-dismiss="alert">&times;</a>
	    						<strong>Alert!</strong> <?php echo $unpublishcommentcounter;?> Comments are not publish yet.
							</div>
							<?php foreach ($unpublishcomments as $key=>$value) { ?>
								<div class="alert alert-warning">
    								<a href="#" class="close" data-dismiss="alert">&times;</a>
    								<strong><?php echo $key;?>!</strong> - This event has unpublished comment.
								</div>
								<?php foreach ($value['comments'] as $cvalue) { ?>
									<div class="alert alert-info fade in">
    									<a href="#" class="close" data-dismiss="alert">&times;</a>
    									<strong>Comment - </strong> <?php echo $cvalue;?>
									</div>
								<?php  }?>
								<?php foreach ($value['commentsreply'] as $cvalue) { ?>
									<div class="alert alert-success fade in">
    									<a href="#" class="close" data-dismiss="alert">&times;</a>
    									<strong>Reply Comment - </strong> <?php echo $cvalue;?>
									</div>
								<?php  }?>
							<?php }?>
						<?php } } ?>
                      <section class="comment-list block">
                      
                      <?php foreach ($comments as $values){?>
                     
                  <article id="comment-id-<?php echo $values['eventcommentid'];?>" class="comment-item">
                    <a class="pull-left thumb-sm avatar">
                      <img src="<?php echo Yii::getAlias('@web').'/web/assets/'?>images/avatar.jpg" class="img-circle">
                    </a>
                    <span class="arrow left"></span>
                    <section class="comment-body panel">
                      <header class="panel-heading">
                        <a href="#"><?php echo $values['user'];?></a>
                        <label class="label bg-info m-l-xs">User</label> 
                        <?php if($values['publish']==0){?>
                         <span class="text-muted m-l-sm pull-right" style="color: red;">
                          <i class="fa fa-warning"></i>
                          Not yet publish
                        </span> 
                        <?php } else{?>
                        <span class="text-muted m-l-sm pull-right" style="color: green;">
                          <i class="fa fa-share"></i>
                          Comment Published
                        </span>
                        <?php } ?>
                      </header>
                      <div class="panel-body">
                        <div><?php echo $values['comment'];?></div>
                        <div class="comment-action m-t-sm">
                        <?php if($values['publish']==0){?>
                           <a href="#" id="commentpublishid_<?php echo $values['eventcommentid'];?>" data-toggle="class" class="btn btn-white btn-xs active comment_publish" style="color: red;">
                            <i class="fa fa-unlock text-danger text"></i><i class="fa fa-lock text-danger text-active"></i>Publish</a> 
                          <?php } else{?>
                          <a href="#" id="commentpublishid_<?php echo $values['eventcommentid'];?>" data-toggle="class" class="btn btn-white btn-xs active comment_unpublish" style="color: red;">
                            <i class="fa  fa-lock-o text-danger text"></i><i class="fa fa-unlock text-danger text-active"></i>Unpublish</a>
                          <?php } ?>
                          <a href="#comment-form" class="btn btn-white btn-xs comment_reply_button" id="comment_reply_button_<?php echo $values['eventcommentid'];?>">
                            <i class="fa fa-mail-reply text-muted"></i> Reply
                          </a> 
                        </div>
                      </div>
                    </section>
                  </article>
                  <!-- .comment-reply -->
                  <?php if($values['commentreply']){?>
                  <?php foreach ($values['commentreply'] as $rvalue) { ?>
                  
                  <article id="comment-id-2" class="comment-item comment-reply">
                    <a class="pull-left thumb-sm avatar">
                      <img src="<?php echo Yii::getAlias('@web').'/web/assets/'?>images/avatar.jpg" class="img-circle">
                    </a>
                    <span class="arrow left"></span>
                    <section class="comment-body panel text-sm">
                    <header class="panel-heading">
                    	<a href="#"><?php echo $rvalue['user'];?></a>
                    	<label class="label bg-dark m-l-xs"><?php if($rvalue['appuserid']==1) { echo 'Admin';}else{echo 'User';}?></label>
                    	<?php if($rvalue['publish']==0){?>
                         <span class="text-muted m-l-sm pull-right" style="color: red;">
                          <i class="fa fa-warning"></i>
                          Not yet publish
                        </span> 
                        <?php } else{?>
                        <span class="text-muted m-l-sm pull-right" style="color: green;">
                          <i class="fa fa-share"></i>
                          Comment Published
                        </span>
                        <?php } ?>
                    </header>
                      <div class="panel-body">                         
                        <?php echo $rvalue['comment'];?>
                        <div class="comment-action m-t-sm">
                        <?php if($rvalue['publish']==0){?>
                           <a href="#" id="commentpublishid_<?php echo $rvalue['eventcommentreplyid'];?>" data-toggle="class" class="btn btn-white btn-xs active replycomment_publish" style="color: red;">
                            <i class="fa fa-unlock text-danger text"></i><i class="fa fa-lock text-danger text-active"></i>Publish</a> 
                          <?php } else{?>
                          <a href="#" id="commentpublishid_<?php echo $rvalue['eventcommentreplyid'];?>" data-toggle="class" class="btn btn-white btn-xs active replycomment_unpublish" style="color: red;">
                            <i class="fa  fa-lock-o text-danger text"></i><i class="fa fa-unlock text-danger text-active"></i>Unpublish</a>
                          <?php } ?>
                        </div>
                      </div>
                    </section>
                  </article>
                  <?php } ?>
                  <?php } ?>
                  <!-- / .comment-reply -->
                  <article class="comment-item media" id="comment-reply-form_<?php echo $values['eventcommentid'];?>" style="display: none;">
                    <a class="pull-left thumb-sm avatar"><img src="<?php echo Yii::getAlias('@web').'/web/assets/'?>images/avatar.jpg" class="img-circle"></a>
                    <section class="media-body">
                      <form action="" class="m-b-none">
                        <div class="input-group">
                          <input type="text" class="form-control" id="admin_reply_comment_<?php echo $values['eventcommentid'];?>" placeholder="Input your comment here">
                          <input type="hidden" id="comment_to_replyuserid_<?php echo $values['eventcommentid'];?>">
                          <span class="input-group-btn">
                            <button class="btn btn-primary comment_reply_submit_button" id="admin_reply_commentbtn_<?php echo $values['eventcommentid'];?>" type="button">POST</button>
                          </span>
                        </div>
                      </form>
                    </section>
                  </article>
                  <?php } ?>
                  <!-- comment form -->
                  
                  
                </section>
                    </div>
                    <div class="tab-pane" id="events">
                      <div class="text-center wrapper">
                        <section class="panel">
                    <header class="panel-heading">Upcoming Events
                    <span class="label pull-right">
                    	<a href="#modal" data-toggle="modal" class="btn btn-xs btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                    </span>
                    </header>
                    <table class="table table-striped m-b-none text-sm">
                      <thead>
                        <tr>
                          <th>Images</th>
                          <th>Name</th>
                          <th>Event Date</th>
                          <th width="70">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php foreach ($upcoming_events as $values){?>
                       <tr>                    
                          <td>
                            <span class="pull-left thumb-sm"><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl().'/uploads/event/'.$values->event_image;?>" alt="John said" class="img-circle"></span>
                          </td>
                          <td><?php echo $values->event_name;?></td>
                          <td><?php echo $values->event_date;?></td>
                          
                          <td>
                           <a href="#modaledit" data-toggle="modal" class="edit_event_class" id="edit_event_id_<?php echo $values->eventid;?>"><i class="fa fa-edit fa-lg"></i> </a>
                           <a href="javascript:void(0)" ><i class="fa fa-trash-o fa-lg deleteEvent" id="deleteevent_<?php echo $values->eventid;?>"></i></a>
                          </td>
                        </tr>
                      <?php } ?>
                        
                      </tbody>
                    </table>
                  </section>
                      </div>
                    </div>
           <div class="modal fade" id="modal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Add Events</h4>
                </div>
                <div class="modal-body">
                  <form class="form-inline" role="form" enctype="multipart/form-data" action="events/neweventprofile" name="multiple_upload_form" id="multiple_upload_form" method="post">
                  
                     <div class="form-group">
                      <input type="text" name="event_date" id="event_date" class="form-control"  placeholder="Event Date">
                    </div>
                    <div class="form-group">
                      <input type="text" name="event_name" id="event_name" class="form-control" placeholder="Event Name">
                    </div> 
                    
                    <div class="form-group" style="margin-top: 15px;">
                      <input type="file" name="UploadForm[myimageFile]" id="uploadform-imagefile">
                    </div>
                    <div class="modal-footer">
                  <button type="button" id="new_event_close_button" class="btn btn-white" data-dismiss="modal">Close</button>
                  <button type="submit" id="new_event_submit" class="btn btn-info" data-loading-text="Updating...">Save changes</button> 
               
                </div>
                  </form>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div>
        </div>
           <div class="modal fade" id="modaledit">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Edit Events</h4>
                </div>
                <div class="modal-body">
                  <form class="form-inline" role="form" enctype="multipart/form-data" action="events/updateeventprofile" name="edvent_edit_form" id="edvent_edit_form" method="post">
                   <input type="hidden" name="eventid" id="eventid">
                    <div class="form-group">
                      <input type="text" name="edit_event_date" id="edit_event_date" class="form-control" placeholder="Event Date" value="">
                    </div>
                    <div class="form-group">
                      <input type="text" name="edit_event_name" id="edit_event_name" class="form-control" placeholder="Event Name">
                    </div>
                    <div class="form-group">
                      <input type="file" name="UploadForm[myimageFile]" id="uploadform-imagefile">
                    </div>
                    <div class="modal-footer" style="margin-top: 15px;">
                  <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                  <button type="submit" name="edit_event_submit" id="edit_event_submit" class="btn btn-info" data-loading-text="Updating...">Save changes</button>
                </div>
                  </form>
                  
                </div>
               
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div>
                </section>
              </section>
            </aside>
            
          </section>
        </section>
      </section>
      <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
    </section>
    <script>
    $(document).ready(function(){

    	//publish comment to event comment
        $('.comment_publish').click(function(){
        	var id=$(this).attr('id').split('_')[1];
        	var csrf=$("#csrf").val();
        	var enventid=$("#allevents").val();
   		 $.ajax({
   		       url: '<?php echo Yii::$app->request->baseUrl. '/eventcomment/pulishcomment' ?>',
   		       type: 'post',
   		       data: {
   		    	   id: id,
   		           _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
   		             },
   		       success: function (data) {
	   		    	$.ajax({
	   	   		       url: '<?php echo Yii::$app->request->baseUrl. '/events/incrementcoumentcounter' ?>',
	   	   		       type: 'post',
	   	   		       data: {
	   	   		    		enventid: enventid,
	   	   		           _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
	   	   		             },
	   	   		       success: function (data) {
	   	   		          alert('Successfully Published !');
	   	   		          location.reload();
	   	   		       }
	   	   		  });
   		          /* alert('Successfully Published !');
   		          location.reload(); */
   		       }
   		  });
        })
        
        //unpublish comment 
        $('.comment_unpublish').click(function(){
        	var id=$(this).attr('id').split('_')[1];
        	var csrf=$("#csrf").val();
        	var enventid=$("#allevents").val();
   		 $.ajax({
   		       url: '<?php echo Yii::$app->request->baseUrl. '/eventcomment/unpulishcomment' ?>',
   		       type: 'post',
   		       data: {
   		    	   id: id,
   		           _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
   		             },
   		       success: function (data) {
   		          /* alert('Successfully Unpublished !');
   		          location.reload(); */
   		       $.ajax({
   	   		       url: '<?php echo Yii::$app->request->baseUrl. '/events/decrementcomentcounter' ?>',
   	   		       type: 'post',
   	   		       data: {
   	   		    		enventid: enventid,
   	   		           _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
   	   		             },
   	   		       success: function (data) {
   	   		          alert('Successfully Unpublished !');
   	   		          location.reload();
   	   		       }
   	   		  });
   		       }
   		  });
        })
        
        //publish comment reply
       $('.replycomment_publish').click(function(){
       	var id=$(this).attr('id').split('_')[1];
       	var csrf=$("#csrf").val();
       	var enventid=$("#allevents").val();
  		 $.ajax({
  		       url: '<?php echo Yii::$app->request->baseUrl. '/eventcommentreply/pulishcomment' ?>',
  		       type: 'post',
  		       data: {
  		    	   id: id,
  		           _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
  		             },
  		       success: function (data) {
  		          /* alert('Successfully Published !');
  		          location.reload(); */
  		        $.ajax({
	   	   		       url: '<?php echo Yii::$app->request->baseUrl. '/events/incrementcoumentcounter' ?>',
	   	   		       type: 'post',
	   	   		       data: {
	   	   		    		enventid: enventid,
	   	   		           _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
	   	   		             },
	   	   		       success: function (data) {
	   	   		          alert('Successfully Published !');
	   	   		          location.reload();
	   	   		       }
	   	   		  });
  		       }
  		  });
       })
       
       //unpublish comment reply
       $('.replycomment_unpublish').click(function(){
       	var id=$(this).attr('id').split('_')[1];
       	var csrf=$("#csrf").val();
       	var enventid=$("#allevents").val();
  		 $.ajax({
  		       url: '<?php echo Yii::$app->request->baseUrl. '/eventcommentreply/unpulishcomment' ?>',
  		       type: 'post',
  		       data: {
  		    	   id: id,
  		           _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
  		             },
  		       success: function (data) {
  		          /* alert('Successfully Unpublished !');
  		          location.reload(); */
  		        $.ajax({
    	   		       url: '<?php echo Yii::$app->request->baseUrl. '/events/decrementcomentcounter' ?>',
    	   		       type: 'post',
    	   		       data: {
    	   		    		enventid: enventid,
    	   		           _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
    	   		             },
    	   		       success: function (data) {
    	   		          alert('Successfully Unpublished !');
    	   		          location.reload();
    	   		       }
    	   		  });
  		       }
  		  });
       })
        
    	$("#profile_update_submit").click(function(){
    		var admin_username=$("#admin_username").val();
    		var admin_email=$("#admin_email").val();
    		var admin_password=$("#admin_password").val();
    		
    		
    		if(admin_username==''){
    			alert("Please insert user name");
    			$("#admin_username").focus();
    			return false;
    		}
    		
    		if(admin_email==''){
    			alert("please insert email");
    			$("#admin_email").focus();
    			return false;
    		}

    		
    		var csrf=$("#csrf").val();
    		
    		 $.ajax({
    		       url: '<?php echo Yii::$app->request->baseUrl. '/dbuser/updateuserinfo' ?>',
    		       type: 'post',
    		       data: {
    		    	   username: admin_username,
    		    	   password:admin_password,
    		    	   email:admin_email,
    		                 _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
    		             },
    		       success: function (data) {
    		          alert('Successfully Updated !');
    		       }
    		  });
    	})

    	$("#gotoevent").click(function(){
		var enventid=$("#allevents").val();
		window.location.href='comments?eventid='+enventid;
        })

        $(".comment_reply_button").click(function(){
        	var idarr=$(this).attr("id").split("_");
        	var id=idarr[3];
        	
        	$.ajax({
 	   		       url: '<?php echo Yii::$app->request->baseUrl. '/eventcomment/checkcommentpublishstatus' ?>',
 	   		       type: 'post',
 	   		       data: {
 	   		    	id: id,
 	   		           _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
 	   		             },
 	   		       success: function (data) {
 	   		    	console.log();
 	   		          if(data=='notpublish'){
 	   		        	  alert('Please publis this comment , before reply !');
 	   		        	  return false;
 	   		          }else{
 	   		        	$("#comment-reply-form_"+id).show();
 	   		          }
 	   		       }
 	   		  });
	
            })

            $(".comment_reply_submit_button").click(function(){
                var idarr=$(this).attr("id").split("_");
                var eventcommentid=idarr[3];
               	var usreid=1;
               	var comment=$("#admin_reply_comment_"+eventcommentid).val();
               	var enventid=$("#allevents").val();

               	$.ajax({
     		       url: '<?php echo Yii::$app->request->baseUrl. '/eventcommentreply/insertreply' ?>',
     		       type: 'post',
     		       data: {
     		    	 eventcommentid: eventcommentid,
     		    	 appuserid:usreid,
     		    	comment:comment,
     		    	eventid:enventid
     		             },
     		       success: function (data) {
     		          /* alert('Successfully Replied !');
     		         location.reload(); */
     		        $.ajax({
 	   	   		       url: '<?php echo Yii::$app->request->baseUrl. '/events/incrementcoumentcounter' ?>',
 	   	   		       type: 'post',
 	   	   		       data: {
 	   	   		    		enventid: enventid,
 	   	   		           _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
 	   	   		             },
 	   	   		       success: function (data) {
 	   	   		    	alert('Successfully Replied !');
 	   	   		          location.reload();
 	   	   		       }
 	   	   		  });
     		       }
     		  });
     	     		  
                })
    })
    

</script>