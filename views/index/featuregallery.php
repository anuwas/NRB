<?php
use yii\widgets\LinkPager;
?>
    <section id="content">
      <section class="vbox">
        <header class="header bg-white b-b">
          <p>Welcome to Netaji Research Bureau application</p>
        </header>
        <section class="scrollable wrapper">
          <div class="row">
          <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                  Gallery
                </header>
                <div class="row text-sm wrapper">
                  
                  <form action="users" method="get">
                   <span class="label pull-right">
                    	<a href="#modal" data-toggle="modal" class="btn btn-xs btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                    </span>
                  </form>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped b-t text-sm">
                    <thead>
                        <tr>
                          <th>Images</th>
                          <th>Name</th>
                          <th>Event Date</th>
                          <th width="70">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($gallerdata as $values){?>
                       <tr>                    
                          <td>
                            <span class="pull-left thumb-md"><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl().'/uploads/featuregallery/'.$values->image;?>" alt="John said" ></span>
                          </td>
                          <td><?php echo $values->image_title;?></td>
                          <td><?php echo $values->image_alt;?></td>
                          <td>
                           <a href="#modaledit" data-toggle="modal" class="edit_featuregallery_class" id="edit_event_id_<?php echo $values->featuregallery_id;?>"><i class="fa fa-edit fa-lg"></i> </a>
                           <a href="featuregallery/deletegallerybyid?id=<?php echo $values->featuregallery_id;?>"><i class="fa fa-trash-o fa-lg"></i></a>
                          </td>
                        </tr>
                      <?php } ?>
                        
                      </tbody>
                  </table>
                </div>
                <footer class="panel-footer">
                  <div class="row">
                    <div class="col-sm-4 hidden-xs">
                     
                                     
                    </div>
                    <div class="col-sm-4 text-center">
                      <!-- <small class="text-muted inline m-t-sm m-b-sm">showing  items</small> -->
                    </div>
                    <div class="col-sm-4 text-right text-center-xs">  
                                 
                      <ul class="pagination pagination-sm m-t-none m-b-none">
                        <?php 
                       
                        echo LinkPager::widget([
                        		'pagination' => $pages,
                        ]);
                        ?> 
                      </ul>
                    </div>
                  </div>
                </footer>
                <div class="modal fade" id="modal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Add New Item</h4>
                </div>
                <div class="modal-body">
                  <form class="form-inline" role="form" enctype="multipart/form-data" action="featuregallery/insertitem" name="gallery_upload_form" id="gallery_upload_form" method="post">
                  
                     <div class="form-group">
                      <input type="text" name="image_title" id="image_title" class="form-control"  placeholder="Image Title">
                    </div>
                    <div class="form-group">
                      <input type="text" name="image_alt" id="image_alt" class="form-control" placeholder="Image Alt">
                    </div> 
                    
                    <div class="form-group" style="margin-top: 15px;">
                      <input type="file" name="UploadForm[myimageFile]" id="uploadform-imagefile">
                    </div>
                    <div class="modal-footer">
                  <button type="button" id="new_event_close_button" class="btn btn-white" data-dismiss="modal">Close</button>
                  <button type="submit" id="new_gallery_submit" class="btn btn-info" data-loading-text="Updating...">Save changes</button> 
               
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
                  <h4 class="modal-title">Edit Item</h4>
                </div>
                <div class="modal-body">
                   <form class="form-inline" role="form" enctype="multipart/form-data" action="featuregallery/updategallery" name="edvent_edit_form" id="edvent_edit_form" method="post">
                   <input type="hidden" name="featuregallery_id" id="featuregallery_id">
                    <div class="form-group">
                      <input type="text" name="edit_image_title" id="edit_image_title" class="form-control" placeholder="Image Title" value="">
                    </div>
                    <div class="form-group">
                      <input type="text" name="edit_image_alt" id="edit_image_alt" class="form-control" placeholder="Image alt">
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
          </div>
          </div>          
        </section>
      </section>
      <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
    </section>