<script>
$( document ).ready(function() {
    $("#add_pandit").addClass('active');
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
    <li><a href="#">Add Pandit</a></li>    
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
        
            <div class="panel panel-default" style="<?=$form?'':'display:none;'?>" >
                <form class="form-horizontal" action="<?php echo site_url('site/pandit_submit'); ?>" method="post" enctype="multipart/form-data">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Add Pandit</strong> Master</h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                    </div>   
                    <h4 style="color: red;text-align: center;"><?php echo $this->session->flashdata('err_msg'); ?></h4>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-4 col-xs-12">
                                <label>User Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                    <input type="hidden" name="user_id" id="user_id" value="<?=$data['user_id']?>">
                                    <input type="hidden" name="type" value="USER">
                                    <input type="text" name="username" class="form-control" placeholder='Enter Name Of User' value="<?=$data['username']?>" required>
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Mobile</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder='Enter Mobile Of User' value="<?=$data['mobile']?>">
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                    <input type="email" name="email" id="email" class="form-control" placeholder='Enter Email Of User' value="<?=$data['email']?>">
                                </div>                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-4 col-xs-12">
                                <label>Address</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                    <input type="text" name="address" class="form-control" placeholder='Enter address' value="<?=$data['address']?>">
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                    <input type="password" name="password" id="password" class="form-control" placeholder='Enter password Of User' value="<?=$data['password']?>">
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>User Image</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="file" name="image" id="image"  class="form-control">
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
                    <h3 class="panel-title"><strong>Pandits</strong> List</h3>
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
                                    <th>Image</th>
                                    <th>User Name</th>
                                    <th>Address</th>
                                    <th>city</th>
                                    <th>state</th>
                                    <th>Mobile</th>
                                    <th>Revenue (This Month)</th>
                                    <th>Revenue (Last Month)</th>
                                    <th>Approve</th>
                                    <th>Status</th>
                                    <th>Update</th>
                                   <!-- <th>Delete</th>-->
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
                                    <td><img  height="130" width="130" src="<?php echo base_url().$r->image; ?>" alt="<?=$r->first_name?>"></td>
                                    <td><?php echo '<a href="'.site_url('site/pandit_detail').'?q='.$r->user_id.'">';
                                echo $r->username.'</a>'; 
                                ?></td>
                                    <td><?php echo $r->address; ?></td>
                                    <td><?php echo $r->city; ?></td>
                                    <td><?php echo $r->state; ?></td>
                                    <td><?php echo $r->mobile; ?></td>
                                    <td>
                                    <?php
                                        $this->load->database();
                                        $revenue=$this->db->select('SUM(price) as "TOTAL_REVENUE"')->where("status='3'")->where('panditId', $r->user_id)->where("MONTH(entrydt) = MONTH(CURRENT_DATE()) AND YEAR(entrydt) = YEAR(CURRENT_DATE())")->get('pooja_booking')->row();
                                        if ($revenue->TOTAL_REVENUE!==NULL) {
                                            echo $revenue->TOTAL_REVENUE;
                                        }else{
                                            echo '0';
                                        }
                                    ?></td>
                                    <td>
                                    <?php
                                        $this->load->database();
                                        $revenue=$this->db->select('SUM(price) as "TOTAL_REVENUE"')->where("status='3'")->where('panditId', $r->user_id)->where("YEAR(entrydt) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(entrydt) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)")->get('pooja_booking')->row();
                                        if ($revenue->TOTAL_REVENUE!==NULL) {
                                            echo $revenue->TOTAL_REVENUE;
                                        }else{
                                            echo '0';
                                        }
                                    ?></td>
                                    <td>
                                    <?php
                                        if (!$r->approved) {
                                            echo '
<a href="'.site_url('site/change_pandit_approve').'?q='.$r->user_id .'&s=1" onclick="return confirm(\'Do You want approve this pandit.\')" class="btn btn-success"><i class="fa fa-check"></i>Approve</a>
<a href="'.site_url('site/change_pandit_approve').'?q='.$r->user_id .'&s=2" onclick="return confirm(\'Do You want reject this pandit.\')" class="btn btn-danger"><i class="fa fa-times"></i>Rject</a>';
                                        }else{
                                            if ($r->approved === '1') {
                                                echo 'Approved';
                                            }else if ($r->approved ==='2') {
                                                echo 'Rejected';
                                            }
                                        }
                                    ?>
                                        
                                    </td>
                                    <td>
                                        <a href="<?=site_url('site/change_pandit_status').'?q='.$r->user_id?>" onclick="return confirm('Do You want Change the Status Of This User')" class="btn <?=$r->status?'btn-primary':'btn-danger'?>"><i class="fa fa-edit"></i> <?=$r->status?'Active':'Inactive'?></a>
                                    </td>
                                    <td>
                                        <a href="<?=site_url('site/pandit').'?q='.$r->user_id?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    </td>
                                    <!--<td>
                                        <a href="#" onclick="open_msg('<?=site_url("site/pandit_delete")."?q=".$r->user_id; ?>');" class="btn btn-primary"><i class="fa fa-trash-o"></i></a>
                                    </td>-->
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