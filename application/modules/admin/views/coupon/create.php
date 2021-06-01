<?php echo $form->messages();
    $brand_id = $categories_id = $status  = $image =  $type =  $discount_type = $slider = $description = $term_condition = $start_date = $exp_date = $discount_percent =  '';

    if (isset($edit)) {
        $categories_id = $edit['categories_id'];
        $brand_id = $edit['brand_id'];
        $type = $edit['type'];
        $discount_type = $edit['discount_type'];
        $status = $edit['status'];
        $slider = $edit['slider'];
        $image = $edit['image'];
        $description = $edit['description'];
        $term_condition = $edit['term_condition'];
        $start_date = $edit['start_date'];
        $exp_date = $edit['exp_date'];
        $discount_percent = $edit['discount_percent'];
        $image = $edit['image'];
        }

 ?>

<a href="<?php echo base_url("admin/coupon") ?>"><button type="button" class="btn back_button btn-md" >Back to listing </button></a>




<div class="row">

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>

                    <div class=col-sm-6>
                        <span>Categories Name</span>
                        <select id="categories_id" name="categories_id" class="" >
                            <option value="0">Select category </option>
                            <?php if (!empty($category)) {

                            foreach ($category as $ckey => $cvalue) {
                                $sel_cat = ($categories_id == $cvalue['id'] ) ? "selected" : "";
                            ?>
                                <option value="<?php echo $cvalue['id']; ?>" data-id="<?php echo $cvalue['id']; ?>" <?php echo $sel_cat; ?>  ><?php echo $cvalue['name']; ?></option>
                            <?php } } ?>
                       </select>
                    </div>

                    <div class=col-sm-6>
                        <span>Brand Name </span>
                        <select id="brand_id" name="brand_id" class="brand_namee" >
                            <option value="0">Select Brand </option>
                            <?php if (!empty($selected_brand)) {

                            foreach ($selected_brand as $dey => $bvalue) {
                                $sel_brand = ($brand_id == $bvalue['id'] ) ? "selected" : "";
                            ?>
                                <option value="<?php echo $bvalue['id']; ?>" <?php echo $sel_brand; ?>  ><?php echo $bvalue['brand_name']; ?></option>
                            <?php } } ?>
                       </select>
                    </div>


                    <div class="col-sm-6">
                        <span>Type</span>
                            <select id="type" name="type" class="type" >
                            <option value="0">Select Type</option>
                            <option value="online" <?php if($type==='online') echo 'selected="selected"';?> >Online</option>
                            <option value="instore" <?php if($type==='instore') echo 'selected="selected"';?> >Instore</option>
                            <option value="online_instore" <?php if($type==='online_instore') echo 'selected="selected"';?> >Both Online & Instore</option>
                            </select>

                    </div>

                    <div class="col-sm-6">
                        <span>Status</span>
                        <select id="status" name="status" class="status" >
                            <option value="0">Select Status</option>
                            <option value="active" <?php if($status==='active') echo 'selected="selected"';?> >Active</option>
                            <option value="inactive" <?php if($status==='inactive') echo 'selected="selected"';?> >Deactive</option>
                       </select>

                    </div>

                    <div class="col-sm-6">
                        <span>Discount type</span>
                        <select id="discount_type" name="discount_type" class="discount_type" >
                            <option value="0">Select discount type</option>
                            <option value="flat" <?php if($discount_type==='flat') echo 'selected="selected"';?> >Flat</option>
                            <option value="percentage" <?php if($discount_type==='percentage') echo 'selected="selected"';?> >Percentage</option>
                       </select>

                    </div>

                    <div class="col-sm-6">
                        <span>Slide Show</span>
                        <select id="slider" name="slider" class="slider" >
                            <option value="0">Select Slide Show</option>
                            <option value="no" <?php if($slider==='no') echo 'selected="selected"';?> >No</option>
                            <option value="yes" <?php if($slider==='yes') echo 'selected="selected"';?> >Yes</option>
                       </select>

                    </div>

                    <div class="col-sm-6">
                       <label for="category">Description</label>
                       <textarea id="description" name="description"  ><?php echo $description; ?></textarea>
                    </div> 

                    <div class="col-sm-6">
                       <label for="category">Term & Condition</label>
                       <textarea id="term_condition" name="term_condition"  ><?php echo $term_condition; ?></textarea>
                    </div> 

                    <div class="col-sm-6">
                        <span>Start date</span>
                        <input autocomplete="off" type="text" name="start_date" value="<?php echo $start_date ?>" placeholder="Start date" id="start_date" class="form-control ">
                    </div>

                     <div class="col-sm-6">
                        <span>Expiry Date</span>
                        <input autocomplete="off" type="text" name="exp_date" value="<?php echo $exp_date ?>" placeholder="Expiry Date" id="exp_date" class="form-control ">
                    </div>

                     <div class="col-sm-6">
                        <span>Discount Amount</span>
                        <input autocomplete="off" type="text" name="discount_percent" value="<?php echo $discount_percent ?>" placeholder="Discount Amount" id="discount_percent" class="form-control ">
                    </div>



                    <div class="col-sm-6">
                        <span>Image</span>
                        <input type="file" name="image" class="coupon_image">

                        <?php $upload_dir = "http://15.206.103.14/public/offer_imgs/"; ?>

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


