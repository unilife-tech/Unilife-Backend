<?php echo $form1->messages(); ?>

<div class="row">

	<div class="col-md-4">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title">Account Info</h4>
			</div>
			<div class="box-body">
				<?php echo $form1->open(); ?>
					<?php echo $form1->bs3_text('First Name', 'first_name', $user->first_name); ?>
					<?php echo $form1->bs3_text('Last Name', 'last_name', $user->last_name); ?>
					<?php echo $form1->bs3_submit('Update'); ?>
				<?php echo $form1->close(); ?>
			</div>
		</div>
	</div>

	<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header">
					<h4 class="box-title">Change Password</h4>
				</div>
				<div class="box-body">
					<!-- <?php echo $form2->open(); ?> -->
						<?php echo $form2->bs3_password('New Password', 'new_password', '', array('minlength' => '6', 'required' => '', 'autocomplete' => 'off')); ?>
						<?php echo $form2->bs3_password('Retype Password', 'retype_password', '', array('minlength' => '6', 'required' => '' , 'autocomplete' => 'off')); ?>
						<!-- <?php echo $form2->bs3_submit(); ?> -->
					<button type="submit" style="margin-top: 10px" class="change_passss btn btn-primary">Update</button>
					<!-- <?php echo $form2->close(); ?> -->
				</div>
			</div>
		</div>
	
	<div class="col-md-4">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title">Upload Profile</h4>
			</div>
			<form id="add_profile" method="post" enctype="multipart/form-data">
			<div class="box-body">
				<div class="form-group form-float form-group-lg">
					<div class="form-line">
						<input type="file" name="logo" value=""  required="" autocomplete="off" class="form-control image_check" >
					</div>
				</div>
				<img id="blah" class="blah" width="200px" height="200px" src="<?php echo base_url('assets/admin/usersdata/').@$admin_users[0]['logo']; ?>" alt="your image" />
				<div class="clear"></div>
				<button type="submit" style="margin-top: 10px" class="btn btn-primary">Upload Profile</button>
			</div>
			</form>
		</div>
	</div>				
</div>



<script type="text/javascript">
	$(".image_check").change(function() {

        var file = this.files[0];

        var imagefile = file.type;

        var match= ["image/jpeg","image/png","image/jpg"];

        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
            // swal("",'Please select a valid image file (JPEG/JPG/PNG).');
            alert("Please select a valid image file (JPEG/JPG/PNG)");
            $(".image_check").val('');
            return false;
        } else {
          readURL(this);
        }
    });

   function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

         reader.onload = function(e) {     

          $('.blah').attr('src', e.target.result);     

         }
         reader.readAsDataURL(input.files[0]);
      }
   }
</script>


<script type="text/javascript">
  $(document).on('click',".change_passss",function(){
    var new_password 	= $("#new_password").val();
    var retype_password = $("#retype_password").val();
    
    if(new_password == '')
    {
    	swal("","Please enter new password !!","warning");
    	return false;
    }
    if(retype_password == '')
    {
    	swal("","Please enter confirm new password","warning");
    	return false;
    }
    if(new_password != retype_password)
    {
    	$("#new_password").val('');
    	$("#retype_password").val('');

    	swal("","New password and confirm password does not match","warning");
    	return false;
    }
    // alert(new_password);
    // return false;

    if(new_password != '')
    {
    	
      swal({
            title: "",
            text: "Are you sure you want to change password !!",
            type:"warning",                                  
            showCancelButton: true,                  
            confirmButtonText: "OK",
            cancelButtonText: "CANCEL",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(inputValue){
          $('#loading').show();       
            if (inputValue===true) {                    
              $.ajax({
              type: 'POST',
              url: '<?php echo base_url('admin/panel/account_change_password') ?>',
              data: {new_password:new_password,retype_password:retype_password},
              success: function(response){       
              // alert(response); 
              $('#loading').hide();                      
               if(response == 'success')
               {
               		$("#new_password").val('');
			    	$("#retype_password").val('');

               		setTimeout(function() {
               		swal({
				            title: "Wow!",
				            text: "Password changed successfully! ",
				            type: "success"
				        }, function() 
				        {
				            window.location = "<?php echo base_url('admin/panel/logout'); ?>";
				        });
				    }, 1000);

               	

	                // swal("",".",'success');
	                // setTimeout(function(){  }, 2000);
               }
               else 
               {
	                swal("","Some thing went worng!!","warning");
               }
              }
        });            
            } 
      });
    } else {
      swal("","Some thing want worng!!","warning");
    }
     
  });    
</script>


<script type="text/javascript">
	$(document).on("submit","#add_profile",function(e) {
    	e.preventDefault();   
    	$.ajax({
                type: 'POST',
                url: "<?php echo base_url('admin/panel/upload_logo'); ?>",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(response)
                {  
                	if(response==1)
                	{
                		swal("","Profile uplaod successfully",'success');
                		setTimeout(function(){ location.reload(); }, 1500);
                	 }else if(response==2){
                		swal("","something went wrong",'warning');
                	}else{
                		swal("","Please login",'warning');
                		setTimeout(function(){ window.location = "<?php echo base_url('admin/login'); ?>" }, 1500);
                	}
                }
            });    
    });	
</script>