
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>:: SHIVANGI STEEL ::</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="<?php echo site_url(); ?>img/company/logo.png" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo site_url(); ?>css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                                     
		<script type="text/javascript" src="<?php echo site_url(); ?>js/plugins/jquery/jquery.min.js"></script>
    </head>
    <body>
        <div class="error-container">
            <div class="error-code">404</div>
            <div class="error-text">page not found</div>
            <div class="error-subtext">Unfortunately we're having trouble loading the page you are looking for. Please wait a moment and try again or use action below.</div>
            <div class="error-actions">                                
                <div class="row">
                    <div class="col-md-6">
                        <a class="btn btn-info btn-block btn-lg" href="<?php echo site_url('site/dashboard');?>">Back to dashboard</a>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-block btn-lg" onClick="history.back();">Previous page</button>
                    </div>
                </div>                                
            </div>
            <div class="error-subtext">Or you can use search to find anything you need.</div>
            
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-search"></span></span>
    					    <input type="text" id="search_bar" name="search_bar" onkeyup="get_search_data(this.value);" placeholder="Search  for  pages . . ." class="form-control">
    				    </div>
    				</div>    
    				<div class="col-md-12">
                        <div class="form-group">
    					    <div id="search_div">
    						    <ul id="list"></ul>
    					    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>                 
    </body>
</html>
<script>
function get_search_data(val)
{
    if(val != '')
    {
        $.ajax({
			type:"post",
			url:"<?php echo site_url('site/get_search_data');?>",
			data:"value="+val,
			success:function(data)
			{
				$("#list").html(data);
				list.style = 'background:#000000;font-size:16px;';
				$("#list").show();
			}
		});
    }
    else
    {
        $("#list").html('');
		$("#list").hide();
    }
}   
</script>






