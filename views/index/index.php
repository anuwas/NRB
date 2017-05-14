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
          <div class="col-md-9">
            <section class="panel">
                <header class="panel-heading">
                  All Users
                </header>
                <div class="row text-sm wrapper">
                  <div class="col-sm-9 m-b-xs">
                    <select class="input-sm form-control input-s-sm inline">
                      <option value="1">Delete selected</option>
                      <option value="3">Export</option>
                    </select>
                    <button class="btn btn-sm btn-white" id="applytop">Apply</button>                
                  </div>
                  <form action="home" method="get">
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
                        <td><input type="checkbox" name="selectedusres[]" class="selectedusresclass" value="value="<?php echo $model->appuserid;?>"></td>
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
                    <div class="col-sm-4 hidden-xs">
                      <select class="input-sm form-control input-s-sm inline">
                        <option value="1">Delete selected</option>
                        <option value="3">Export</option>
                      </select>
                      <button class="btn btn-sm btn-white">Apply</button>                  
                    </div>
                    <div class="col-sm-4 text-center">
                      <!-- <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small> -->
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
          <div class="col-md-3 bg-white-only">
          	<div id="calendar" class="m-t-lg">

              </div>
          </div>
            
            
          </div>          
        </section>
      </section>
      <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
    </section>
<script>
$("#applytop").click(function(){
	$(".selectedusresclass").each(function(){
		alert($(this).val());
		})
})
    </script>