<?php echo $form->messages();
    $name = $dean_name = $no_of_students  = $domain =  $status = '';

    if (isset($edit)) 
    {
        $name = $edit['name'];
        $dean_name = $edit['dean_name'];
        $no_of_students = $edit['no_of_students'];
        $domain = $edit['domain'];
        $status = $edit['status'];
    }

 ?>

<a href="<?php echo base_url("admin/university") ?>"><button type="button" class="btn back_button btn-md" >Back to listing </button></a>




<div class="row">

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>

                    <div class="col-sm-6">
                        <span>University/School</span>
                        <input autocomplete="off" type="text" name="name" value="<?php echo $name ?>" placeholder="Enter University/School" id="name" class="form-control ">
                    </div>

                    

                    <div class="col-sm-6">
                        <span>Dean Name</span>
                        <input autocomplete="off" type="text" name="dean_name" value="<?php echo $dean_name ?>" placeholder="Enter dean name" id="dean_name" class="form-control ">
                    </div>

                    <div class="col-sm-6">
                        <span>Total Student</span>
                        <input autocomplete="off" type="text" name="no_of_students" value="<?php echo $no_of_students ?>" placeholder="Enter total student" id="no_of_students" class="form-control ">
                    </div>


                    <div class="col-sm-6">
                        <span>University Domain</span>
                        <input autocomplete="off" type="text" name="domain" value="<?php echo $domain ?>" placeholder=" @example.com " id="domain" class="form-control ">
                    </div>
                    

                    <div class="col-sm-6">
                        <span>Status</span>
                        <select id="status" name="status" class="status" >
                            <option value="0">Select Status</option>
                            <option value="active" <?php if($status==='active') echo 'selected="selected"';?> >Active</option>
                            <option value="inactive" <?php if($status==='inactive') echo 'selected="selected"';?> >Inactive</option>
                       </select>

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




<script type="text/javascript">
    $(document).on("submit","#university_create",function()
    {
        var name            = $("#name").val();
        var dean_name       = $("#dean_name").val();
        var no_of_students  = $("#no_of_students").val();
        var domain          = $("#domain").val();
        var status          = $("#status").val();
        var error=1;

        // alert("adsasd");
        // alert(image);
        // alert(brand_name);
        // alert(university_school_id);
        // return false;

        if(name == '')
        {
            swal("","Please enter university/school name",'warning');
            error=0;
            return false;
        }
        if(dean_name == '')
        {
            swal("","Please enter dean name",'warning');
            error=0;
            return false;
        }
        if(no_of_students == '')
        {
            swal("","Please enter number of students ",'warning');
            error=0;
            return false;
        }
        if(domain == '')
        {
            swal("","Please enter university domain ",'warning');
            error=0;
            return false;
        }  
        if(status == 0)
        {
            swal("","Please select status ",'warning');
            error=0;
            return false;
        }     
    });
</script>

<script type="text/javascript">
    $(document).on("submit","#edit_university",function()
    {
        var name            = $("#name").val();
        var dean_name       = $("#dean_name").val();
        var no_of_students  = $("#no_of_students").val();
        var domain          = $("#domain").val();
        var status          = $("#status").val();
        var error=1;

        // alert("adsasd");
        // alert(image);
        // alert(brand_name);
        // alert(university_school_id);
        // return false;

        if(name == '')
        {
            swal("","Please enter university/school name",'warning');
            error=0;
            return false;
        }
        if(dean_name == '')
        {
            swal("","Please enter dean name",'warning');
            error=0;
            return false;
        }
        if(no_of_students == '')
        {
            swal("","Please enter number of students ",'warning');
            error=0;
            return false;
        }
        if(domain == '')
        {
            swal("","Please enter university domain ",'warning');
            error=0;
            return false;
        }  
        if(status == 0)
        {
            swal("","Please select status ",'warning');
            error=0;
            return false;
        }     
    });
</script>
