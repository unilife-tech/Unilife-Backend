<?php echo $form->messages();
    $group_name = $group_image = $status = $university_group_id =  $created_by =  '';

    if (isset($edit)) 
    {
        $group_name = $edit['group_name'];
        $created_by = $edit['created_by'];
        $university_group_id = $edit['university_group_id'];
        $group_image = $edit['group_image'];
        $status = $edit['status'];

    }

 ?>

<a href="<?php echo base_url("admin/groups") ?>"><button type="button" class="btn back_button btn-md" >Back to listing </button></a>




<div class="row">

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>

                    <div class="col-sm-6">
                        <span>Group Name</span>
                        <input autocomplete="off" type="text" name="group_name" value="<?php echo $group_name ?>" placeholder="Enter title" id="group_name" class="form-control ">
                    </div>

                    <div class=col-sm-6>
                        <span>University/School</span>
                        <select id="university_school_id" name="university_school_id" class="university_schoo" >
                            <option value="0">Select University/School </option>
                            <?php if (!empty($university_schools)) {

                            foreach ($university_schools as $ckey => $cvalue) {
                                $sel_cat = ($university_group_id == $cvalue['id'] ) ? "selected" : "";
                            ?>
                                <option value="<?php echo $cvalue['id']; ?>" <?php echo $sel_cat; ?>  ><?php echo $cvalue['name']; ?></option>
                            <?php } } ?>
                       </select>
                    </div>

                    <div class=col-sm-6>
                        <span>Select Group Admin</span>
                        <select id="group_admin_add" name="group_admin_add" class="university_schoo" >
                            <option value="0">Select Group Admin </option>
                            <?php if (!empty($university_schools)) {

                            foreach ($school_uni as $fkey => $fvalue) {
                                $sel_admin = ($created_by == $fvalue['id'] ) ? "selected" : "";
                            ?>
                                <option value="<?php echo $fvalue['id']; ?>" <?php echo $sel_admin; ?>  ><?php echo $fvalue['username']; ?></option>
                            <?php } } ?>
                       </select>
                    </div>

                    <div class=col-sm-6>
                        <span>Select Members( Select atleast 2 members )</span>
                        <select id="group_member" name="user_id[]" class="university_schoo" multiple >
                            <?php 
                            foreach ($school_uni as $itkey => $itvalue)
                            {
                                  echo '<option data-id="'.$itvalue['username'].'" value="'.$itvalue['id'].','.$itvalue['username'].'" '.(in_array($itvalue['id'], $admin_dtaa)? 'selected':'').' >'.$itvalue['username'].'</option>';
                            }
                             ?>
                       </select>
                    </div>


                    <div class="col-sm-6">
                        <span>Status</span>
                        <select id="status" name="status" class="status" >
                            <option value="0">Select Status</option>
                            <option value="active" <?php if($status==='active') echo 'selected="selected"';?> >Active</option>
                            <option value="deactive" <?php if($status==='deactive') echo 'selected="selected"';?> >Deactive</option>
                       </select>

                    </div>


                    <div class="col-sm-6">
                        <span>Group image</span>
                        <input type="file" name="group_image" class="group_image" value="">

                        <?php $upload_dir = "http://15.206.103.14/public/profile_imgs/"; ?>

                        <?php if (isset($edit)) { ?>
                            <img class="imag_pic" src="<?php echo $upload_dir.$group_image?>">
                        <?php } ?>
                    </div>


                    <div class="col-sm-12">
                        <br>
                        <?php echo $form->bs3_submit(); ?>
                        <?php echo $form->close(); ?>
                    </div>
                    
            </div>
        </div>
    </div>
    
</div>


<style type="text/css">
    img.imag_pic {
    margin-top: 10px;
        height: 100px;
    width: 100px;
    }  
    input.writer_image, .group_image{
    width: 100%;
    border: 1px solid #edbebe;
    padding: 5px;
    }

</style>


<script type="text/javascript">
    $(document).on("submit","#edit_groups",function()
    {
        var group_name        = $("#group_name").val();
        var university_group_id        = $("#university_school_id").val();
        var created_by          = $("#group_admin_add").val();
        var group_member        = $("#group_member").val();
        var status             = $("#status").val();
        // var group_image          = $(".group_image").val();
        var error=1;

        // alert(group_name);
        // alert(university_group_id);
        // alert(created_by);
        // alert(group_member);
        // alert(status);
        // return false;

        if(group_name == '')
        {
            swal("","Please enter group name",'warning');
            error=0;
            return false;
        }
        if(university_group_id =='0')
        {
            swal("","Please select university/school",'warning');
            error=0;
            return false;
        }
        if(created_by == '0')
        {
            swal("","Please select group admin",'warning');
            error=0;
            return false;
        }
        if(group_member == null || group_member == '0')
        {
            swal("","Please add members in group",'warning');
            error=0;
            return false;
        }

        if(group_member.length<2){
            swal("","Please add minimum 2 members in a group",'warning');
            error=0;
            return false;
        }

        if(status == 0)
        {
            swal("","Please select status",'warning');
            error=0;
            return false;
        } 
        // if(group_image == '')
        // {
        //     swal("","Please select image ",'warning');
        //     error=0;
        //     return false;
        // }     
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
            url: "<?php echo base_url(); ?>admin/groups/get_member",
            data: {uni_id:uni_id},
            success:function(response)
            {
                var html='';
                var html_select='';
                if(response=="not_found") 
                {
                    swal("","Something went wrong please try again.",'warning');
                }
                else 
                {
                    var response = $.parseJSON(response);
                    // alert("yes");
                    html+="<option value='0'>Select user</option>";
                    $.each(response, function( k, v ) {           
                    html+="<option   value='"+v.id+"'>"+v.username+"</option>";
                    }); 
                    $('#group_admin_add').prop('disabled', false).trigger("chosen:updated");
                    $("#group_admin_add").html(html);
                    $('#group_admin_add').trigger('chosen:updated'); 


                    // html_select+="<option value='0'></option>";              
                    $.each(response, function( k, w ) {           
                    html_select+="<option   value='"+w.id+"'>"+w.username+"</option>";          
                    }); 
                    $('#group_member').prop('disabled', false).trigger("chosen:updated");                                
                    $("#group_member").html(html_select);
                    $('#group_member').trigger('chosen:updated'); 

                } 
            }
         });        
       }    
     });
</script>

<style type="text/css">
    .chosen-container-multi .chosen-choices {
    padding: 6px;
    border-radius: 5px;
}

</style>



