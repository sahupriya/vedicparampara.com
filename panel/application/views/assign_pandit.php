<script>
$( document ).ready(function() {
    $("#terms").addClass('active');
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
    <li><a href="#">Assign Pandit</a></li>    
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-6">
        <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Assign Pandit</strong></h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    
            <?php 
            
                                       if($this->uri->segment(3)=="dailypandit"){
                                                $pandit = $this->db->where('subscription_status',1)->where('subscription_id',$subscription_id)->get('dailypandit'); 
                                            if($pandit->num_rows()>0){ ?> 
                                            <form action="<?=site_url('site/update_dlypandit_for_user')?>" method="post" style="display:block;">
                                                <select  class="form-control"  name="pandit_id" required="required" id="pandit_id">
                                                <option value="">--Select Pandit--</option> 
                                               <?php foreach($pandit->result() as $obj ){ 
                                                $res= $this->db->where('user_id',$obj->pandit_id)->get('pandit')->row();
                                                $res1= $this->db->where('booking_id',$q)->get('dailypandit_booking')->row()->pandit_id;
                                              ?>
                                                <option value="<?php echo $res->user_id; ?>" <?php echo isset($res1) && $res1 == $res->user_id ?  'selected="selected"' : ''; ?>><?php echo $res->username; ?> ( <?php echo $res->mobile; ?> ) </option>
                                                <?php } ?>                                           
                                                </select>
                                                <input type="hidden" name="id" value="<?php echo $q; ?>" id="booking_id">
                                                <input type="submit" class="btn-info" value="Assign" id="submitform">
                                            </form>
                                            <?php   }else{echo "No any pandit is subscribe for this subscription";} ?>
                                        <?php   }else  if($this->uri->segment(3)=="mandal"){
                                            $pandit1 = $this->db->where('booking_id',$q)->get('mandal_booked')->row()->panditId; 
                                          ?>
                                            <form action="<?=site_url('site/mandal_assign_byadmin')?>" method="post">
                                            <select  class="form-control"  name="pandit_id"  id="pandit_id" required="required" >
                                                <option value="">--Select Pandit--</option> 
                                                <?php $pandit=$this->db->where('status',1)->get('pandit')->result();
                                                foreach($pandit as $obj ){ ?>
                                                <option value="<?php echo $obj->user_id; ?>" <?php echo isset($pandit1) && $pandit1 == $obj->user_id ?  'selected="selected"' : ''; ?>><?php echo $obj->username; ?> ( <?php echo $obj->mobile; ?> ) </option>
                                                <?php } ?>                                            
                                            </select>
                                            <input type="hidden" name="id" value="<?php echo $q; ?>" id="booking_id">
                                            <input type="submit" class="btn-info" value="Assign">
                                            </form>
                                        <?php    } else  if($this->uri->segment(3)=="ayojan"){
                                            $pandit1 = $this->db->where('booking_id',$q)->get('bhavya_ayojan')->row()->panditId; 
                                        ?> 
                                            <form action="<?=site_url('site/ayojan_assign_byadmin')?>" method="post">
                                            <select  class="form-control"  name="pandit_id"  id="pandit_id" required="required" >
                                                <option value="">--Select Pandit--</option> 
                                                <?php $pandit=$this->db->where('status',1)->get('pandit')->result();
                                                foreach($pandit as $obj ){ ?>
                                                <option value="<?php echo $obj->user_id; ?>" <?php echo isset($pandit1) && $pandit1 == $obj->user_id ?  'selected="selected"' : ''; ?>><?php echo $obj->username; ?> ( <?php echo $obj->mobile; ?> ) </option>
                                                <?php } ?>                                            
                                            </select>
                                            <input type="hidden" name="id" value="<?php echo $q; ?>" id="booking_id">
                                            <input type="submit" class="btn-info" value="Assign">
                                            </form>
                                       <?php } ?>
                                         
                                        
                                         <!-- END panel panel-default -->
      </div></div>
        </div> <!-- END col-md-6 -->
    </div> <!-- END row -->
</div> <!-- END page-content-wrap -->
<!-- END PAGE CONTENT WRAPPER -->