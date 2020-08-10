<!--footer-->

<div class="dark">
    <div class="container animate-box fadeInUp animated-fast" id="fh5co-footer">
        <div class="row">
            <div class="col-sm-4">
                <div><a class="nsavbar-brand" href="#">Parampara</a></div>
                <br>
                <div class="text-white">Get amazing results working with the best programmers, designers, writers and
                    other top online pros. You can hire us with confidence. Get amazing results working with the best
                    programmers
                </div>
            </div>
            <div class="col-sm-4">
                <div class="icons">Explore Our Pages</div>
                <br>
                <table width="100%">
                    <tbody><tr>
                        <td><a class="text-white" href="index.php">Home</a></td>
                        <td><a class="text-white" href="pandit-booking.php">Pandit Booking</a></td>
                    </tr>
                    <tr>
                        <td><a class="text-white" href="#">About us</a></td>
                        <td><a class="text-white" href="bhajan_mandal.php">Bhajan Mandal</a></td>
                    </tr>
                    <tr>
                        <td><a class="text-white" href="#fh5co-pricing">Faq</a></td>
                        <td><a class="text-white" href="bhavya_ayojan.php">Bhavya Ayojan</a></td>
                    </tr>
                    <tr>
                        <td><a class="text-white" href="estore.php">Shop</a></td>
                        <td><a class="text-white" href="virtual_services.php">Virtual Services</a></td>
                    </tr>
                    <tr>
                        <td><a class="text-white" href="temple_donation.php">Donation</a></td>
                        <td><a class="text-white" href="contact.php">Contact</a></td>
                    </tr>
					<tr>
                        <td><a class="text-white" href="#">Private Policy</a></td>
                        <td><a class="text-white" href="#">Term &amp; Condition</a></td>
                    </tr>
                </tbody></table>
            </div>
            <div class="col-sm-4">
                <div class="icons">Get in Touch</div>
                <br>
                <div>
                    <i class="fa fa-facebook-square" aria-hidden="true"></i>
                    <i class="fa fa-twitter-square" aria-hidden="true"></i>
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                    <i class="fa fa-google-plus-square" aria-hidden="true"></i>
                    <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="darker">
    <div class="container" id="fh5co-legal">
        <div class="row">
            <div class="col-sm-8 text-white mtext-center">
             © 2020 copyright  <a class="text-gr" href="#"><span class="navbar-brand2">  All Rights Reserved</span></a>
            </div>
            <div class="col-sm-4 text-white mtext-center">
                <table>
                    <tr>   
                Design by <a href="http://deificindia.com/" target="_blank">Deific India Infosolution Pvt Ltd, </a>.

                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>


<script src="./js/jquery.min.js"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>-->
<script src="./js/bootstrap.min.js"></script>
<!--<script src="https://use.fontawesome.com/8e45396e2e.js"></script>-->
<script src="./js/fontawesome.js"></script>
<script src="./js/jquery.waypoints.min.js"></script>
<script src="./js/animate.js"></script>
 <script>
    $("#myModel").on('show.bs.model',function(e){
        var sign ='cancer';
        $.ajax({
            url:'http://sandipbgt.com/theastrologer/api/horoscope/'+sign+'/today/',
            type:'get',
            success:function(res){
                var response=$.parseJSON(res);
                $(".model-title").html(response.sunsign);
                body='<p>' +response.date+'</p>';
                 body +='<p>' +response.horoscope+'</p>';
                 $(".model-body").html(body);
            }
        });
    });
</script>
<script type="text/javascript">
    
$(document).ready(function() {
    $('#contact_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            first_name: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Please enter your First Name'
                    }
                }
            },
             last_name: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please enter your Last Name'
                    }
                }
            },
             user_name: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Please enter your Username'
                    }
                }
            },
             user_password: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Please enter your Password'
                    }
                }
            },
            confirm_password: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Please confirm your Password'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your Email Address'
                    },
                    emailAddress: {
                        message: 'Please enter a valid Email Address'
                    }
                }
            },
            contact_no: {
                validators: {
                  stringLength: {
                        min: 12, 
                        max: 12,
                    notEmpty: {
                        message: 'Please enter your Contact No.'
                     }
                }
            },
             department: {
                validators: {
                    notEmpty: {
                        message: 'Please select your Department/Office'
                    }
                }
            },
                }
            }
        })
        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                $('#contact_form').data('bootstrapValidator').resetForm();

            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
            }, 'json');
        });
});
    
</script>

</body>
</html>