<script type="text/javascript">
   $(document).on("change","#categories_id",function(){
       var cat_id = $(this).val();      
       // alert(cat_id);
       // return false;

       if(cat_id!=0){
         $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>admin/coupon/get_brands_using_category",
            data: {cat_id:cat_id},
            success:function(response)
            {
               var html='';
               if(response==0) {
                  swal("","Something went worng","warning");
               }
               else if(response=="not_found") 
               {
                  // alert("yes2");
                  $('#brand_id').prop('disabled', true).trigger("chosen:updated");
                  // $('#brand_id').prop('disabled', false).trigger("chosen:updated"); 
               }
               else 
               {
                  // $(".get_brands").css("display", "block");
                  var response = $.parseJSON(response);
                  // alert("yes");
                  html+="<option value='0'>Select brands</option>";
                  $.each(response, function( k, v ) {           
                  html+="<option   value='"+v.id+"'>"+v.brand_name+"</option>";
                  }); 
                  $('#brand_id').prop('disabled', false).trigger("chosen:updated");                                
                  $("#brand_id").html(html);
                  $('#brand_id').trigger('chosen:updated'); 
               } 
            }
         });        
       } else {
           $('#brand_id').prop('disabled', true).trigger("chosen:updated");
       }    
     });
</script>


<style type="text/css">
    img.imag_pic {
    margin-top: 10px;
    width: 30%;
    position: absolute;
    }  
    input.coupon_image {
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
        CKEDITOR.replace('term_condition');
        CKEDITOR.config.height = 300;
    });
</script>

<script type="text/javascript">
   jQuery('#start_date').bootstrapMaterialDatePicker({
    format: 'YYYY/MM/DD',
    clearButton: true,
    weekStart: 1,
    // minDate : new Date(),
    time: false
  });

      jQuery('#exp_date').bootstrapMaterialDatePicker({
    format: 'YYYY/MM/DD',
    clearButton: true,
    weekStart: 1,
    // minDate : new Date(),
    time: false
  });
</script>



<script type="text/javascript">
    $(document).on("submit","#offers_create",function()
    {
        var categories_id          = $("#categories_id").val();
        var brand_id                = $("#brand_id").val();
        var type                    = $("#type").val();

        var status                  = $("#status").val();
        var discount_type           = $("#discount_type").val();
        var slider                  = $("#slider").val();

        var description         = $("#description").val();
        var term_condition         = $("#term_condition").val();
        var start_date         = $("#start_date").val();
        var exp_date         = $("#exp_date").val();
        var discount_percent         = $("#discount_percent").val();
        var image               = $(".coupon_image").val();
        var error=1;

        // alert("adsasd");
        // alert(image);
        // alert(brand_name);
        // alert(university_school_id);
        // return false;

        if(categories_id == 0)
        {
            swal("","Please select ctategory",'warning');
            error=0;
            return false;
        }
        if(brand_id == 0)
        {
            swal("","Please select brand",'warning');
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
        if(discount_type == 0)
        {
            swal("","Please select discount type ",'warning');
            error=0;
            return false;
        }
        if(slider == 0)
        {
            swal("","Please select this image is used for slider or not ",'warning');
            error=0;
            return false;
        }
        if(description == '')
        {
            swal("","Please enter description ",'warning');
            error=0;
            return false;
        }
        if(term_condition == '')
        {
            swal("","Please enter term condition ",'warning');
            error=0;
            return false;
        }
        if(start_date == '')
        {
            swal("","Please select start date ",'warning');
            error=0;
            return false;
        }
        if(exp_date == '')
        {
            swal("","Please select exp date ",'warning');
            error=0;
            return false;
        }
        if(discount_percent == '')
        {
            swal("","Please discount amount ",'warning');
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
    $(document).on("submit","#edit_coupons",function()
    {
        var categories_id          = $("#categories_id").val();
        var brand_id                = $("#brand_id").val();
        var type                    = $("#type").val();

        var status                  = $("#status").val();
        var discount_type           = $("#discount_type").val();
        var slider                  = $("#slider").val();

        var description         = $("#description").val();
        var term_condition         = $("#term_condition").val();
        var start_date         = $("#start_date").val();
        var exp_date         = $("#exp_date").val();
        var discount_percent         = $("#discount_percent").val();
        // var image               = $(".coupon_image").val();
        var error=1;

        // alert("adsasd");
        // alert(image);
        // alert(brand_name);
        // alert(university_school_id);
        // return false;

        if(categories_id == 0)
        {
            swal("","Please select ctategory",'warning');
            error=0;
            return false;
        }
        if(brand_id == 0)
        {
            swal("","Please select brand",'warning');
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
        if(discount_type == 0)
        {
            swal("","Please select discount type ",'warning');
            error=0;
            return false;
        }
        if(slider == 0)
        {
            swal("","Please select this image is used for slider or not ",'warning');
            error=0;
            return false;
        }
        if(description == '')
        {
            swal("","Please enter description ",'warning');
            error=0;
            return false;
        }
        if(term_condition == '')
        {
            swal("","Please enter term condition ",'warning');
            error=0;
            return false;
        }
        if(start_date == '')
        {
            swal("","Please select start date ",'warning');
            error=0;
            return false;
        }
        if(exp_date == '')
        {
            swal("","Please select exp date ",'warning');
            error=0;
            return false;
        }
        if(discount_percent == '')
        {
            swal("","Please discount amount ",'warning');
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