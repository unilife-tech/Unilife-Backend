<div class="login_box_inner">


<div class="login-box login_box_back">
	
	<div class="login-logo img-circular" ><b style="font-size: 50px;    font-family: auto;    color: coral;"><img src="<?php echo base_url(); ?>assets/frontend/images/unilife-icon.png" alt="Login-header-logo" style="width: 50px;"></b> 
	 
	</div>

	<div class="login-box-body">
		<p class="login-box-msg">Sign in to start your session  </p>
		<?php //echo $form->open('name'); ?>
		<form action="<?php echo base_url('admin/login'); ?>" method="post" accept-charset="utf-8" id="admin_login">
			<?php echo $form->messages(); ?>
			<?php echo $form->bs3_text('Username', 'username', ENVIRONMENT==='development' ? '' : '', ['class' => 'text_user_form' , 'autocomplete' => 'foo' ]); ?>
			<?php echo $form->bs3_password('Password', 'password', ENVIRONMENT==='development' ? '' : '', ['class' => 'text_pass_form' ]); ?>
			<div class="row">
				<div class="col-xs-12 remembr_me_div">
					<div class="checkbox">
						<label><input type="checkbox" name="remember"> Remember Me</label>
					</div>
				</div>
				<div class="col-xs-12 btn_login_submt">
					<?php echo $form->bs3_submit('Sign In', 'btn btn-primary btn-block btn-flat login_class'); ?>
				</div>
			</div>
		<?php echo $form->close(); ?>		
	</div>

</div>



</div>

<style type="text/css">

	.login_box_back{
		float: left;
		}


	.login-box {
	    background-color: #fff;
	    width: 100%;
	    padding: 10px 13%;
	    box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.4), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
	    width: 70%;
	    padding-top: 60px;
	    text-align: left;
	    box-shadow: 6px 4px 16px #0000006e !important;
	}
	.login-logo{
		    text-align: center;
    width: 100%;
    box-sizing: border-box;
	}
	.login-box-msg{
		font-size: 17px;
		color: #fff;
    	text-align: center;
    	margin-bottom: 20px;
	}
	.img-circular{
		 width: 200px;
		 height: 200px;
		 /*background-color:black;*/
		 background-size: cover;
		 display: block;
		 border-radius: 100px;
		 -webkit-border-radius: 100px;
		 -moz-border-radius: 100px;
		}

	.img-circular {
	    width: 60px;
	    height: 60px;
	    /*background-color: black;*/
	    display: block;
	    border-radius: 100px;
	    -webkit-border-radius: 100px;
	    -moz-border-radius: 100px;
	    vertical-align: center;
	    margin-left: 30%;
	    margin-bottom: 5%;
	}

	.login_box_inner {
	     
	    /*width: 100%;*/
	    left: 0;
	    position: absolute;
	    top: 0;
	    padding: 10px 20%;
	    height: 100%;
	}
	.alert-danger {
	background-color: #fb483a !important;
	font-size: 18px;
	}

</style>
<script type="text/javascript">
	$(document).on('submit','#admin_login',function(){
		var username=$("#username").val();
		var password=$("#password").val();
		if(username=='')
		{
			swal("","Please enter username",'warning');
			return false;
		}
		if(password=='')
		{
			swal("","Please enter password",'warning');
			return false;
		}		
	});
</script>


