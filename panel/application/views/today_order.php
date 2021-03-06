<?php

/**
 * @Author: Shikhar Kulshrestha
 * @Date:   2020-06-05 19:07:32
 * @Last Modified by:   Shikhar Kulshrestha
 * @Last Modified time: 2020-06-05 21:00:39
 */
?>



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
    <li><a href="#">Add User</a></li>    
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Today Order</strong> List</h3>
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
                                    <th>Category</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Order Address</th>
                                    <th>User</th>
                                    <th>Vendor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $id = "";
                                foreach($order as $r)
                                {
                                    $i++;                                
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $r->order_category_name; ?></td>
                                    <td><?php echo $r->order_product_name; ?></td>
                                    <td><?php echo $r->order_quantity; ?></td>
                                    <td><?php echo $r->order_amount; ?></td>
                                    <td><?php echo $r->order_address.', '.$r->order_state; ?></td>
                                    <td><?php echo $r->vendor_name.' ('.$r->vendor_mobile.')'; ?></td>
                                    <td><?php echo $r->user_name.' ('.$r->user_mobile.')'; ?></td>
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