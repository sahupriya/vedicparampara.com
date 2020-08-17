<script>
$( document ).ready(function() {
    $("#virtualservice_request").addClass('active');
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
    <li><a href="#">Virtual Service Request List</a></li>    
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <h4 style="color: red;text-align: center;"><?php echo $this->session->flashdata('err_msg'); ?></h4>
            <!--<form class="form-horizontal">-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Paramars</strong> Request List</h3>
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
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Place of Birth</th>
                                    <th>Question</th>
                                    <th>Preffered Timing</th>
                                    <th>Call Option</th>
                                    <th>Req. Date</th>
                                    <th>Price</th>
                                    <th>provide Pandit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                
                                foreach($virtualservice as $d)
                                {
                                    $i++;                                
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $d->name; ?></td>
                                     <td><?php echo $d->contact; ?></td>
                                      <td><?php echo $d->email; ?></td>
                                       <td><?php echo $d->place_birth; ?></td>
                                       
                                    <td><?php echo $d->question; ?></td>
                                    <td><?php echo $d->preffered_timing; ?></td>
                                    <td><?php echo $d->call_option; ?></td>
                                    <td><?php echo $d->date_time; ?></td>
                                    <td><?php echo $d->price; ?></td>
                                    <td>
                                       <form class="form-horizontal" action="<?php echo site_url('site/paramarspandit_submit'); ?>" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                            <div class="col-md-6">
                                                <select  class="form-control"  name="pandit_id"  id="pandit_id" required="required" >
                                                <option value="">--Select Pandit--</option> 
                                                <?php foreach($pandit as $obj ){ ?>
                                               <option value="<?php echo $obj->user_id; ?>" <?php echo isset($d->pandit_id) && $d->pandit_id == $obj->user_id ?  'selected="selected"' : ''; ?>><?php echo $obj->username; ?> ( <?php echo $obj->mobile; ?> ) </option>
                                                <?php } ?> 
                                                </select>
                                                <input type="hidden" id="id" name="id" class="btn btn-primary pull-right" value="<?php echo $d->id; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="submit" id="submit" class="btn btn-primary pull-right" value="Submit">
                                            </div>
                                        </div> 
                                        </form>
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
            <!--</form>-->
        </div> 
        
        <div class="col-md-12">
            <form class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Kundali Making</strong> Request List</h3>
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
                                     <th>Phone</th>
                                    <th>Email</th>
                                    <th>Place of Birth</th>
                                    <th>Req. Date</th>
                                    <th>Price</th>
                                    <th>provide Pandit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                
                                foreach($kundali as $d)
                                {
                                    $i++;                                
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $d->name; ?></td>
                                     <td><?php echo $d->contact; ?></td>
                                      <td><?php echo $d->email; ?></td>
                                       <td><?php echo $d->place_birth; ?></td>
                                    <td><?php echo $d->date_time; ?></td>
                                    <td><?php echo $d->price; ?></td>
                                    <td>
                                        <form class="form-horizontal" action="<?php echo site_url('site/kundalipandit_submit'); ?>" method="post" enctype="multipart/form-data">
                                            
                                            
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select  class="form-control"  name="pandit_id"  id="pandit_id" required="required" >
                                                <option value="">--Select Pandit--</option> 
                                                <?php foreach($pandit as $obj ){ ?>
                                                <option value="<?php echo $obj->user_id; ?>" <?php echo isset($d->pandit_id) && $d->pandit_id == $obj->user_id ?  'selected="selected"' : ''; ?>><?php echo $obj->username; ?> ( <?php echo $obj->mobile; ?> ) </option>
                                                <?php } ?> 
                                                </select>
                                                 <input type="hidden" id="id" name="id" class="btn btn-primary pull-right" value="<?php echo $d->id; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="submit" id="submit" class="btn btn-primary pull-right" value="Submit">
                                            </div>
                                        </div> 
                                        </form>
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
        </div> 
    </div> <!-- END row -->
</div> <!-- END page-content-wrap -->
<!-- END PAGE CONTENT WRAPPER -->