



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>Login</b></a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <p class="login-box-msg"> </p>



        
       <?php echo CHtml::beginForm('','POST', array("id" =>"login-form") );?> 

            <div  class="form-group has-feedback " id="div-error">
                <input type="text" class="form-control" id="Username" name= "Username" placeholder="Username" >
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <label id="dis"></label><br>
            </div>
            <div class="form-group has-feedback" id="Password-error">
                <input type="password" class="form-control" id="Password" name="Password" placeholder="Password" >
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <div> <?php echo ($model== "")?"<p style = 'color:red' class='error'> <b>Username or Password Invalid</b> </p>":'' ?> </div>
                <label id="dis2"></label><br>
            </div>
        
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" name="submit" value="submit" id="login-submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div><!-- /.col -->
            </div>
       <?php echo CHtml::endForm();?>
        <a href="#">I forgot my password</a><br>


    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
<script>


//   function validateForm() {
//    var x = document.forms["login-form"]["Username"].value;
//    if (x == null || x == "") {
//        alert("Username must be filled out");
//        return false;
//    }
//}

    $(document).ready(function () {
        $('#login-submit').click(function () {
            var username = $('#Username').val();
            var password = $('#Password').val();


            var error = false;
            $('.error').remove();
            if (username == "")
            {
                $('#dis').slideDown().html("<span style = 'color:red' class='error'>Username Is Required</span>");
                error = true;
            }
            if (password == "")
            {
                $('#dis2').slideDown().html("<span style = 'color:red' class='error'>Password Is Required</span>");
               error = true;
            }
            if(error){
                return false;
            }
        });
    });


</script>
