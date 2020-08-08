<script>
$( document ).ready(function() {
    $("#dailypandit_sub").addClass('active');
});   
</script>

<script>
function open_msg(link)
{
    $("#delete_log").prop('href',link);
    $("#mb-delete").modal('show');
}
</script>
<style>
td .image-responsive{
    height: 55px;
    width: auto;
}
</style>

<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Dashboard</a></li>
    <li><a href="">Master</a></li>
    <li><a href="#">Add Subscription Detail</a></li>    
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row"><h4 style="color: red;text-align: center;"><?php echo $this->session->flashdata('err_msg'); ?></h4>
        <div class="col-md-6">
        
            <div class="panel panel-default" style="<?=$form?'':'display:none;'?>" >
                <form class="form-horizontal" action="<?php echo site_url('site/suboffice_submit'); ?>" method="post" enctype="multipart/form-data">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Subscription</strong> For Office</h3>
                        <ul class="panel-controls">
						<li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                    </div>   
                    
                    <div class="panel-body">
                        
                        
                        <div class="form-group">
                            <div class="col-md-6 col-xs-12">
                                <label>Subscription Type</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                    <select  class="form-control"  name="subscription_type"  id="subscription_type" required="required" >
                                            <option value="">--Select Subscription--</option> 
											<option value="1">Monthly</option> 
											<option value="2">2 Monthly</option> 
											<option value="3">Quaterly</option> 
											<option value="4">Half Yearly</option> 
											<option value="5">Yearly</option> 
                                                                                     
                                        </select>
                                </div>                                
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label>Price</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-money"></span></span>
                                    <input type="text" name="price" id="price" class="form-control" placeholder='Enter price Of Subscription' value="<?=$data['price']?>">
                                <input type="hidden" name="subscription_for" id="subscription_for"  value="office">
                               
								</div>                                
                            </div>
                        </div>

                        <div class="panel-footer">
                            <a  class="btn btn-default" onclick="reset();">Clear Form</a>
                            <input type="submit" id="submit" class="btn btn-primary pull-right" value="Submit">
                        </div> <!-- END panel-footer -->
                    </div> <!-- END panel-body -->
                </form>
            </div> <!-- END panel panel-default -->
      
        </div> <!-- END col-md-6 -->
		<div class="col-md-6">
        
            <div class="panel panel-default" style="<?=$form?'':'display:none;'?>" >
                <form class="form-horizontal" action="<?php echo site_url('site/subhome_submit'); ?>" method="post" enctype="multipart/form-data">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Subscription</strong> For Home</h3>
                        <ul class="panel-controls">
						<li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                    </div>   
                    
                    <div class="panel-body">
                        
                        
                        <div class="form-group">
                            <div class="col-md-6 col-xs-12">
                                <label>Subscription Type</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                    <select  class="form-control"  name="subscription_type"  id="subscription_type" required="required" >
                                            <option value="">--Select Subscription--</option> 
											<option value="1">Monthly</option> 
											<option value="2">2 Monthly</option> 
											<option value="3">Quaterly</option> 
											<option value="4">Half Yearly</option> 
											<option value="5">Yearly</option> 
                                                                                     
                                        </select>
                                </div>                                
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label>Price</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-money"></span></span>
                                    <input type="text" name="price" id="price" class="form-control" placeholder='Enter price Of Subscription' value="<?=$data['price']?>">
									 <input type="hidden" name="subscription_for" id="subscription_for"  value="home">
                                </div>                                
                            </div>
                        </div>

                        <div class="panel-footer">
                            <a  class="btn btn-default" onclick="reset();">Clear Form</a>
                            <input type="submit" id="submit" class="btn btn-primary pull-right" value="Submit">
                        </div> <!-- END panel-footer -->
                    </div> <!-- END panel-body -->
                </form>
            </div> <!-- END panel panel-default -->
      
        </div> <!-- END col-md-6 -->

       
        <div class="col-md-12">
            <form class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Users</strong> List</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>S. No.</th>
                                    <th>Subscription Type</th>
                                    <th>Subscription For</th>
                                    <th>Price</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $id = "";
                                foreach($dailypandit_subscription as $r)
                                {
                                    $i++;                                
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $r->subscription_for; ?></td>
                                    <td><?php 
											if($r->subscription_type==1){ echo "Monthly"; }
											else if($r->subscription_type==2){ echo "2 Monthly";}
											else if($r->subscription_type==3){  echo "Quaterly";}
											else if($r->subscription_type==4){  echo "Half Yearly";}
											else if($r->subscription_type==5){  echo "Yearly";}

									?>
									
									
									</td>
                                    <td><?php echo $r->price; ?></td>
                                    <td>
									<a href="#" onclick="open_msg('<?=site_url("site/subpandit_delete")."?q=".$r->id; ?>');" class="btn btn-primary"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                   
                                </tr>
                                <?php                            
                                }
                                ?>
                            </tbody>
							
                        </table>
                    </div>
                </div> <!-- END panel-body -->
            </div> <!-- END panel panel-default -->
            </form>
        </div> <!-- END col-md-6 -->
        
    </div> <!-- END row -->
</div> <!-- END page-content-wrap -->
<!-- END PAGE CONTENT WRAPPER -->