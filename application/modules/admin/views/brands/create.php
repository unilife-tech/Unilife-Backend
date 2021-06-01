<?php echo $form->messages();
    $brand_name = $categories_id = $status  = $image =  $type =  $brand_description = $facebook = $instagram = $twitter = '';

    if (isset($edit)) {
        $brand_name = $edit['brand_name'];
        $categories_id = $edit['categories_id'];
        $type = $edit['type'];
        $brand_description = $edit['description'];
        $status = $edit['status'];
        $image = $edit['image'];
        $facebook = $edit['facebook'];
        $instagram = $edit['instagram'];
        $twitter = $edit['twitter'];
        }

 ?>

<a href="<?php echo base_url("admin/brands") ?>"><button type="button" class="btn back_button btn-md" >Back to listing </button></a>


<style type="text/css">
    select.use_type {
    width: 100%;
    padding: 7px;
    border-radius: 5px;
    border-color: #cdcdcd;
    }

    img.imag_pic {
    margin-top: 10px;
    width: 40%;
    }  
    input.brandd_image {
    width: 100%;
    border: 1px solid #edbebe;
    padding: 5px;
    }

    .invalid{
    box-shadow: 0 0 0 2px #74aa27;
    }
    .remove_invalid{
    box-shadow: 0 0 0 2px #ffffff;
    }
    .invalid_select{
    box-shadow: 0 0 0 2px #74aa27;
    border-radius: 6px;
    }

    .input.submit_update {
    margin-left: 15px;
    }
    .offer_label
    {
    font-weight: bold;
    font-size: 23px;
    font-family: initial;
    }
    span.remove_btn_in_store , span.remove_btn{
    margin-left: 18px;
    border-radius: 5px;
    color: white;
    cursor: pointer;
    margin-bottom: 14px;
    clear: both;
    display: block;
    width: 95%;
    }
    form#add_developer {
    clear: both;
    }
</style>

<script type="text/javascript">
  validation_array  = ['heading','discount_message','description','terms_condition','online_redeem_link'];
  in_store_array    = ['instore_head','instore_discount_code','instore_discount_message','instore_desc','instore_terms_condition'];
</script>






