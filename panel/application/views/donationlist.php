<script>
$( document ).ready(function() {
    $("#donation-list").addClass('active');
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


<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">


       
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
                                    <th>Donation user name</th>
                                    <th>Donation Cause</th>
                                    <th>Donation Amount</th>
                                    <th>Donation Mode</th>
                                    <th>Date</th>
                                    <!--<th>Action</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach($donationlisting as $d)
                                {
                                    $i++;                                
                                ?>
                                <tr>
                                    <td><?php  echo $i; ?></td>
                                    
                                    <td><?php echo $d['userName']; ?></td>
                                    <td><?php echo $d['donation_cause']; ?></td>
                                    <td><?php echo $d['amt']; ?></td>
                                    <td><?php echo $d['mode']; ?></td>
                                    <td><?php echo $d['entrydate']; ?></td>
                                    <!--<td>
                                        <a href="<?=site_url('site/change_donationlisting_status').'?d='.$d->donationListing_id?>" onclick="return confirm('Do You want Change the Status Of This product')" class="btn <?=$d->status?'btn-primary':'btn-danger'?>"><i class="fa fa-edit"></i> <?=$d->status?'Active':'Inactive'?></a>
                                    </td>
                                    
                                    <td>
                                        <a href="#" onclick="open_msg('<?=site_url("site/dontionlisting_delete")."?d=".$d->donationListing_id; ?>');" class="btn btn-primary"><i class="fa fa-trash-o"></i></a>
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