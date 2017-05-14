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
                  Contact US
                </header>
               
                <div class="table-responsive">
                  <table class="table table-striped b-t text-sm">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($models as $model){?>
                      <tr>
                        
                        <td><?php echo $model->fullname;?></td>
                        <td><?php echo $model->emailid;?></td>
                        <td><?php echo $model->phone_number;?></td>
                        <td><?php echo $model->contat_message;?></td>
                        
                      </tr>
                      <?php } ?>
                      
                      
                    </tbody>
                  </table>
                </div>
                <footer class="panel-footer">
                  <div class="row">
                    
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