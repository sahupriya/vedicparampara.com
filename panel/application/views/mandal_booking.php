<script>
$( document ).ready(function() {
    $("#mandal_booking").addClass('active');
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
    <li><a href="#">Update Mandal Booking</a></li>    
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
       
        <div class="col-md-12">
            <form class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Mandal Booking</strong> List</h3>
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
                                    <th>Mandal Name</th>
									<th>Pandit ji Name</th>
                                    <th>Address</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Price</th>
                                    <th>Transection Id</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <!--<th>Update</th>
                                    <th>Delete</th>-->
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

                                    <td><a href="<?=site_url('site/user_detail').'?q='.$r->user_id?>"><?php echo $r->user_name; ?></a></td>                                    
                                    <td><?php echo $r->mandali_name; ?></td>
                                    
                                     <td><!--<a href="<?=site_url('site/pandit_detail').'?q='.$r->accepted_by?>"><?php echo $r->accepted_by_name; ?></a>-->
                                     <a href="<?=site_url('site/pandit_detail').'?q='.$r->panditId?>">
                                        <?php echo $this->db->where('user_id',$r->panditId)->get('pandit')->row()->username; ?>
                                        </a></br>
                                     <a href="<?=site_url('site/assign_pandit/mandal').'?q='.$r->booking_id?>"  class="btn btn-info">Assign Pandit</a>
                                    
                                     </td>
                                     
                                    <td><?php echo $r->address.', '.$r->state.' - '.$r->pincode; ?></td>
                                    <td><?php echo $r->date; ?></td>
                                    <td><?php echo $r->time; ?></td>
                                    <td><?php echo $r->amount; ?></td>
                                    <td><?php echo $r->transection_id; ?></td>
                                    <td><?php echo $r->status; ?></td>
                                    <?php
                                    echo '<td>';
                                    if ($r->status==='accepted' || $r->status==='pending') {
                                        echo '<a href="'.site_url('site/change_mandal_booking_status').'?q='.$r->booking_id.'&s='.urlencode("Cancelled By Admin").'&g='.urlencode("mandal_booking").'" onclick="return confirm(\'Do You really want to Cancel this Booking.\')" class="btn btn-primary"><i class="fa fa-times"></i>Cancel</a>';
                                    }
                                    echo '</td>';
                                    ?>
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