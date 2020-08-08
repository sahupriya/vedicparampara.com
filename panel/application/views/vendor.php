<script>
$( document ).ready(function() {
    $("#add_vendor").addClass('active');
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
    <li><a href="#">Add Vendor</a></li>    
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
        
            <div class="panel panel-default" style="<?=$form?'':'display:none;'?>" >
                <form class="form-horizontal" action="<?php echo site_url('site/vendor_submit'); ?>" method="post" enctype="multipart/form-data">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Add Vendor</strong> Master</h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                    </div>   
                    <h4 style="color: red;text-align: center;"><?php echo $this->session->flashdata('err_msg'); ?></h4>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-4 col-xs-12">
                                <label>Vendor Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                    <input type="hidden" name="id" id="user_id" value="<?=$data['id']?>">
                                    <input type="text" name="name" class="form-control" placeholder='Enter Name Of User' value="<?=$data['name']?>" required>
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                    <input type="email" name="email" id="email" class="form-control" placeholder='Enter Email Of User' value="<?=$data['email']?>">
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Mobile</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                                    <input type="text" name="contact" id="mobile" class="form-control" placeholder='Enter Mobile Of User' value="<?=$data['contact']?>">
                                </div>                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-4 col-xs-12">
                                <label>Shop Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                    <input type="text" name="shopName" class="form-control" placeholder='Enter address' value="<?=$data['shopName']?>">
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Flat Number</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                    <input type="text" name="flatNo" id="password" class="form-control" placeholder='Enter password Of User' value="<?=$data['flatNo']?>">
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Address</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="address" id="image" value="<?=$data['address']?>"  class="form-control">
                                </div>                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-xs-12">
                                <label>Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                    <input type="text" name="password" class="form-control" placeholder='Enter address' value="<?=$data['password']?>">
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Gender</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                    <select class="form-control" name="gender" id="password">
                                        <?php
                                            echo '<option value="Male"';
                                            if (strtoupper($data['gender'])==='MALE') {
                                                echo 'selected';
                                            }echo ">Male</option>";
                                            echo '<option value="Female"';
                                            if (strtoupper($data['gender'])==='FEMALE') {
                                                echo 'selected';
                                            }echo ">Female</option>";
                                        ?>
                                    </select>
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>PAN </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="panCard" id="image" value="<?=$data['panCard']?>"  class="form-control">
                                </div>                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-xs-12">
                                <label>Aadhaar</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                    <input type="text" name="adharCard" class="form-control" placeholder='Enter address' value="<?=$data['adharCard']?>">
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Bank Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                    <input type="text" name="bankName" id="image" value="<?=$data['bankName']?>"  class="form-control">
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Bank Account Number</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="bankAccountNumber" id="image" value="<?=$data['bankAccountNumber']?>"  class="form-control">
                                </div>                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-xs-12">
                                <label>IFSC Code</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                    <input type="text" name="ifscCode" class="form-control" placeholder='Enter address' value="<?=$data['ifscCode']?>">
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Account Holder Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                    <input type="text" name="accountHolderName" id="image" value="<?=$data['accountHolderName']?>"  class="form-control">
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
                    <h3 class="panel-title"><strong>Vendors</strong> List</h3>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Shop Name</th>
                                    <th>Address</th>
                                    <th>Shop Name</th>
                                    <th>Revenue(This Month)</th>
                                    <th>Revenue(Last Month)</th>
                                    <th>Status</th>
                                    <th>Update</th>
                                    <!--<th>Delete</th>-->
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
                                <td><?php echo '<a href="'.site_url('site/vendor_detail').'?q='.$r->id.'">';
                                echo $r->name.' ('.$r->gender.')</a>'; 
                                ?></td>
                                <td><?php echo $r->email; ?></td>
                                <td><?php echo $r->contact; ?></td>
                                <td><?php echo $r->shopName; ?></td>
                                <td><?php echo $r->address; ?></td>
                                <td><?php echo $r->shopName; ?></td>
                                <td>
                                    <?php
                                        
                                        $this->load->database();
                                        $revenue=$this->db->select('SUM(amount * quantity) as "TOTAL_REVENUE"')->where("status='4'")->where('vendorId', $r->id)->where("MONTH(entry_date) = MONTH(CURRENT_DATE()) AND YEAR(entry_date) = YEAR(CURRENT_DATE())")->get('orders')->row();
                                        if ($revenue->TOTAL_REVENUE!==NULL) {
                                            echo $revenue->TOTAL_REVENUE;
                                        }else{
                                            echo '0';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        
                                        $this->load->database();
                                        $lrevenue=$this->db->select('SUM(amount * quantity) as "TOTAL_REVENUE"')->where("status='4'")->where('vendorId', $r->id)->where("YEAR(entry_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(entry_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)")->get('orders')->row();
                                        if ($lrevenue->TOTAL_REVENUE!==NULL) {
                                            echo $lrevenue->TOTAL_REVENUE;
                                        }else{
                                            echo '0';
                                        }
                                    ?>
                                </td>
                                <?php
                                    echo '<td>';
                                if ($r->isActive ==='2') {
                                    echo '
<a href="'.site_url('site/change_vendor_status').'?q='.$r->id.'&s=4" onclick="return confirm(\'Do You want Change the Status Of This User\')" class="btn btn-primary"><i class="fa fa-edit"></i>De-Activate</a>';
                                }else if ($r->isActive ==='4') {
                                    echo '
<a href="'.site_url('site/change_vendor_status').'?q='.$r->id.'&s=2" onclick="return confirm(\'Do You want Change the Status Of This User\')" class="btn btn-danger"><i class="fa fa-edit"></i>Activate</a>
                                    ';
                                }
                                else if ($r->isActive ==='1') {
                                    echo '
<a href="'.site_url('site/change_vendor_status').'?q='.$r->id.'&s=2" onclick="return confirm(\'Do You want Change the Status Of This User\')" class="btn btn-success"><i class="fa fa-check"></i>Approve</a>
<a href="'.site_url('site/change_vendor_status').'?q='.$r->id.'&s=3" onclick="return confirm(\'Do You want Change the Status Of This User\')" class="btn btn-danger"><i class="fa fa-times"></i>Deny</a>';

                                }else if ($r->isActive ==='3') {
                                    echo '
<a href="'.site_url('site/change_vendor_status').'?q='.$r->id.'&s=2" onclick="return confirm(\'Do You want Change the Status Of This User\')" class="btn btn-danger"><i class="fa fa-check-square-o"></i>Re-Approve</a>
                                    ';
                                }
                                echo '</td>';
                                ?>
                                    <td>
                                        <a href="<?=site_url('site/vendor').'?q='.$r->id?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    </td>
                                    <!--<td>
                                        <a href="#" onclick="open_msg('<?=site_url("site/vendor_delete")."?q=".$r->id; ?>');" class="btn btn-primary"><i class="fa fa-trash-o"></i></a>
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