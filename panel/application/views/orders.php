<script>
$( document ).ready(function() {
    $("#orders").addClass('active');
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
    <li><a href="#">Product Orders</a></li>    
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
       
        <div class="col-md-12">
            <form class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Product Orders</strong> List</h3>
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
                                    <th>User Name</th>
                                    <th>Vendor Name</th>
									<th>Category Name</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>status</th>
                                    <th>Price</th>
                                    <th>Admin Amount</th>
                                    <th>Transectio Id</th>
                                    <th>Payment Mode</th>
                                    <th>Entry Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach($pooja_booking as $r)
                                {
                                    $i++; 
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><a href="<?=site_url('site/user_detail').'?q='.$r->user_id?>"><?php 
                                  echo  $this->db->where('user_id',$r->user_id)->get('user')->row()->username; ?></a></td>                                    
                                    <td><?php echo $this->db->where('id',$r->vendorId)->get('vender')->row()->name; ?></td>
                                    <td><?php echo $r->category_name; ?></td>
                                    <td><?php echo $r->product_name; ?></td>
                                    <td><?php echo $r->quantity; ?></td>
                                    <td><?php if($r->status==0){ echo "place";}
                                    elseif($r->status==1){ echo "accept"; }
                                    elseif($r->status==2){ echo "packed";}
                                    elseif($r->status==3){ echo "deliver";}
                                    elseif($r->status==4){ echo "delivered";}
                                    elseif($r->status==5){ echo "cancel by user";}
                                    elseif($r->status==6){ echo "cancelby vender"; }
                                    elseif($r->status==7){ echo "cancelby admin"; }
                                    elseif($r->status==8){ echo "expierd"; }?></td>
                                    <td><?php echo $r->amount; ?></td>
                                    <td><?php echo $r->admin_amount; ?></td>
                                    <td><?php echo $r->transection_id; ?></td>
                                    <td><?php echo $r->payment_mode; ?></td>
                                    <td><?php echo $r->entry_date; ?></td>
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