<script>
$( document ).ready(function() {
    $("#donation").addClass('active');
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
    <li><a href="#">Add Donations Cause</a></li>    
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
        
            <div class="panel panel-default" style="<?=$form?'':'display:none;'?>" >
                <form class="form-horizontal" action="<?php echo site_url('site/donation_submit'); ?>" method="post" enctype="multipart/form-data">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Add Donation Cause</strong> Master</h3>
                        <ul class="panel-controls">
                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                    </div>   
                    <h4 style="color: red;text-align: center;"><?php echo $this->session->flashdata('err_msg'); ?></h4>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-6 col-xs-6">
                                <label>Donation Cause Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-shopping-cart"></span></span>
                                    <input type="hidden" name="donation_id" id="donation_id" value="<?=$data['donation_id']?>">
                                    <input type="text" name="donation_cause" class="form-control" placeholder='Enter Name Of Cause' value="<?=$data['donation_cause']?>" required>
                                </div>                                
                            </div>
                            
                            <div class="col-md-6 col-xs-6">
                                <label>Donation Cause Description</label>
                                <textarea name="donation_discription" class="form-control" placeholder="Enter description of cause"><?=$data['donation_discription']?></textarea>
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
                    <h3 class="panel-title"><strong>Donations</strong> List</h3>
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
                                    <th>Donation Cause Name</th>
                                    <th>Donation description</th>
                                    <th>Status</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $id = "";
                                foreach($donation as $d)
                                {
                                    $i++;                                
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    
                                    <td><?php echo $d->donation_cause; ?></td>
                                    <td><?php echo $d->donation_discription; ?></td>

                                    <td>
                                        <a href="<?=site_url('site/change_donation_status').'?d='.$d->donation_id?>" onclick="return confirm('Do You want Change the Status Of This product')" class="btn <?=$d->status?'btn-primary':'btn-danger'?>"><i class="fa fa-edit"></i> <?=$d->status?'Active':'Inactive'?></a>
                                    </td>
                                    <td>
                                        <a href="<?=site_url('site/donation').'?q='.$d->donation_id?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    </td>
                                    <td>
                                        <a href="#" onclick="open_msg('<?=site_url("site/dontion_delete")."?d=".$d->donation_id; ?>');" class="btn btn-primary"><i class="fa fa-trash-o"></i></a>
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