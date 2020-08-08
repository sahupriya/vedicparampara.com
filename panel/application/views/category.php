<script>
    $( document ).ready(function() {
    $("#category").addClass('active');
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
    <li><a href="#">Add category</a></li>    
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
        
            <div class="panel panel-default" style="<?=$form?'':'display:none;'?>" >
                <form class="form-horizontal" action="<?php echo site_url('site/category_submit'); ?>" method="post" enctype="multipart/form-data">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Add category</strong> Master</h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                    </div>   
                    <h4 style="color: red;text-align: center;"><?php echo $this->session->flashdata('err_msg'); ?></h4>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-6 col-xs-12">
                                <label class="col-md-4">category Name</label>
                                <div class="input-group col-md-8">
                                    <span class="input-group-addon"><span class="fa fa-category"></span></span>
                                    <input type="hidden" name="category_id" id="category_id" value="<?=$data['category_id']?>">
                                    <input type="text" name="category_name" class="form-control" placeholder='Enter Name Of category' value="<?=$data['category_name']?>" required>
                                </div>                                
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label class="col-md-4">category Image</label>
                                <div class="input-group col-md-8">
                                    <span class="input-group-addon"><span class="fa fa-category"></span></span>
                                    <input type="file" name="image" id="image"  class="form-control">
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
                    <h3 class="panel-title"><strong>categorys</strong> List</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>S. No.</th>
                                <th>category Name</th>
                                <th>category Image</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $id = "";
                            foreach($category as $r)
                            {
                                $i++;                                
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $r->category_name; ?></td>
                                <td><img src="<?php echo base_url().$r->image;?>"  height="130" width="130"></td>
                                <td>
                                    <a href="<?=site_url('site/category').'?q='.$r->category_id?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                </td>
                                <td>
                                    <a href="#" onclick="open_msg('<?=site_url("site/category_delete")."?q=".$r->category_id; ?>');" class="btn btn-primary"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            <?php                            
                            }
                            ?>
                        </tbody>
                    </table>
                </div> <!-- END panel-body -->
            </div> <!-- END panel panel-default -->
            </form>
        </div> <!-- END col-md-6 -->
        
    </div> <!-- END row -->
</div> <!-- END page-content-wrap -->
<!-- END PAGE CONTENT WRAPPER -->