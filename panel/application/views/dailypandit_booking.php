<script>
$( document ).ready(function() {
    $("#dailypandit_booking").addClass('active');
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
    <li><a href="#">Update Daily Pandit Booking</a></li>    
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
       
        <div class="col-md-12">
            <form class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Daily Pandit Booking</strong> List</h3>
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
                                    <th>Address</th>
                                    <th>Subscription Name</th>
                                    <th>Pay Type</th>
                                    <th>Price</th>
                                    <th>Transection Id</th>
                                    <th>Entry Date</th>
									<th>Pandit ji Name</th>
                                   <!-- <th>Action</th>-->
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
                                  <td><?php echo $r->address; ?></td>
                                    <td><?php
                                        $s=$this->db->where('id',$r->subscription_id)->get('dailypandit_subscription');
                                                if($s->row()->subscription_type==1){   $ss="Monthly"; }
											else if($s->row()->subscription_type==2){   $ss="2 Monthly";}
											else if($s->row()->subscription_type==3){    $ss="Quaterly";}
											else if($s->row()->subscription_type==4){    $ss="Half Yearly";}
											else if($s->row()->subscription_type==5){    $ss="Yearly";}
                                         echo  $s->row()->subscription_for."(". $ss .")";  ?></td>
                                    
                                    <td><?php echo $r->pay_type; ?></td>
                                    <td><?php echo $r->price; ?></td>
                                    <td><?php echo $r->transection_id; ?></td>
                                    <td><?php echo $r->entry_date; ?></td>
                                    <td><a href="<?=site_url('site/pandit_detail').'?q='.$r->pandit_id?>">
                                        <?php echo $this->db->where('user_id',$r->pandit_id)->get('pandit')->row()->username; ?>
                                        </a></br>
                                        <?php $pandit = $this->db->where('subscription_status',1)->where('subscription_id',$r->subscription_id)->get('dailypandit'); 
                                          if($pandit->num_rows()>0){   ?>
                                            <a href="<?=site_url('site/assign_pandit/dailypandit').'?q='.$r->booking_id .'&subscription_id='.$r->subscription_id?>"  class="btn btn-info">Assign Pandit</a>
                                            <?php }else{echo "No any pandit is subscribe for this subscription";} ?>
                                    </td>
                                   <!-- <td>
                                        <a href="<?=site_url('site/change_dailypandit_status').'?q='.$r->user_id?>" onclick="return confirm('Do You want Change the Status Of This User')" class="btn <?=$r->status?'btn-primary':'btn-danger'?>"><i class="fa fa-edit"></i> <?=$r->status?'Active':'Inactive'?></a>
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