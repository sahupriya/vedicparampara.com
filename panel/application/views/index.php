<?php
date_default_timezone_set('asia/kolkata');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META SECTION -->
        <title>:: PARAMPARA-ADMIN ::</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="<?php echo base_url(); ?>img/company/logo.png" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url(); ?>css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->
        
        <style>
        .bgim {
            /* The image used */
            background-image: url("<?=base_url()?>/img/backgrounds/wall_4.jpg");
        
            /* Full height */
            height: 100%; 
        
            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            z-index: 9;
            position: fixed;
            bottom:0;
            
        }
        .login-container .login-box {
            width: 400px;
            margin: 0px auto;
            padding-top: 125px;
            margin-left: 65%;
        }
        .login-container .login-box .login-body {
            width: 100%;
            float: left;
            background: rgba(255, 255, 255, 0.3);
            padding: 20px; 
        }
        ::placeholder{
            color: #ddd !important;
        }
        input{
            color:#fff !important;
            font-weight: 700;
        }
        </style>
    </head>
    <body>
        
        <div class="login-container bgim">
        
            <div class="login-box animated fadeInDown" style="min-height: 700px;">

                <div class="text-center">
                    <img src="<?=base_url()?>/img/company/logo.png" style="height:115px;width:auto;margin:20px;">
                </div>
                
                 <!-- <div style="font-size: 26px;color: #ffffff;font-family:impact;"><center>SERVICE</center></div><center><h3><b><small><b style="color:black;"></b></small></b></h3></center> -->
                <div class="login-body">
                    <div class="login-title"><strong>Log In</strong> to your account</div>
                    <form action="<?php echo site_url('site/login_submit'); ?>" class="form-horizontal" method="post"> 
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Email/Mobile/Username" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" class="form-control"  id="password" name="password" placeholder="Password" required/>
                        </div>
                    </div>
                    <h4 style="color: red;text-align: center;"><?php echo $this->session->flashdata('err_login'); ?></h4>
                    <div class="form-group">
                        <div class="col-md-6">
                            <!-- <a href="#" class="btn btn-link btn-block">Forgot your password?</a> -->
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-warning btn-block">Log In</button>
                        </div>
                    </div>
                    <div class="form-group">
                    </div>
                    </form>
                </div>
                <div class="login-footer">
                </div>
            </div>
            
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body> 
</html>




