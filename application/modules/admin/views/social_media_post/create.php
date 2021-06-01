<div class="col-md-12">
    <div class="button  ">
      <a href="<?php echo  base_url('/admin/social_media_post'); ?>" class=" back_to_list btn back_button">Back to list</a>
    </div>
</div>


<?php 

if (isset($edit)) 
{
    $post = $edit['post'];
    $category_id = $edit['category_id'];
    $active = $edit['status'] == 'active' ? 'checked' : '';
    $deactive = $edit['status'] == 'deactive' ? 'checked' : '';
}
else
{
    $deactive = '';
    $active = 'checked';
    $category_id = '';
}

?>


<div class="row">

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <!-- <h3 class="box-title">User Info</h3> -->
            </div>
            <div class="box-body">
                <?php echo $form->open(); ?>

                   
                    <div class="col-sm-12 col-md-6">
                        <label for="groups">Category select</label>
                        <div class="form-line">

                            <select class="form-control" id="category_id"  name="category_id" data-placeholder="Choose Category" >
                                <option />
                                <?php
                                foreach ($blog_categories as $key => $value) {
                                    $cat_id = $value['id'];
                                    $selected = ($category_id == $value['id']) ? "selected='selected'" : "";
                                    echo "<option value='$cat_id' ".$selected." >".$value['categories_name']."</option>";
                                }
                                 ?>
                            </select>
                            <!-- <input id="category_id" autocomplete="off" class="form-control" value="<?php echo @$edit['category_id']; ?>" name="category_id" type="text" > -->
                        </div>
                    </div>

                
                    <div class="col-sm-12 col-md-6">
                        <label for="groups">Type</label>
                        <div class="form-line">
                            <input autocomplete="off" class="form-control" value="Blog" disabled name="" type="text" >
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6" style="clear: both;">
                        <label for="groups">Add post</label>
                        <div class="form-line">
                            <textarea name="post" rows="10" id="post" class="posst"><?php echo @$edit['post']; ?></textarea>
                        </div>
                    </div>

                    
                    <div class="col-sm-12 col-md-12" >
                        <label for="groups">Status</label>
                        <div>
                            <?php echo $form->bs3_radio('Active', 'status', 'active', array('required' => ''), @$active); ?>
                            <?php echo $form->bs3_radio('Deactive', 'status', 'deactive', array('required' => ''), @$deactive); ?>
                        </div>
                    </div>


                    <div class="col-sm-12 ">
                        <?php echo $form->bs3_submit(); ?>
                    </div>
                    <?php echo $form->close(); ?>
            </div>
        </div>
    </div>
    
</div>






<style type="text/css"> 
    textarea#post{
        width: 100%;
    }
</style>



<script type="text/javascript">
    $(document).on("submit","#social_create",function()
    {
        var category_id = $("#category_id").val();
        var post    =$("#post").val();
        var status = $('input[name="status"]:checked').val();
      
        // alert(user_select);
        // alert(all_users);
       
        var error=1;    
        if(category_id == '')
        {
            swal("","Please select category",'warning');
            error=0;
            return false;
        }
        if(post == '')
        {
            swal("","Please enter Post",'warning');
            error=0;
            return false;
        }

        if(error==1)
        {
           $('#ajax_loading').show();
           $.ajax({
            type: 'POST',
            url: "<?php echo base_url('admin/social_media_post/create') ?>",
            data: {category_id:category_id,status:status,post:post},
            success: function(response){
               $('#ajax_loading').hide();

               var response = $.trim(response);


                switch (response) 
                {
                    /*case 'email':
                        $("#vendor_email").val('');
                        swal('',"email already exists ",'warning');
                        break;

                    case 'phone':
                        $("#vendor_phone").val('');
                        swal('',"phone already exists ",'warning');
                        break;*/

                    case 'success':
                        swal('',"Social media post successfully created.",'success');
                        $('#social_create')[0].reset();

                        // $(".user_hide").css("display", "block");
                        // setTimeout(function(){ },2900);
                        // setTimeout(function(){ window.location = "<?php //echo base_url('/') ?>" }, 1500);
                        
                        break;
                }
                
            }
            });
        }   
        return false;
});
</script>


<script type="text/javascript">
    $(document).on("submit","#social_edit",function()
    {
        var cate_id = '<?php echo @$edit['id']; ?>';

        var category_id = $("#category_id").val();
        var post    =$("#post").val();
        var status = $('input[name="status"]:checked').val();
      
        // alert(cate_id);
        // alert(all_users);
       
        var error=1;    
        if(category_id == '')
        {
            swal("","Please select category",'warning');
            error=0;
            return false;
        }
        if(post == '')
        {
            swal("","Please enter Post",'warning');
            error=0;
            return false;
        }

        if(error==1)
        {       
           $('#ajax_loading').show();
           $.ajax({
            type: 'POST',
            url: "<?php echo base_url('admin/social_media_post/edit/') ?>"+cate_id,
            data: {category_id:category_id,status:status,post:post},
            success: function(response)
            {
                var response = $.trim(response);
                $('#ajax_loading').hide();
                switch (response) {

                    /*case 'email':
                        $("#vendor_email").val('');
                        swal('',"email already exists ",'warning');
                        break;

                    case 'phone':
                        $("#vendor_phone").val('');
                        swal('',"phone already exists ",'warning');
                        break;*/

                    case 'success':
                        swal('',"Social media post successfully updated.",'success');
                        // $('#social_create')[0].reset();

                        // $(".user_hide").css("display", "block");
                        // setTimeout(function(){ },2900);
                        // setTimeout(function(){ window.location = "<?php //echo base_url('/') ?>" }, 1500);
                        
                        break;
                }
                
            }
            });
        }   
        return false;
});
</script>