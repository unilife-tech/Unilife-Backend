<?php echo $form->messages();
    $title = $categories_id = $title = $video_link =  $shared_by = $writer_image = $description = $status = $image = $categories_id = '';

    if (isset($edit)) 
    {
        $title = $edit['title'];
        $video_link = $edit['video_link'];
        $shared_by = $edit['shared_by'];
        $title = $edit['title'];
        $categories_id = $edit['categories_id'];
        $status = $edit['status'];
        $description = $edit['description'];
        $image = $edit['image'];
        $writer_image = $edit['writer_image'];

    }

 ?>

<a href="<?php echo base_url("admin/blog") ?>"><button type="button" class="btn back_button btn-md" >Back to listing </button></a>




<div class="row">

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>

                    <div class="col-sm-6">
                        <span>Title</span>
                        <input autocomplete="off" type="text" name="title" value="<?php echo $title ?>" placeholder="Enter title" id="title" class="form-control ">
                    </div>

                    <div class="col-sm-6">
                        <span>Link</span>
                        <input autocomplete="off" type="text" name="video_link" value="<?php echo $video_link ?>" placeholder="Enter link" id="video_link" class="form-control ">
                    </div>

                    <div class="col-sm-6">
                        <span>Writer Name</span>
                        <input autocomplete="off" type="text" name="shared_by" value="<?php echo $shared_by ?>" placeholder="Enter writer name" id="shared_by" class="form-control ">
                    </div>


                    <div class=col-sm-6>
                        <span>Categories Name</span>
                        <select id="categories_id" name="categories_id" class="university_schoo" >
                            <option value="0">Select category </option>
                            <?php if (!empty($category)) {

                            foreach ($category as $ckey => $cvalue) {
                                $sel_cat = ($categories_id == $cvalue['id'] ) ? "selected" : "";
                            ?>
                                <option value="<?php echo $cvalue['id']; ?>" <?php echo $sel_cat; ?>  ><?php echo $cvalue['categories_name']; ?></option>
                            <?php } } ?>
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

                    <div class="col-sm-12">
                       <label for="category">Description</label>
                       <textarea id="ckeditor10" name="description"  ><?php echo $description; ?></textarea>
                    </div> 


                    <div class="col-sm-6">
                        <span>Writer Image</span>
                        <input type="file" name="writer_image" class="writer_image">

                        <?php $upload_dir = "http://15.206.103.14/public/blog_imgs/"; ?>

                        <?php if (isset($edit)) { ?>
                            <img class="imag_pic" src="<?php echo $upload_dir.$writer_image?>">
                        <?php } ?>
                    </div>

                    <div class="col-sm-6">
                        <span>Image</span>
                        <input type="file" name="image" class="blog_image">

                        <?php $upload_dir = "http://15.206.103.14/public/blog_imgs/"; ?>

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
        height: 100px;
    width: 100px;
    }  
    input.writer_image, .blog_image{
    width: 100%;
    border: 1px solid #edbebe;
    padding: 5px;
    }

</style>

<script type="text/javascript">
    $(function () 
    {
        //CKEditor
        CKEDITOR.replace('ckeditor10');
        CKEDITOR.config.height = 300;
    });
</script>

<script type="text/javascript">
    $(document).on("submit","#blog_create",function()
    {
        var title          = $("#title").val();
        var video_link          = $("#video_link").val();
        var shared_by          = $("#shared_by").val();
        var categories_id          = $("#categories_id").val();
        var status          = $("#status").val();
        var description          = $("#ckeditor10").val();
        var writer_image          = $(".writer_image").val();
        var image          = $(".blog_image").val();
        var error=1;

        // alert("adsasd");
        // alert(image);
        // alert(brand_name);
        // alert(university_school_id);
        // return false;

        if(title == '')
        {
            swal("","Please enter title",'warning');
            error=0;
            return false;
        }
        if(video_link == '')
        {
            swal("","Please enter link",'warning');
            error=0;
            return false;
        }
        if(shared_by == '')
        {
            swal("","Please enter writer name",'warning');
            error=0;
            return false;
        }
        if(categories_id == 0)
        {
            swal("","Please select category",'warning');
            error=0;
            return false;
        }
        if(status == 0)
        {
            swal("","Please select status",'warning');
            error=0;
            return false;
        }
        if(description == '')
        {
            swal("","Please enter description ",'warning');
            error=0;
            return false;
        }
        if(writer_image == '')
        {
            swal("","Please select writer image ",'warning');
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