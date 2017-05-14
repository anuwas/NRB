      
    <section id="content">
      <section class="vbox">
        <header class="header bg-white b-b">
          <p>Welcome to Netaji Research Bureau application</p>
        </header>
        <section class="scrollable">
          <section class="hbox stretch">
            <aside class="aside-lg bg-light lter b-r">
              <section class="vbox">
                <section class="scrollable">
                  <div class="wrapper">
                    <div class="clearfix m-b">
                      <a href="#" class="pull-left thumb m-r">
                        <img src="<?php echo Yii::getAlias('@web').'/web/assets/'?>images/avatar.jpg" class="img-circle">
                      </a>
                      <div class="clear">
                        <div class="h3 m-t-xs m-b-xs">John.Smith</div>
                        <small class="text-muted"><i class="fa fa-map-marker"></i> India, Kolkata</small>
                      </div>                
                    </div>
                    <div class="panel wrapper">
                      <div class="row">
                        <div class="col-xs-4">
                          <a href="#">
                            <span class="m-b-xs h4 block"><?php echo $totalLike;?></span>
                            <small class="text-muted">Likes</small>
                          </a>
                        </div>
                        <div class="col-xs-4">
                          <a href="#">
                            <span class="m-b-xs h4 block"><?php echo $totalComments;?></span>
                            <small class="text-muted">Comments</small>
                          </a>
                        </div>
                        <div class="col-xs-4">
                          <a href="#">
                            <span class="m-b-xs h4 block">2,035</span>
                            <small class="text-muted">Tweets</small>
                          </a>
                        </div>
                      </div>
                    </div>
                    <div>
                      <h4>Change your profile</h4>
                      
                      <form role="form">
                      
                        <div class="form-group">
                          <label>User Name</label>
                          <input type="text" class="form-control" name="admin_username" id="admin_username" placeholder="User Name" value="<?php echo $adminuser->username;?>">
                        </div>
                        <div class="form-group">
                          <label>Email Id</label>
                          <input type="email" class="form-control" name="admin_email" id="admin_email" placeholder="Email Id" value="<?php echo $adminuser->email;?>">
                        </div>
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="admin_password" id="admin_password" class="form-control" placeholder="Password">
                        </div>
                        <button type="button" name="profile_update_submit" id="profile_update_submit" class="btn btn-s-md btn-success">Submit</button>
                      </form>
                    
                    </div>
                    
                  </div>
                </section>
              </section>
            </aside>
            <aside class="bg-white">
              <section class="vbox">
                <header class="header bg-light bg-gradient">
                  <ul class="nav nav-tabs nav-white">
                     
                    <li class="active"><a href="#activity" data-toggle="tab">Comments</a></li>
                    <li class=""><a href="#events" data-toggle="tab">Events</a></li>
                  </ul>
                </header>
                <section class="scrollable">
                  <div class="tab-content">
                  
                    <div class="tab-pane active" id="activity">
                    <div style="height: 50px;margin-top: 20px;margin-bottom: 20px;">
                    <div style="float: left;margin-left: 20px;">Please Choose Event</div>
                    <div style="float: left;margin-left: 20px;">
                    <select name="allevents" id="allevents">
                    <?php foreach ($allevents as $allevents) { ?>
                    	<option value="<?php echo $allevents->eventid;?>" <?php if($selectedEventId==$allevents->eventid){?> selected="selected"<?php } ?>><?php echo $allevents->event_name;?></option>
                   <?php  }?>
                    </select>
                    </div>
                      <div style="float: left;margin-left: 20px;">
<input type="button" name="gotoevent" id="gotoevent" value="GO">
					</div>
                      </div>
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
                        <!-- <span class="text-muted m-l-sm pull-right">
                          <i class="fa fa-clock-o"></i>
                          24 minutes ago
                        </span> -->
                      </header>
                      <div class="panel-body">
                        <div><?php echo $values['comment'];?></div>
                        <div class="comment-action m-t-sm">
                          <!-- <a href="#" data-toggle="class" class="btn btn-white btn-xs active">
                            <i class="fa fa-star-o text-muted text"></i>
                            <i class="fa fa-star text-danger text-active"></i>
                            Like
                          </a> -->
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
                      <div class="panel-body">
                        <a href="#"><?php echo $rvalue['user'];?></a>
                        <label class="label bg-dark m-l-xs"><?php if($rvalue['appuserid']==1) { echo 'Admin';}else{echo 'User';}?></label> 
                        <?php echo $rvalue['comment'];?>
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
            <aside class="col-lg-4 b-l">
              <section class="vbox">
                <section class="scrollable">
                  <div class="wrapper">
                    <section class="panel">
                      <h4 class="font-thin padder">Latest Tweets</h4>
                      <ul class="list-group">
                        <li class="list-group-item">
                            <p>Wellcome <a href="#" class="text-info">@Drew Wllon</a> and play this web application template, have fun1 </p>
                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                        </li>
                        <li class="list-group-item">
                            <p>Morbi nec <a href="#" class="text-info">@Jonathan George</a> nunc condimentum ipsum dolor sit amet, consectetur</p>
                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 hour ago</small>
                        </li>
                        <li class="list-group-item">                     
                            <p><a href="#" class="text-info">@Josh Long</a> Vestibulum ullamcorper sodales nisi nec adipiscing elit. Morbi id neque quam. Aliquam sollicitudin venenatis</p>
                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 hours ago</small>
                        </li>
                      </ul>
                    </section>
                    <section class="panel">
                      <h4 class="font-thin padder">Latest Facebook</h4>
                      <ul class="list-group">
                        <li class="list-group-item">
                            <p>Wellcome <a href="#" class="text-info">@Drew Wllon</a> and play this web application template, have fun1 </p>
                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                        </li>
                        <li class="list-group-item">
                            <p>Morbi nec <a href="#" class="text-info">@Jonathan George</a> nunc condimentum ipsum dolor sit amet, consectetur</p>
                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 hour ago</small>
                        </li>
                        <li class="list-group-item">                     
                            <p><a href="#" class="text-info">@Josh Long</a> Vestibulum ullamcorper sodales nisi nec adipiscing elit. Morbi id neque quam. Aliquam sollicitudin venenatis</p>
                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 hours ago</small>
                        </li>
                      </ul>
                    </section>
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
		window.location.href='profile?eventid='+enventid;
        })

        $(".comment_reply_button").click(function(){
	var idarr=$(this).attr("id").split("_");
	var id=idarr[3];
	$("#comment-reply-form_"+id).show();
	
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
     		          alert('Successfully Replied !');
     		         location.reload();
     		       }
     		  });
     	     		  
                })
    })
    

</script>