<section class="no-padding lets_cht_wrp1">
  
    
    <!-- <div class="right_cont_form"> -->
      <!-- <div class="col-sm-12">         -->

        <form class="cd-form maid_reg" id="add_developer" action="<?php echo base_url('/');?>admin/driver/create" method="post" enctype="multipart/form-data">

            <div class="col-sm-3">
                <span>Brand Name</span>
                <input autocomplete="off" type="text" name="brand_name" value="<?php echo $brand_name ?>" placeholder="Enter Brand Name" id="brand_name" class="form-control ">
            </div>

            <div class="col-sm-3">
                <span>Status</span>
                <select id="status" name="status" class="status" >
                    <option value="0">Select Status</option>
                    <option value="active" <?php if($status==='active') echo 'selected="selected"';?> >Active</option>
                    <option value="deactive" <?php if($status==='deactive') echo 'selected="selected"';?> >Deactive</option>
               </select>

            </div>

            <div class=col-sm-3>
                <span>Categories Name</span>
                <select id="categories_id" name="categories_id" class="university_schoo" >
                    <option value="0">Select category </option>
                    <?php if (!empty($category)) {

                    foreach ($category as $ckey => $cvalue) {
                        $sel_cat = ($categories_id == $cvalue['id'] ) ? "selected" : "";
                    ?>
                        <option value="<?php echo $cvalue['id']; ?>" <?php echo $sel_cat; ?>  ><?php echo $cvalue['name']; ?></option>
                    <?php } } ?>
               </select>
            </div>

            <div class="col-sm-3">
                <span>Type</span>
                    <select id="type" name="type" class="type" >
                    <option value="0">Select Type</option>
                    <option value="online" <?php if($type==='online') echo 'selected="selected"';?> >Online</option>
                    <option value="instore" <?php if($type==='instore') echo 'selected="selected"';?> >Instore</option>
                    <option value="online_instore" <?php if($type==='online_instore') echo 'selected="selected"';?> >Both Online & Instore</option>
                    </select>

            </div>

            

            <div class="col-sm-3">
                <span>facebook Link</span>
                <input autocomplete="off" type="text" name="facebook" value="<?php echo $facebook ?>" placeholder="Enter Brand Name" id="facebook" class="form-control ">
            </div>

            <div class="col-sm-3">
                <span>Instagram Link</span>
                <input autocomplete="off" type="text" name="instagram" value="<?php echo $instagram ?>" placeholder="Enter Brand Name" id="instagram" class="form-control ">
            </div>

            <div class="col-sm-3">
                <span>Twitter Link</span>
                <input autocomplete="off" type="text" name="twitter" value="<?php echo $twitter ?>" placeholder="Enter Brand Name" id="twitter" class="form-control ">
            </div>


            <div class="col-sm-12">
               <label for="category">Brand description</label>
               <textarea id="ck_editor_desc" name="brand_description"  ><?php echo $brand_description; ?></textarea>
            </div> 


            <div class="col-sm-6">
                <span>Image</span>
                <input type="file" name="image" class="brandd_image">

                <?php $upload_dir = "http://15.206.103.14/public/admin/brand/"; ?>

                <?php if (isset($edit)) { ?>
                    <img class="imag_pic" src="<?php echo $upload_dir.$image?>">
                <?php } ?>
            </div>

            <div class="col-sm-12" style="padding: 0px;">
                
                <div class="col-md-6">.

                    <div class="online offer_label" for="sub_category">Add Online Offers:</div>
                    <hr>
                    <!-- <div class="row">

                      <div class="col-md-12">
                        <div class="compny_name_labl" for="sub_category">Heading:</div>
                        <input type="text" name="heading[]" id="heading"  placeholder="Like Standard / Family & friends "  class="form-control  remvoe_box" autocomplete="off" >                
                      </div>

                      <div class="col-md-12">
                        <div class="compny_name_labl" for="discount_message">Discount message:</div>
                        <input type="text" name="discount_message[]" id="discount_message"  placeholder="Discount message"  class="form-control  remvoe_box" autocomplete="off" >                
                      </div>
                      
                      <div class="col-md-6">
                        <div class="compny_name_labl" for="description">Description:</div>
                       <textarea rows="2" cols="50" name="description[]"  class="form-control space remvoe_box" id="description"></textarea>       
                      </div> 

                      <div class="col-md-6">
                        <div class="compny_name_labl" for="terms_condition">Terms condition:</div>
                       <textarea rows="2" cols="50" name="terms_condition[]"  class="form-control space remvoe_box" id="terms_condition"></textarea>       
                      </div> 
                    </div> -->
                    
                    <div class="row" id="append_custom">   
                    </div>

                    <div class="row">
                      <div class="input submit_update">
                        <div class="compny_name_labl" for="category">&nbsp;
                        </div>
                        <div class="input" >
                            <button type="button" id="add_more" class="btn btn-primary">Add More Online Offers</button>
                            <!-- <button type="submit" class="btn btn-primary">Add Service</button> -->
                            <div class="clear"></div>
                        </div>
                      </div> 
                    </div>          
                </div>

                <div class="col-md-6">.

                    <div class="online offer_label" for="sub_category">Add Instore Offers:</div>
                    <hr>
                    <div class="row">
                      <!-- <div class="col-md-6">
                        <div class="compny_name_labl">instore heading :</div>
                        <input type="text" name="instore_head[]" id="instore_head"  placeholder="Like Standard / Family & friends "  class="form-control  remvoe_box" autocomplete="off" >                
                      </div>

                      <div class="col-md-6">
                        <div class="compny_name_labl">Instore discount message:</div>
                        <input type="text" name="instore_discount_message[]" id="instore_discount_message"  placeholder="Instore discount message"  class="form-control  remvoe_box" autocomplete="off" >                
                      </div>

                      <div class="col-md-12">
                        <div class="compny_name_labl">Instore discount code:</div>
                        <input type="text" name="instore_discount_code[]" id="instore_discount_code"  placeholder="Instore discount code"  class="form-control  remvoe_box" autocomplete="off" >                
                      </div>
                      
                      <div class="col-md-6">
                        <div class="compny_name_labl">Instore Description:</div>
                       <textarea rows="2" cols="50" name="instore_desc[]"  class="form-control space remvoe_box" id="instore_desc"></textarea>       
                      </div> 

                      <div class="col-md-6">
                        <div class="compny_name_labl" >Terms condition:</div>
                        <textarea rows="2" cols="50" name="instore_terms_condition[]"  class="form-control space remvoe_box" id="instore_terms_condition"></textarea>       
                      </div>  -->
                    </div>
                    
                    <div class="row" id="append_html_in_store">

                    </div>

                    <div class="row">
                      <div class="input submit_update">
                        <div class="compny_name_labl" for="category">&nbsp;
                        </div>
                        <div class="input" >
                            <button type="button" id="add_more_in_store" class="btn btn-primary">Add More Online Offers</button>
                            
                        </div>
                      </div> 
                    </div>          
                </div>

            </div>

            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Add Service</button>
                <div class="clear"></div>
            </div>

        </form>
      <!-- </div> -->
    
    <div class="clear"></div>
  <!-- </div> -->
