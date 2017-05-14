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
                  Year Span
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
                          <th>Year Start</th>
                          <th>Year End</th>
                          <th>Created Date</th>
                          <th width="70">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($models as $values){?>
                       <tr>                    
                          <td><?php echo $values->year_start;?></td>
                          <td><?php echo $values->year_end;?></td>
                          <td><?php echo $values->created_date;?></td>
                          <td>
                           <a href="#modaledit" data-toggle="modal" class="edit_yearspan_class" id="edit_yearspan_id_<?php echo $values->yearspanid;?>"><i class="fa fa-edit fa-lg"></i> </a>
                           <a href="yearspan/remove?id=<?php echo $values->yearspanid;?>"><i class="fa fa-trash-o fa-lg"></i></a>
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
                  <form class="form-inline" role="form">
                  
                     <div class="form-group">
                      <input type="text" name="year_start" id="year_start_add" class="form-control"  placeholder="Year Start">
                    </div>
                    <div class="form-group">
                      <input type="text" name="year_end" id="year_end_add" class="form-control" placeholder="Year End">
                    </div> 
                    
                    
                    <div class="modal-footer">
                  <button type="button" id="new_event_close_button" class="btn btn-white" data-dismiss="modal">Close</button>
                  <button type="button" id="new_span_submit" class="btn btn-info" data-loading-text="Updating...">Save changes</button> 
               
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
                   <form class="form-inline" role="form" >
                   <input type="hidden" name="yearspanid" id="yearspanid">
                    <div class="form-group">
                      <input type="text" name="year_start" id="year_start_edit" class="form-control"  placeholder="Year Start">
                    </div>
                    <div class="form-group">
                      <input type="text" name="year_end" id="year_end_edit" class="form-control" placeholder="Year End">
                    </div>
                    
                    <div class="modal-footer" style="margin-top: 15px;">
                  <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                  <button type="button" name="edit_event_submit" id="edit_event_submit" class="btn btn-info" data-loading-text="Updating...">Save changes</button>
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
    <script>
    $(document).ready(function(){
    	$('#new_span_submit').click(function(){
        	var year_start=$("#year_start_add").val();
        	var year_end=$("#year_end_add").val();
   		 $.ajax({
   		       url: '<?php echo Yii::$app->request->baseUrl. '/yearspan/add' ?>',
   		       type: 'post',
   		       data: {
   		    	year_start: year_start,
   		    	year_end : year_end,
   		           _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
   		             },
   		       success: function (data) {
   		       alert('Successfully Inserted !');
   		        location.reload();
   		       }
   		  });
        })
        
        $(".edit_yearspan_class").click(function(){
        	var id=$(this).attr("id").split("_")[3];
        	$("#yearspanid").val(id);
        	$.ajax({
    		       url: '<?php echo Yii::$app->request->baseUrl. '/yearspan/getyearspanbyid' ?>',
    		       type: 'post',
    		       data: {
    		    	id: id,
    		           _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
    		             },
    		       success: function (data) {
    		    	   $("#year_start_edit").val(data.year_start);
    		    	   $("#year_end_edit").val(data.year_end);
    		       }
    		  });
        	
        })
        
        $("#edit_event_submit").click(function(){
        	var id=$("#yearspanid").val();
        	var year_start=$("#year_start_edit").val();
        	var year_end=$("#year_end_edit").val();
   		 $.ajax({
   		       url: '<?php echo Yii::$app->request->baseUrl. '/yearspan/edit' ?>',
   		       type: 'post',
   		       data: {
   		    	   id:id,
   		    	year_start: year_start,
   		    	year_end : year_end,
   		           _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
   		             },
   		       success: function (data) {
   		       alert('Successfully Updated !');
   		        location.reload();
   		       }
   		  });
        })
    })
    </script>