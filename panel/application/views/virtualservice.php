<script>
$( document ).ready(function() {
    $("#virtualservice").addClass('active');
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
    <li><a href="#">Add Virtual Service</a></li>    
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">

        <div class="col-md-6">
        
            <div class="panel panel-default" style="<?=$form?'':'display:none;'?>" >
                <form class="form-horizontal" action="<?php echo site_url('site/virtual_submit'); ?>" method="post" enctype="multipart/form-data">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Add Virtual Service</strong> Master</h3>
                        <ul class="panel-controls">
                           <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                    </div>   
                    <h4 style="color: red;text-align: center;"><?php echo $this->session->flashdata('err_msg'); ?></h4>
                    <div class="panel-body">
                       
                        
                        <div class="form-group">
                            <div class="col-md-6 col-xs-12">
                                <label>Virtual service Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="hidden" name="id" value="<?=$data['id']?>">
                                    <select class="form-control" name="virtual_service" id="virtual_service" required="required">
                                            <option value="">--Select Service--</option> 
											<option value="paramars">Paramars</option> 
											<option value="kundali">Kundali Making</option>                                      
                                        </select>
                                </div>                                
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label>Price</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-inr"></span></span>
                                    <input type="text" name="price"  value="<?=$data['price']?>" class="form-control" placeholder='00'>
                                </div>                                
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <label>Description</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <textarea name="description"  class="form-control" ><?=$data['description']?></textarea>
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
      
        </div>
        <div class="col-md-6">
            <form class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Virtual Service</strong> List</h3>
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
                                    <th>Service</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <!--<th>Delete</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                
                                foreach($virtualservices as $r)
                                {
                                    $i++;  
                                  // print_r($pooja);
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $r->virtual_service; ?></td>
                                    <td><?php echo $r->price; ?></td>
                                    <td><?php echo $r->description; ?></td>
                                   <!-- <td>
                                        <a href="#" onclick="open_msg('<?=site_url("site/vertualservice_delete")."?q=".$r->id; ?>');" class="btn btn-primary"><i class="fa fa-trash-o"></i></a>
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
        </div>
    </div> <!-- END row -->
</div> <!-- END page-content-wrap -->
<!-- END PAGE CONTENT WRAPPER -->