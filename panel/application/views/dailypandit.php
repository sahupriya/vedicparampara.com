<script>
$( document ).ready(function() {
    $("#dailypandit").addClass('active');
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
    <li><a href="#">Add Daily Pandit</a></li>    
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
        
            <div class="panel panel-default" style="<?=$form?'':'display:none;'?>" >
                <form class="form-horizontal" action="<?php echo site_url('site/dlypandit_submit'); ?>" method="post" enctype="multipart/form-data">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Add Daily Pandit</strong></h3>
                        <ul class="panel-controls">
						<li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
							
                        </ul>
                    </div>   
                    <h4 style="color: red;text-align: center;"><?php echo $this->session->flashdata('err_msg'); ?></h4>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-4 col-xs-12">
                                <label>Select Pandit Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-user"></span></span>
									 <select  class="form-control"  name="pandit_id"  id="pandit_id" required="required" >
                                            <option value="">--Select Pandit--</option> 
                                            <?php foreach($pandit as $obj ){ ?>
                                            <option value="<?php echo $obj->user_id; ?>" <?php echo isset($post['pandit_id']) && $post['pandit_id'] == $obj->user_id ?  'selected="selected"' : ''; ?>><?php echo $obj->username; ?> ( <?php echo $obj->mobile; ?> ) </option>
                                            <?php } ?>                                            
                                        </select>
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>For Subscription</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                    <select  class="form-control"  name="subscription_for"  id="subscription_for" required="required" >
                                            <option value="">--Select Subscription For--</option> 
											<option value="office">For Office</option>
											<option value="home">For Home</option>                             
                                        </select></div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Select Subscription</label>
                                <div class="input-group">
								<span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                    <select  class="form-control"  name="subscription_id"  id="subscription_id" required="required" >
                                                                                      
                                        </select>
									</div>                                
                            </div>
                        </div>
                        <script>
							$("#subscription_for").change(function(){
            var subscription_for = $("#subscription_for").val();
            //alert(subscription_for);
            $.post("<?php echo site_url('site/getsubscription')?>", {subscription_for : subscription_for}, function(data){
				//alert(data);
                $("#subscription_id").html(data);
    		});
        });
							</script>
                        

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
                    <h3 class="panel-title"><strong>Subscriber</strong> List</h3>
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
                                    <th>Pandit Name</th>
                                    <th>Subscription For</th>
                                    <th>Subscription Type</th>
                                    <th>Subscription Date</th>
									<th>Subscription Status</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $id = "";
                                foreach($user as $r)
                                {
                                    $i++;                                
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php 
									$p=$this->db->where('user_id',$r->pandit_id)->get('pandit')->row()->username;
									echo '<a href="'.site_url('site/pandit_detail').'?q='.$r->pandit_id.'">';
                                        echo $p.'</a>'; 
                                    ?></td>
                                    <td><?php echo $r->subscription_for; ?></td>
                                    <td><?php 
                                    $pp=$this->db->where('id',$r->subscription_id)->get('dailypandit_subscription')->row()->subscription_type;
											if($pp==1){ echo "Monthly"; }
											else if($pp==2){ echo "2 Monthly";}
											else if($pp==3){  echo "Quaterly";}
											else if($pp==4){  echo "Half Yearly";}
											else if($pp==5){  echo "Yearly";}
									?></td>
                                    <td><?php echo $r->subscription_date; ?></td>
									 <td>
                                        <a href="<?=site_url('site/change_sub_status').'?q='.$r->id?>" onclick="return confirm('Do You want Change the Status Of This Subscriber')" class="btn <?=$r->subscription_status?'btn-primary':'btn-danger'?>"><i class="fa fa-edit"></i> <?=$r->subscription_status?'Active':'Inactive'?></a>
                                    </td>
                                    <td>
                                        <a href="#" onclick="open_msg('<?=site_url("site/sub_delete")."?q=".$r->id; ?>');" class="btn btn-primary"><i class="fa fa-trash-o"></i></a>
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