</section>



<script type="text/javascript"> 
    $(function () {CKEDITOR.replace('ck_editor_desc');CKEDITOR.config.height = 200;});
    // $(function () {CKEDITOR.replace('description');CKEDITOR.config.height = 200;});
    // $(function () {CKEDITOR.replace('terms_condition');CKEDITOR.config.height = 200;});
    // $(function () {CKEDITOR.replace('instore_desc');CKEDITOR.config.height = 200;});
    // $(function () {CKEDITOR.replace('instore_terms_condition');CKEDITOR.config.height = 200;});
</script> 


<script type="text/javascript">

  $(document).on("submit","#add_developer",function(e)
  {
    e.preventDefault();  
    var error=1;    

    var brand_name          = $("#brand_name").val();
    var categories_id       = $("#categories_id").val();
    var type                = $("#type").val();

    var facebook                = $("#facebook").val();
    var instagram                = $("#instagram").val();
    var twitter                = $("#twitter").val();

    var status              = $("#status").val();
    var brand_description   = $("#ck_editor_desc").val();
    var image               = $(".brandd_image").val();


    var heading             = $("#heading").val();        
    var discount_message    = $("#discount_message").val();        
    var description         = $("#description").val();        
    var terms_condition     = $("#terms_condition").val();        
    // var image=$("#image").val();    
    // var status=$('[name="active"]').val();  
    // alert(image);
    // console.log(validation_array);
    // console.log(in_store_array);
    $(".remvoe_box").addClass("remove_invalid");

    if(brand_name == '')
    {
        swal("","Please enter brand name",'warning');
        error=0;
        return false;
    }
    if(categories_id == 0)
    {
        $("#categories_id").addClass("invalid");
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

    if(facebook == '')
    {
        swal("","Please enter facebook link ",'warning');
        error=0;
        return false;
    }
    if(instagram == '')
    {
        swal("","Please enter instagram link ",'warning');
        error=0;
        return false;
    }
    if(twitter == '')
    {
        swal("","Please enter twitter link ",'warning');
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
        $("#brandd_image").addClass("invalid");
        swal("","Please select image ",'warning');
        error=0;
        return false;
    } 

    if(validation_array.length!=0)
    {
      for(i=0; i<validation_array.length; i++)
      {          
        // delete cart_object[location_id[i]];
        $(".cke_reset ").removeClass("invalid");
        console.log(validation_array[i]);
        check_val = $("#"+validation_array[i]).val(); 

        // alert(check_val);

        if(check_val=='')
        {
          var res   = validation_array[i].substring(0, 7);
          var res2  = validation_array[i].substring(0, 18);
          var res3  = validation_array[i].substring(0, 11);
          var res4  = validation_array[i].substring(0, 20);
          var res5  = validation_array[i].substring(0, 30);

          // alert(res);
          // alert(res2);
          // alert(res3);
          // alert(res4);

          $("#"+validation_array[i]).removeClass("remove_invalid");
          
          if(res=='heading')
          {              
            $("#"+validation_array[i]).addClass("invalid");
            swal("","Please enter "+validation_array[i],'warning');
          }
          else if(res2 == 'discount_message')
          {
            $("#"+validation_array[i]).addClass("invalid");
            // swal("","Please enter "+validation_array[i],'warning');
            swal("","Please enter discount message",'warning');
          }
          else if(res3 == 'description')
          {
            $("#cke_"+validation_array[i]).addClass("invalid");
            swal("","Please enter "+validation_array[i],'warning');
          }
          else if(res4 == 'terms_condition')
          {
            $("#cke_"+validation_array[i]).addClass("invalid");
            // swal("","Please enter   "+validation_array[i],'warning');
            swal("","Please enter terms & condition ",'warning');
          }
          else if(res4 == 'online_redeem_link')
          {
            $("#cke_"+validation_array[i]).addClass("invalid");
            // swal("","Please enter   "+validation_array[i],'warning');
            swal("","Please enter terms & condition ",'warning');
          }
          else
          {
            // alert("asd");
            $("#"+validation_array[i]).addClass("invalid");
            swal("","Please enter "+validation_array[i],'warning');
          }
          error=0;
          return false;
        }
      }
    }

    if(in_store_array.length!=0)
    {
      for(i=0; i<in_store_array.length; i++)
      {          
        // delete cart_object[location_id[i]];
        $(".cke_reset ").removeClass("invalid");
            console.log(in_store_array[i]);
            check_val = $("#"+in_store_array[i]).val(); 
        if(check_val=='')
        {
          var res   = in_store_array[i].substring(0, 25);
          var res2  = in_store_array[i].substring(0, 25);
          var res3  = in_store_array[i].substring(0, 25);
          var res4  = in_store_array[i].substring(0, 25);
          var res5  = in_store_array[i].substring(0, 25);

          // alert(res);
          // alert(res2);
          // alert(res3);
          // alert(res4);

          $("#"+in_store_array[i]).removeClass("remove_invalid");
          
          if(res=='instore_head')
          {              
            $("#"+in_store_array[i]).addClass("invalid");
            swal("","Please enter "+in_store_array[i],'warning');
          }
          else if(res2 == 'instore_discount_code')
          {
            $("#"+in_store_array[i]).addClass("invalid");
            // swal("","Please enter "+in_store_array[i],'warning');
            swal("","Please enter discount code",'warning');
          }
          else if(res2 == 'instore_discount_message')
          {
            $("#"+in_store_array[i]).addClass("invalid");
            // swal("","Please enter "+in_store_array[i],'warning');
            swal("","Please enter discount message",'warning');
          }
          else if(res3 == 'instore_desc')
          {
            $("#cke_"+in_store_array[i]).addClass("invalid");
            swal("","Please enter "+in_store_array[i],'warning');
          }
          else if(res4 == 'instore_terms_condition')
          {
            $("#cke_"+in_store_array[i]).addClass("invalid");
            // swal("","Please enter   "+in_store_array[i],'warning');
            swal("","Please enter terms & condition ",'warning');
          }
          else
          {
            $("#"+in_store_array[i]).addClass("invalid");
            swal("","Please enter "+in_store_array[i],'warning');
          }
          error=0;
          return false;
        }
      }
    }

    $('#loading').show();

    if(error==1)
    {  
     $.ajax({
                type: 'POST',
                url: "<?php echo base_url('admin/brands/create'); ?>",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(response)
                {
                  $('#loading').hide();    
                    if(response == 1)
                    {
                        swal("","Brand added successfully","success");
                        setTimeout(function(){ location.reload(); }, 1000);
                    }
                    else if(response==0) 
                    {
                        swal("","Something went wrong",'warning');
                    }
                    else if(response=='already') 
                    {
                        swal("","You already added data for same sub category",'warning');
                    }
                    else{
                        swal("","Something went wrong",'warning');
                    }
                }
            }); 
    }   
  });
</script>




 
<script type="text/javascript">
  var count=2;
  $(document).on("click","#add_more",function(){
    // alert('sdf');
    validation_array.push('heading'+count);
    validation_array.push('discount_message'+count);
    // validation_array.push('image'+count);
    validation_array.push('description'+count);
    validation_array.push('terms_condition'+count);
    validation_array.push('online_redeem_link'+count);
    // validation_array.push('online_facebook'+count);
    // validation_array.push('online_twitter'+count);
    // validation_array.push('Instagram'+count);
    append='';
    append+='<div class="col-md-12 remove'+count+'"><div class="compny_name_labl" for="sub_category">Heading '+count+':</div><input type="text" name="heading[]"   placeholder="Like Standard / Family & friends" id="heading'+count+'"  class="form-control  remvoe_box" autocomplete="off" ></div>';

    append+='<div class="col-md-6 remove'+count+'"><div class="compny_name_labl" for="sub_category">Discount message '+count+':</div><input type="text" name="discount_message[]"   placeholder="Discount message" id="discount_message'+count+'"  class="form-control  remvoe_box" autocomplete="off" ></div>';

     append+='<div class="col-md-6 remove'+count+'"><div class="compny_name_labl">Online redeem link '+count+':</div><input type="text" name="online_redeem_link[]"   placeholder="Online redeem link" id="online_redeem_link'+count+'"  class="form-control  remvoe_box" autocomplete="off" ></div>';

    append+='<div class="col-md-6 remove'+count+'"><div class="compny_name_labl" for="description">Description '+count+':</div><textarea rows="2" cols="50" name="description[]"  class="form-control space remvoe_box" id="description'+count+'" placeholder="Please enter features" required></textarea></div>';

    append+='<div class="col-md-6 remove'+count+'"><div class="compny_name_labl" for="terms_condition">Terms condition '+count+':</div><textarea rows="2" cols="50" name="terms_condition[]"  class="form-control space remvoe_box" id="terms_condition'+count+'" placeholder="Please enter features" required></textarea></div>';

   

    // append+='<div class="col-md-6 remove'+count+'"><div class="compny_name_labl" for="sub_category">Facebook Link '+count+':</div><input type="text" name="online_facebook[]"   placeholder="Facebook Link" id="online_facebook'+count+'"  class="form-control  remvoe_box" autocomplete="off" ></div>';

    // append+='<div class="col-md-6 remove'+count+'"><div class="compny_name_labl" for="sub_category">Twitter Link '+count+':</div><input type="text" name="online_twitter[]"   placeholder="Twitter Link" id="online_twitter'+count+'"  class="form-control  remvoe_box" autocomplete="off" ></div>';

    // append+='<div class="col-md-6 remove'+count+'"><div class="compny_name_labl" for="sub_category">Instagram Link '+count+':</div><input type="text" name="online_instagram[]"   placeholder="Instagram Link" id="online_instagram'+count+'"  class="form-control  remvoe_box" autocomplete="off" ></div>';


    append+='<div class="remove'+count+'"><span class="remove_btn" data-remove="'+count+'" data-removearray="heading'+count+',description'+count+',discount_message'+count+',terms_condition'+count+',online_redeem_link'+count+'" style="padding:10px;background-color: #e46767;">Delete</span></div></div>';

    // append+='<div class="remove'+count+'"><span class="remove_btn" data-remove="'+count+'" data-removearray="heading'+count+',description'+count+',discount_message'+count+',terms_condition'+count+'" style="padding:10px;background-color: #e46767;">Delete</span></div></div>';

    $("#append_custom").append(append);     
    CKEDITOR.replace('description'+count);
    CKEDITOR.replace('terms_condition'+count);
    count++;
  });
</script>

<script type="text/javascript">
  var in_store_count = 2;
  $(document).on("click","#add_more_in_store",function(){
    // alert('add_more_in_store');
    in_store_array.push('instore_head'+in_store_count);
    in_store_array.push('instore_discount_message'+in_store_count);
    in_store_array.push('instore_discount_code'+in_store_count);
    // in_store_array.push('image'+in_store_count);
    in_store_array.push('instore_desc'+in_store_count);
    in_store_array.push('instore_terms_condition'+in_store_count);
    html_in_store='';
    html_in_store+='<div class="col-md-6 in_store_remove'+in_store_count+'"><div class="compny_name_labl" for="sub_category">Instore Heading '+in_store_count+':</div><input type="text" name="instore_head[]"   placeholder="Like Instore Standard / Family & friends" id="instore_head'+in_store_count+'"  class="form-control  remvoe_box" autocomplete="off" ></div>';


    html_in_store+='<div class="col-md-6 in_store_remove'+in_store_count+'"><div class="compny_name_labl" for="sub_category">Instore discount message '+in_store_count+':</div><input type="text" name="instore_discount_message[]"   placeholder="Instore discount message" id="instore_discount_message'+in_store_count+'"  class="form-control  remvoe_box" autocomplete="off" ></div>';

    html_in_store+='<div class="col-md-6 in_store_remove'+in_store_count+'"><div class="compny_name_labl" for="sub_category">Instore discount code '+in_store_count+':</div><input type="text" name="instore_discount_code[]"   placeholder="Instore discount message" id="instore_discount_code'+in_store_count+'"  class="form-control  remvoe_box" autocomplete="off" ></div>';

    html_in_store+='<div class="col-md-6 in_store_remove'+in_store_count+'">Single use/ Multiple use <select name="use_type[]" class="use_type" ><option value="single"  >Single</option> <option value="multiple"  >Multiple</option> </select></div>';

    html_in_store+='<div class="col-md-6 in_store_remove'+in_store_count+'"><div class="compny_name_labl" for="instore_desc">Instore description '+in_store_count+':</div><textarea rows="2" cols="50" name="instore_desc[]"  class="form-control space remvoe_box" id="instore_desc'+in_store_count+'" placeholder="Please enter features" required></textarea></div>';

    html_in_store+='<div class="col-md-6 in_store_remove'+in_store_count+'"><div class="compny_name_labl" for="instore_terms_condition">Instore Terms condition '+in_store_count+':</div><textarea rows="2" cols="50" name="instore_terms_condition[]"  class="form-control space remvoe_box" id="instore_terms_condition'+in_store_count+'" placeholder="Please enter features" required></textarea></div>';

    html_in_store+='<div class="in_store_remove'+in_store_count+'"><span class="remove_btn_in_store" data-remove="'+in_store_count+'" data-removearray="instore_head'+in_store_count+',instore_desc'+in_store_count+',discount_message'+in_store_count+',instore_terms_condition'+in_store_count+'" style="padding:10px;background-color: #e46767;">Delete</span></div></div>';

    $("#append_html_in_store").append(html_in_store);     
    CKEDITOR.replace('instore_desc'+in_store_count);
    CKEDITOR.replace('instore_terms_condition'+in_store_count);
    in_store_count++;
  });
</script>

<script type="text/javascript">
  $(document).on("click",".remove_btn",function(){
    var remove_id=$(this).data("remove");
    var remove_array=$(this).data("removearray");
    remove_array=remove_array.split(",");   

    // alert(remove_array);
    // return false;
    if(remove_array.length!=0)
    {      
      for(i=0; i<remove_array.length; i++)
      {
         if(index_id=validation_array.indexOf(remove_array[i]))
         {
          // alert("Value exists!"+remove_array[i]+' '+index_id);
          validation_array.splice(index_id,1);
         }     
      } 
    }    
    $(".remove"+remove_id).remove();    
  });
</script>

<script type="text/javascript">
  $(document).on("click",".remove_btn_in_store",function(){
    var remove_id=$(this).data("remove");
    var remove_array=$(this).data("removearray");
    remove_array=remove_array.split(",");   

    // alert("Asd");
    // alert(remove_array);
    // return false;

    if(remove_array.length!=0)
    {      
      for(i=0; i<remove_array.length; i++)
      {
         if(index_id=validation_array.indexOf(remove_array[i]))
         {
          // alert("Value exists!"+remove_array[i]+' '+index_id);
          validation_array.splice(index_id,1);
         }     
      } 
    }    
    $(".in_store_remove"+remove_id).remove();    
  });
</script>

