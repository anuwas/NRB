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
                  All Users
                </header>
                <div class="row text-sm wrapper">
                  <div class="col-sm-9 m-b-xs">
                    <select class="input-sm form-control input-s-sm inline" id="select_action_id_top">
                      <option value="1">Delete selected</option>
                      <option value="2">Export</option>
                    </select>
                    <button class="btn btn-sm btn-white" class="applybuttoncls" id="applytop">Apply</button>                
                  </div>
                  <form action="users" method="get">
                  <div class="col-sm-3">
                    <div class="input-group">
                      <input type="text" name="search" id="search" class="input-sm form-control" placeholder="Search" value="<?php echo $srcdata;?>">
                      <span class="input-group-btn">
                        <button class="btn btn-sm btn-white" type="submit">Go!</button>
                      </span>
                    </div>
                  </div>
                  </form>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped b-t text-sm">
                    <thead>
                      <tr>
                        <th width="20"><input type="checkbox"></th>
                        <th class="th-sortable" data-toggle="class">Name
                          <span class="th-sort">
                            <i class="fa fa-sort-down text"></i>
                            <i class="fa fa-sort-up text-active"></i>
                            <i class="fa fa-sort"></i>
                          </span>
                        </th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Password</th>
                        <th width="80">Action</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                    <?php foreach ($models as $model){?>
                      <tr>
                        <td><input type="checkbox" name="selectedusres[]" class="selectedusresclass"  value="<?php echo $model->appuserid;?>"></td>
                        <td><?php echo $model->username;?></td>
                        <td><?php echo $model->email;?></td>
                        <td><?php echo $model->phone;?></td>
                        <td><?php echo $model->password;?></td>
                        <td>
                          <a href="#" class="active" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>
                      </tr>
                      <?php } ?>
                      
                      
                    </tbody>
                  </table>
                </div>
                <footer class="panel-footer">
                  <div class="row">
                    <!-- <div class="col-sm-4 hidden-xs">
                      <select class="input-sm form-control input-s-sm inline">
                        <option value="1">Delete selected</option>
                        <option value="2">Export</option>
                      </select>
                      <button class="btn btn-sm btn-white" id="applybottom" class="applybuttoncls">Apply</button>                  
                    </div> -->
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
              </section>
          </div>
          </div>          
        </section>
      </section>
      <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
    </section>
    <script>
$("#applytop").click(function(){
	var selectedarr=[];
	$(".selectedusresclass").each(function(){
		if($(this).prop("checked")){
			selectedarr.push($(this).val());
		}
	})
	//console.log(selectedarr);
	var csrf=$("#csrf").val();
	var selectedAction=$("#select_action_id_top").val();
	
	if(selectedAction==1){
		if(confirm("Sure want to delete the selected user!")){
			$.ajax({
			       url: '<?php echo Yii::$app->request->baseUrl. '/appuser/deletebukuser' ?>',
			       type: 'post',
			       data: {
			    	   selectedid: selectedarr,
			                 _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
			             },
			       success: function (data) {
			         alert("Successfully Deleted");
			         location.reload();
			       }
			  });
		}
		
	}else{
		alert("Export feature not yet introduced");
	}
})

</script>