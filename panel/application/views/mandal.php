
<script>
$( document ).ready(function() {
    $("#mandal").addClass('active');
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
    <li><a href="#">Add Bhajan Mandal</a></li>    
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
        
            <div class="panel panel-default" style="<?=$form?'':'display:none;'?>" >
                <form class="form-horizontal" action="<?php echo site_url('site/mandal_submit'); ?>" method="post" enctype="multipart/form-data">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Bhajan Mandal Update</strong> Master</h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                    </div>   
                    <h4 style="color: red;text-align: center;"><?php echo $this->session->flashdata('err_msg'); ?></h4>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-6 col-xs-12">
                                <label>Mandal Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-plane"></span></span>
                                    <input type="hidden" name="mandal_id" value="<?=$data['mandal_id']?>">
                                    <input type="text" name="mandali_name" value="<?=$data['mandali_name']?>" class="form-control" placeholder='Enter Name Of Mandali' required>
                                </div>                                
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label>Price</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-inr"></span></span>
                                    <input type="text" name="price"  value="<?=$data['price']?>" class="form-control" placeholder='00'>
                                </div>                                
                            </div>

                            <div class="col-md-6 col-xs-12">
                                <label>Mandali Images (Multiple)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="file" name="image[]" class="form-control" multiple="">
                                </div>                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-xs-12">
                                <label>Convenience_Fee</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-inr"></span></span>
                                    <input type="text" name="Convenience_Fee" value="<?=$data['Convenience_Fee']?>" class="form-control" placeholder='00'>
                                </div>                                
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label>GST</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-inr"></span></span>
                                    <input type="text" name="GST" value="<?=$data['GST']?>" class="form-control" placeholder='00%'>
                                </div>                               
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-12 col-xs-12">
                                <label>Description</label>
                                <textarea name="description"  class="form-control" placeholder='Describe The Pooja'><?=$data['description']?></textarea>
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
                    <h3 class="panel-title"><strong>Bhajan Mandal</strong> List</h3>
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
                                    <th>Mandali Name</th>
                                    <th>Price</th>
                                    
                                    <th>Description</th>
                                    
                                    <th>Convenience Fee</th>
                                    <th>GST%</th>
                                    <th>Status</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach($mandal as $m)
                                {
                                    $i++;  
                                    $images = explode(",",$m->image);
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td style="max-width:120px;">
                                        <div class="owl-carousel" id="owl-example">
                                            <?php foreach($images as $img){ ?>
                                            <img  height="50" width="120" src="<?php echo base_url(); ?><?php echo $img; ?>" alt="Image">
                                            <?php } ?>
                                        </div> 
                                    </td>
                                    <td><?php echo $m->mandali_name; ?></td>
                                    <td><?php echo $m->price; ?></td>
                                    <td><?php echo $m->description; ?></td>
                                    <td><?php echo $m->Convenience_Fee; ?></td>
                                    
                                    <td><?php echo $m->GST; ?></td>
                                    
                                    <td>
                                        <a href="<?=site_url('site/change_mandal_status').'?q='.$m->mandal_id?>" onclick="return confirm('Do You want Change the Status Of This Mandali')" class="btn <?=$m->status?'btn-primary':'btn-danger'?>"><i class="fa fa-edit"></i> <?=$m->status?'Active':'Inactive'?></a>
                                    </td>
                                    <td>
                                        <a href="<?=site_url('site/mandal').'?m='.$m->mandal_id?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    </td>
                                    <td>
                                        <a href="#" onclick="open_msg('<?=site_url("site/mandal_delete")."?q=".$m->mandal_id; ?>');" class="btn btn-primary"><i class="fa fa-trash-o"></i></a>
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