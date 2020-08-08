<?php

/**
 * @Author: Shikhar Kulshrestha
 * @Date:   2020-04-23 00:05:57
 * @Last Modified by:   Shikhar Kulshrestha
 * @Last Modified time: 2020-05-12 15:54:56
 */
?>
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
                        <h3 class="panel-title"><strong>Vendor</strong> Details</h3>
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
                                    <input type="text" name="name" class="form-control" placeholder='Enter Name Of User' value="<?=$data['name']?>" >
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                    <input type="email" name="email" id="email" class="form-control" placeholder='Enter Email Of User' value="<?=$data['email']?>" >
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Mobile</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                                    <input type="text" name="contact" id="mobile" class="form-control" placeholder='Enter Mobile Of User' value="<?=$data['contact']?>" >
                                </div>                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-4 col-xs-12">
                                <label>Shop Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                    <input type="text" name="shopName" class="form-control" placeholder='Enter address' value="<?=$data['shopName']?>" >
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Flat Number</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                    <input type="text" name="flatNo" id="password" class="form-control" placeholder='Enter password Of User' value="<?=$data['flatNo']?>" >
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Address</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="address" id="image" value="<?=$data['address']?>"  class="form-control" >
                                </div>                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-xs-12">
                                <label>Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                    <input type="text" name="password" class="form-control" placeholder='Enter address' value="<?=$data['password']?>" >
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Gender</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                    <input type="text" name="gender" class="form-control" placeholder='Enter address' value="<?=$data['gender']?>" >
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>PAN </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="panCard" id="image" value="<?=$data['panCard']?>"  class="form-control" >
                                </div>                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-xs-12">
                                <label>Aadhaar</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                    <input type="text" name="adharCard" class="form-control" placeholder='Enter address' value="<?=$data['adharCard']?>" >
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Bank Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                    <input type="text" name="bankName" id="image" value="<?=$data['bankName']?>"  class="form-control" >
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Bank Account Number</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="bankAccountNumber" id="image" value="<?=$data['bankAccountNumber']?>"  class="form-control" >
                                </div>                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-xs-12">
                                <label>IFSC Code</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                    <input type="text" name="ifscCode" class="form-control" placeholder='Enter address' value="<?=$data['ifscCode']?>" >
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Account Holder Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                    <input type="text" name="accountHolderName" id="image" value="<?=$data['accountHolderName']?>"  class="form-control" >
                                </div>                                
                            </div>
                        </div>

                        <div class="panel-footer">
                            <a href="<?=site_url('site/vendor')?>" class="btn btn-default">Go Back</a>
                            <input type="submit" class="btn btn-primary pull-right" value="Submit">
                        </div> <!-- END panel-footer -->
                        
                    </div> <!-- END panel-body -->
                    
                    </form>
            </div> <!-- END panel panel-default -->
      
        </div> <!-- END col-md-6 -->

        <div class="col-md-12">
        
            <div class="panel panel-default" style="<?=$form?'':'display:none;'?>" >
                <form class="form-horizontal" action="<?php echo site_url('site/send_notification'); ?>" method="post" enctype="multipart/form-data">
                    <div class="panel-heading">
                        <h3 class="panel-title">Send<strong>Notification</strong></h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                    </div>   
                    <h4 style="color: red;text-align: center;"><?php echo $this->session->flashdata('err_msg'); ?></h4>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-4 col-xs-12">
                                <label>Notification Title</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                    <input type="hidden" name="id" id="user_id" value="<?=$data['id']?>">
                                    <input type="hidden" name="mobile" value="<?=$data['contact']?>">
                                    <input type="hidden" name="Type" value="vendor">
                                    <input type="text" name="title" class="form-control" placeholder="Enter Notification Title">
                                </div>                                
                            </div>
                            <div class="col-md-8 col-xs-12">
                                <label>Notification Message</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                                    <textarea name="body" id="mobile" class="form-control" placeholder="Enter Notification Body"></textarea>
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
                    <h3 class="panel-title"><strong>Order</strong> List</h3>
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
                                    <th>Username</th>
                                    <th>Category</th>
                                    <th>Product</th>
                                    <th>Address</th>
                                    <th>Location</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Aciton</th>
                                    <th>Vendor Feedback</th>
                                    <th>User Feedback</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $id = "";
                                foreach($orders as $r)
                                {
                                    $i++;                                
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                <td><a href="<?php echo site_url('site/user_detail').'?q='.$r['user_id']; ?>"><?php echo $r['user_name']; ?></a></td>
                                <td><?php echo $r['category_name']; ?></td>
                                <td><?php echo $r['product_name']; ?></td>
                                <td><?php echo $r['address'].' - '.$r['pincode']; ?></td>
                                <td><?php echo $r['city'].' ('.$r['state'].')'; ?></td>
                                <td><?php echo $r['quantity']; ?></td>
                                <td><?php echo $r['amount'].' ('.$r['payment_mode'].')'; ?></td>
                                <?php
                                    echo '<td>';
                                if ($r['status'] ==='0') {
                                    echo 'Order Placed.';
                                }else if ($r['status'] ==='1') {
                                    echo 'Order Accepted.';
                                }else if ($r['status'] ==='2') {
                                    echo 'Order Packed.';
                                }else if ($r['status'] ==='3') {
                                    echo 'Order out for delivery.';
                                }else if ($r['status'] ==='4') {
                                    echo 'Order Delivered.';
                                }else if ($r['status'] ==='5') {
                                    echo 'Order Cancelled by user.';
                                }else if ($r['status'] ==='6') {
                                    echo 'Order Cancelled by Vendor.';
                                }else if ($r['status'] ==='7') {
                                    echo 'Order Cancelled by Admin';
                                }else if ($r['status'] ==='8') {
                                    echo 'Order Expired.';
                                }
                                echo '</td><td>';
                                if ($r['status']==='0' || $r['status']==='1' || $r['status']==='2') {
                                    echo '<a href="'.site_url('site/change_vendor_order_status').'?q='.$r['id'].'&s=7&g='.urlencode("vendor_detail?q=".$r['vendorId']).'" onclick="return confirm(\'Do You really want to Cancel this order.\')" class="btn btn-primary"><i class="fa fa-times"></i>Cancel this Order</a>';
                                }
                                echo '</td>';

                                ?>
                                <td><?php echo $r['vendor_feedback']; ?></td>
                                <td><?php echo $r['user_feedback']; ?></td>    
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