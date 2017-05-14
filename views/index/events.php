    <section id="content">
      <section class="vbox">
        <header class="header bg-white b-b">
          <p>Welcome to Netaji Research Bureau application</p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
            <div class="col-sm-6">
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
                          <th>Likes/Comments</th>
                          <th width="70">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($current_event as $values){?>
                       <tr>                    
                          <td>
                            <span class="pull-left thumb-sm"><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl().'/uploads/event/'.$values->event_image;?>" alt="John said" class="img-circle"></span>
                          </td>
                          <td><?php echo $values->event_name;?></td>
                          <td><?php echo $values->event_date;?></td>
                          <td><a href="#LikeList" data-toggle="modal" class="like_event_class" id="like_event_id_<?php echo $values->eventid;?>">(<?php echo $values->total_like;?>) </a>/ <a href="#CommentList" data-toggle="modal" class="comment_event_class" id="comment_event_id_<?php echo $values->eventid;?>">(<?php echo $values->total_comment;?>)</a></td>
                          
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
            <div class="col-sm-6">
                  <section class="panel">
                    <header class="panel-heading">Past events</header>
                    <table class="table table-striped m-b-none text-sm">
                      <thead>
                        <tr>
                          <th>Images</th>
                          <th>Name</th>
                          <th>Event Date</th>
                          <th>Likes/Comments</th>
                          <th width="70">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($past_event as $values){?>
                       <tr>                    
                          <td>
                            <span class="pull-left thumb-sm"><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl().'/uploads/event/'.$values->event_image;?>" alt="John said" class="img-circle"></span>
                          </td>
                          <td><?php echo $values->event_name;?></td>
                          <td><?php echo $values->event_date;?></td>
                          <td><a href="#LikeList" data-toggle="modal" class="like_event_class" id="like_eventpast_id_<?php echo $values->eventid;?>">(<?php echo $values->total_like;?>) </a>/ <a href="#CommentList" data-toggle="modal" class="comment_event_class" id="comment_eventpast_id_<?php echo $values->eventid;?>">(<?php echo $values->total_comment;?>)</a></td>
                          <td>
                            <a href="#modaledit" data-toggle="modal" class="edit_event_class" id="edit_event_id_<?php echo $values->eventid;?>"><i class="fa fa-edit fa-lg"></i> </a>
                             <a href="javascript:void(0)"><i class="fa fa-trash-o fa-lg deleteEvent" id="deleteevent_<?php echo $values->eventid;?>"></i></a>
                          </td>
                        </tr>
                      <?php } ?>
                        
                      </tbody>
                    </table>
                  </section>
            </div>
            
            <div class="modal fade" id="modal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Add Events</h4>
                </div>
                <div class="modal-body">
                  <form class="form-inline" role="form" enctype="multipart/form-data" action="events/newevent" name="multiple_upload_form" id="multiple_upload_form" method="post">
                  
                     <div class="form-group">
                      <input type="text"  name="event_date" id="event_date" class="form-control"  placeholder="Event Date">
                    </div>
                    <div class="form-group">
                      <input type="text" name="event_name" id="event_name" class="form-control" placeholder="Event Name">
                    </div> 
                    <br>
                    <div class="form-group" style="margin-top: 15px;">
                      <input type="file" name="UploadForm[myimageFile]" id="uploadform-imagefile">
                    </div>
                    <div class="modal-footer">
                  <button type="button" id="new_event_close_button" class="btn btn-white" data-dismiss="modal">Close</button>
                  <button type="submit" id="new_event_submit" class="btn btn-info" data-loading-text="Updating...">Save changes</button> 
               
                </div>
                  </form>
                  
                  
                </div>
                
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div>
            <div class="modal fade" id="modaledit">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Edit Events</h4>
                </div>
                <div class="modal-body">
                   <form class="form-inline" role="form" enctype="multipart/form-data" action="events/updateevent" name="edvent_edit_form" id="edvent_edit_form" method="post">
                   <input type="hidden" name="eventid" id="eventid">
                    <div class="form-group">
                      <input type="text"  name="edit_event_date" id="edit_event_date" class="form-control" placeholder="Event Date" value="">
                    </div>
                    <div class="form-group">
                      <input type="text"  name="edit_event_name" id="edit_event_name" class="form-control" placeholder="Event Name">
                    </div>
                    <br> <br>
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
           <div class="modal fade" id="LikeList">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Likes</h4>
                </div>
                <div class="modal-body">
                <div id="likesByUser"></div>
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                  
                </div>
                
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div>
          <div class="modal fade" id="CommentList">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Comments</h4>
                </div>
                <div class="modal-body">
                <div id="CommentByUser"></div>
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                  
                </div>
                
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div>
          </div>          
        </section>
      </section>
      <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
    </section>
    <link rel="stylesheet" href="<?php echo Yii::getAlias('@web').'/web/'?>css/jquery-ui.css">
    <script src="<?php echo Yii::getAlias('@web').'/web/'?>assets/js/jquery-ui.js"></script>
    <script>
  $( function() {
    $( "#event_date" ).datepicker({
    	  dateFormat: "yy-mm-dd"
    });
    $( "#edit_event_date" ).datepicker({
  	  dateFormat: "yy-mm-dd"
  });
    	    
    
  } );
  </script>