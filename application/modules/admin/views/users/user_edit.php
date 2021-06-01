<?php echo $form->messages();
    $university_school = $user_type = $username = $university_school_id = $university_school_email = $status  = '';

    if (isset($edit)) {
        $email = $edit['email'];
        $user_type = $edit['user_type'];
        $username = $edit['username'];
        $university_school_id = $edit['university_school_id'];
        // $university_school = $edit['university_school'];
        $university_school_email = $edit['university_school_email'];
        $status = $edit['status'];
    }
 ?>




<div class="row">

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <!-- <?php echo $form->open(); ?> -->

                    <div class="form-line">
                        <span>User Type</span>
                        <input type="text" name="user_type" value="Student" placeholder="User type" id="user_type" class="form-control " required disabled>
                    </div>

                    <div class="form-line">
                        <span>User Name</span>
                        <input type="text" name="username" value="<?php echo $username ?>" placeholder="Enter User Name" id="username" class="form-control " required>
                    </div>

                    <div class="form-line">
                        <span>University/School</span>
                        <select id="university_school_id" name="university_school_id" class="university_schoo" >
                            <option value="0">Select University/School</option>
                            <?php if (!empty($university_schools)) {

                            foreach ($university_schools as $ckey => $cvalue) {
                                $uni_schools = ($university_school_id == $cvalue['id'] ) ? "selected" : "";
                            ?>
                                <option value="<?php echo $cvalue['id']; ?>" <?php echo $uni_schools; ?>  ><?php echo $cvalue['name']; ?></option>
                            <?php } } ?>
                       </select>
                    </div>

                    <div class="form-line">
                        <span>University / School Email </span>
                        <input type="text" name="university_school" value="<?php echo $email ?>" placeholder="email address" id="university_school" class="form-control university_school" required>

                        <input type="text" name="university_school_email" value="<?php echo $domains ?>" placeholder="Email address" id="university_school_email" class="form-control university_school_email" required disabled="">
                    </div>



                    <div class="form-line">
                        <span>Status</span>
                        <select id="status" name="status" class="status" >
                          <option value="active" <?php if($status==='active') echo 'selected="selected"';?> >Active</option>
                          <option value="inactive" <?php if($status==='inactive') echo 'selected="selected"';?> >Deactive</option>
                       </select>

                    </div>

                    <div class="form-line">
                        <span>Password (<?php echo $edit['decoded_password']; ?>)</span>
                        <input autocomplete="off" type="password" name="password" value="<?php echo @$password ?>" placeholder="Enter Password" id="password" class="form-control " required>
                    </div>

                    <div class="form-line">
                        <span>Confirm Password</span>
                        <input type="password" name="confirm_password" value="<?php echo @$confirm_password ?>" placeholder="Enter Confirm Password" id="confirm_password" class="form-control " required>
                    </div>


                    

                    <div class="col-sm-12 submitt_edu">
                        <br>
                        <button type="submit" id="update_user" class="btn btn-primary update">Update</button>

                        <?php // echo $form->bs3_submit(); ?>
                        <!-- <?php echo $form->close(); ?> -->
                    </div>
                    
            </div>
        </div>
    </div>
    
</div>


<script type="text/javascript">
    $(document).on("click","#update_user",function()
    {
        var user_id                 = "<?php echo $edit['id'] ?>";

        var user_type               = $("#user_type").val();
        var username                = $("#username").val();
        var university_school_id    = $("#university_school_id").val();
        var university_school       = $("#university_school").val();
        var university_school_email = $("#university_school_email").val();
        var status                  = $("#status").val();
        var password                = $("#password").val();
        var confirm_password        = $("#confirm_password").val();
        var error=1;

        // alert(status);
        // alert(password);
        // alert(university_school_id);
        // return false;

        if(user_type == '')
        {
            swal("","Please enter user type",'warning');
            error=0;
            return false;
        }
        if(username == '')
        {
            swal("","Please enter username",'warning');
            error=0;
            return false;
        }
        if(university_school_id == '' || university_school_id == 0 )
        {
            swal("","Please select university / school ",'warning');
            error=0;
            return false;
        }
        if(university_school == '')
        {
            swal("","Please enter email address ",'warning');
            error=0;
            return false;
        }
        if(university_school_email == '')
        {
            swal("","Please select university / school ",'warning');
            error=0;
            return false;
        }
        if(status == '')
        {
            swal("","Please select status ",'warning');
            error=0;
            return false;
        }

        if (password != '') 
        {
            if(password == '')
            {
                swal("","Please select password ",'warning');
                error=0;
                return false;
            }
            if(confirm_password == '')
            {
                swal("","Please select confirm password ",'warning');
                error=0;
                return false;
            }
            if(confirm_password != password)
            {
                $("#password").val('');
                $("#confirm_password").val('');
                swal("","password does not match with confirm password ",'warning');
                error=0;
                return false;
            }

        }
        
        $('#loading').show();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>admin/users/user_edit/"+user_id,
            data: {user_type:user_type,username:username,university_school_id:university_school_id,university_school:university_school,university_school_email:university_school_email,status:status,password:password},
            // dataType: 'json',       
            success: function(response)
            { 
                response = response.trim();
                $('#loading').hide(); 
                if(response == 'success') 
                {
                    swal({title: "Good job", text: "Account updated successfully. ", type: "success"},
                       function(){ 
                           location.reload();
                       }
                    );
                }
                else if(response == 'email')
                {
                    $("#university_school").val('');
                    swal("","email id already available so kindly change .",'warning');
                }
                else if(response == 'username')
                {
                    $("#username").val('');
                    swal("","Username is already available so kindly change .",'warning');
                }
            }
        });

     
    });
</script>


<script type="text/javascript">
    $(document).on("change","#university_school_id",function(){
       var uni_id=$(this).val();   
       // alert(uni_id);
       // return false;

       if(uni_id!=0)
       {
         $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>admin/users/get_university_email",
            data: {uni_id:uni_id},
            success:function(response)
            {
                var html='';
                if(response=="not_found") 
                {
                    swal("","Something went wrong please try again.",'warning');
                }
                else 
                {
                    var response = $.parseJSON(response);
                    response = response.trim();
                    // alert(response);
                    var input = $("#university_school_email");
                    input.val(response);
                    $("#university_school_email").html(response);
                } 
            }
         });        
       }    
     });
</script>

<style type="text/css">


    .submitt_edu{
    padding-left: 0px;
    }

    .form-line {
    width: 50%;
    float: left;
    }


    .form-control:focus {
    box-shadow: none;
    }

    .form-line span{
    margin-top: 16px;
    display: block;
    margin-left: 11px;
    }
    .form-line span{
    margin-top: 16px;
    display: block;
    }
    .form-line input {
    border: none;
    box-shadow: none;
    border-bottom: 1px solid #cdcdcd;
    border-radius: 0;       width: 95%;
    }

    div#status_chosen,div#university_school_id_chosen {
    display: none;
    }
    select#status , #university_school_id {
    display: block!important;
    width: 95%;
    padding: 6px;
    border: 1px solid #cdcdcd;
    }
    input#university_school{
    width: 50%;
    float: left;
    }
    input#university_school_email {
    width: 45%;
    }

</style>

