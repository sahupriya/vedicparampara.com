<script>
$( document ).ready(function() {
    $("#add_product").addClass('active');
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
    <li><a href="#">Add product</a></li>    
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
       <!-- <div class="col-md-12">
        
            <div class="panel panel-default" style="<?=$form?'':'display:none;'?>" >
                <form class="form-horizontal" action="<?php echo site_url('site/product_submit'); ?>" method="post" enctype="multipart/form-data">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Add Product</strong> Master</h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                    </div>   
                    <h4 style="color: red;text-align: center;"><?php echo $this->session->flashdata('err_msg'); ?></h4>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-4 col-xs-12">
                                <label>Product Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-shopping-cart"></span></span>
                                    <input type="hidden" name="product_id" id="product_id" value="<?=$data['product_id']?>">
                                    <input type="text" name="name" class="form-control" placeholder='Enter Name Of product' value="<?=$data['name']?>" required>
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Price</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-inr"></span></span>
                                    <input type="text" name="price" class="form-control" placeholder='Enter price Of product' value="<?=$data['price']?>">
                                </div>                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <label>Image</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-image"></span></span>
                                    <input type="file" name="image" class="form-control" <?=$data['image']?'':'required'?>>
                                </div>                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-4 col-xs-12">
                                <label>Category</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-caret-down"></span></span>
                                    <select name="category_id" class="form-control">
                                        <option value=''>-Select-</option>
                                        <?php
                                        foreach($category_list as $r){
                                            $selected = $r->category_id == $data['category_id'] ? 'selected' :'';
                                            echo "<option value='$r->category_id' $selected>$r->category_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>                                
                            </div>
                            <div class="col-md-8 col-xs-12">
                                <label>Product description</label>
                                <textarea name="description" class="form-control" placeholder="Enter description of Product"><?=$data['description']?></textarea>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <a  class="btn btn-default" onclick="reset();">Clear Form</a>
                            <input type="submit" id="submit" class="btn btn-primary pull-right" value="Submit">
                        </div> 
                    </div> 
                </form>
            </div> 
      
        </div>--> <!-- END col-md-6 -->

       
        <div class="col-md-12">
            <form class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>products</strong> List</h3>
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
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Product description</th>
                                    <th>Category</th>
                                    <th>Vendor Name</th>
                                    <th>Status</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $id = "";
                                foreach($product as $r)
                                {
                                    $i++;                                
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><img  height="130" width="130" src="<?php echo base_url().$r->image; ?>"></td>
                                    <td><?php echo $r->name; ?></td>
                                    <td><?php echo $r->price; ?></td>
                                    <td><?php echo $r->description; ?></td>
                                    <td><?php echo $r->category_name; ?></td>
                                    <td><a href="<?=site_url('site/vendor_detail').'?q='.$r->vendor_id?>"><?php echo $r->vendor_name; ?></a></td>
                                    <td>
                                        <a href="<?=site_url('site/change_product_status').'?q='.$r->product_id?>" onclick="return confirm('Do You want Change the Status Of This product')" class="btn <?=$r->status?'btn-primary':'btn-danger'?>"><i class="fa fa-edit"></i> <?=$r->status?'Active':'Inactive'?></a>
                                    </td>
                                    <td>
                                        <a href="<?=site_url('site/product').'?q='.$r->product_id?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    </td>
                                    <td>
                                        <a href="#" onclick="open_msg('<?=site_url("site/product_delete")."?q=".$r->product_id; ?>');" class="btn btn-primary"><i class="fa fa-trash-o"></i></a>
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