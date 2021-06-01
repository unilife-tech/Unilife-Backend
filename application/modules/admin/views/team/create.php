<?php echo $form->messages();
    $name  = $status  = $image  =  $description = '';

    if (isset($edit)) {
        $name = $edit['name'];
        $description = $edit['description'];
        $status = $edit['status'];
        $image = $edit['image'];
        }

 ?>

<a href="<?php echo base_url("admin/content_management/team") ?>"><button type="button" class="btn back_button btn-md" >Back to listing </button></a>




<div class="row">

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>

                    <div class="col-sm-6">
                        <span>Name</span>
                        <input autocomplete="off" type="text" name="name" value="<?php echo $name ?>" placeholder="Enter name" id="name" class="form-control ">
                    </div>

                    <div class="col-sm-6">
                        <span>Status</span>
                        <select id="status" name="status" class="status" >
                            <option value="0">Select Status</option>
                            <option value="active" <?php if($status==='active') echo 'selected="selected"';?> >Active</option>
                            <option value="deactive" <?php if($status==='deactive') echo 'selected="selected"';?> >Deactive</option>
                       </select>

                    </div>

                    <div class="col-sm-12">
                       <label for="category">Description</label>
                       <textarea id="description" name="description"  ><?php echo $description; ?></textarea>
                    </div> 


                    <div class="col-sm-6">
                        <span>Image</span>
                        <input type="file" name="image" class="image">

                        <?php $upload_dir = "http://15.206.103.14/public/profile_imgs/"; ?>

                        <?php if (isset($edit)) { ?>
                            <img class="imag_pic" src="<?php echo $upload_dir.$image?>">
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
    width: 40%;
    }  
    input.image {
    width: 100%;
    border: 1px solid #edbebe;
    padding: 5px;
    }

</style>

<script type="text/javascript">
    $(function () 
    {
        //CKEditor
        CKEDITOR.replace('description');
        CKEDITOR.config.height = 300;
    });
</script>

<script type="text/javascript">
    $(document).on("submit","#team_create",function()
    {
        var name                = $("#name").val();
        var description         = $("#description").val();
        var status              = $("#status").val();
        var image               = $(".image").val();
        var error=1;

        // alert("adsasd");
        // alert(image);
        // alert(brand_name);
        // alert(university_school_id);
        // return false;

        if(name == '')
        {
            swal("","Please enter name",'warning');
            error=0;
            return false;
        }
        if(status == 0)
        {
            swal("","Please select status ",'warning');
            error=0;
            return false;
        }
        
        if(description == '')
        {
            swal("","Please enter description ",'warning');
            error=0;
            return false;
        }
        
        
        if(image == '')
        {
            swal("","Please select image ",'warning');
            error=0;
            return false;
        }     
    });
</script>


<script type="text/javascript">
    $(document).on("submit","#edit_brands",function()
    {
        var brand_name          = $("#brand_name").val();
        var categories_id       = $("#categories_id").val();
        var type                = $("#type").val();
        var status              = $("#status").val();
        var description         = $("#ckeditor10").val();
        // var image               = $(".brandd_image").val();
        var error=1;

        // alert("adsasd");
        // alert(image);
        // alert(brand_name);
        // alert(university_school_id);
        // return false;

        if(brand_name == '')
        {
            swal("","Please enter brand name",'warning');
            error=0;
            return false;
        }
        if(categories_id == 0)
        {
            swal("","Please select category",'warning');
            error=0;
            return false;
        }
        if(type == 0)
        {
            swal("","Please select type ",'warning');
            error=0;
            return false;
        }
        if(status == 0)
        {
            swal("","Please select status ",'warning');
            error=0;
            return false;
        }
        if(description == '')
        {
            swal("","Please enter description ",'warning');
            error=0;
            return false;
        }
        // if(image == '')
        // {
        //     swal("","Please select image ",'warning');
        //     error=0;
        //     return false;
        // }     
    });
</script>