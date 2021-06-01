<?php echo $form->messages();

    $university_post_id = $event_title = $event_link = $event_description  = $event_images =  '';

    if (isset($edit)) 
    {
		$university_post_id = $edit['university_post_id'];
		$event_title 	= $edit['event_title'];
        $event_link   = $edit['event_link'];
		$event_description 	= $edit['event_description'];

    }
 ?>



 <div class="row">
   <div class="col-sm-12">
      <!-- <form class="form-horizontal"> -->
      	<?php echo $form->open(); ?> 
	         <fieldset>
	         <!-- Text input-->
	         <div  class="col-sm-6">
	            <div class="">
	               <span class="span_label">Event title </span>
	               <input id="event_title" value="" name="event_title" type="text" placeholder="Enter event title" class="form-control input-md">
	            </div>
	         </div>

             <div  class="col-sm-6">
                <div class="">
                   <span class="span_label">Event link </span>
                   <input id="event_link" value="" name="event_link" type="text" placeholder="Enter event link" class="form-control input-md">
                </div>
             </div>

             <div  class="col-sm-6">
                <div class="">
                   <span class="span_label">Event description </span>
                   <input id="event_description" value="" name="event_description" type="text" placeholder="Enter event description" class="form-control input-md">
                </div>
             </div>





	            <div class="col-sm-6">
                  <span class="span_label">Select User / Admin</span>
                  <select id="user_id" name="user_id" class="university_schoo" >
                      <option value="0">Select user/admin</option>
                      <option value="1">Admin</option>
                      <?php if (!empty($users)) {
                      foreach ($users as $ckey => $uvalue) {
                      ?>
                          <option value="<?php echo $uvalue['id']; ?>"> <?php echo $uvalue['username']; ?> </option>
                      <?php } } ?>
                 </select>
              	</div>


	           


	            <div class="col-sm-6">
                  <span class="span_label">University/School</span>
                  <select id="university_post_id" name="university_post_id" class="university_schoo" >
                 </select>
              	</div>

              	<div class="col-sm-6">
	               <span class="span_label">Post through group</span>
	               <select id="post_through_group" name="post_through_group" class="post_through_group" >
	               	<option value="0">Select option</option>
	                  <option value="no" <?php if(@$status==='no') echo 'selected="selected"';?> >No</option>
	                  <option value="yes" <?php if(@$status==='yes') echo 'selected="selected"';?> >Yes</option>
	               </select>
	            </div>


	            <div class="col-sm-6 group_id_div" >
                  <span class="span_label">Select Group</span>
                  <select id="group_id" name="group_id" class="group_id" >
                      <option value="0">Select Group</option>
                      <?php if (!empty($university_schools)) {

                      foreach ($university_schools as $ckey => $cvalue) {
                          $uni_schools = ($university_post_id == $cvalue['id'] ) ? "selected" : "";
                      ?>
                          <option value="<?php echo $cvalue['id']; ?>" <?php echo $uni_schools; ?>  ><?php echo $cvalue['name']; ?></option>
                      <?php } } ?>
                 </select>
              	</div>

	            <div class="col-sm-12">
                    <span class="span_label">Event images </span>
                    <input type="hidden" id="photo_url" value="<?php echo base_url('admin/file_handling/uploadFiless'); ?>" />
                    <input type="hidden" id="img_url" value="admin/products/" />
                    <input type="hidden" id="event_images" name="event_images" value="<?php echo !empty($event_images)? ','.$event_images:''; ?>" required />
                    <div class="row prepend_img">
                        <?php 
                        $index = 1;
                        if (!empty($event_images))
                        {
                            $image = explode(',', $event_images);
                            foreach ($image as $key => $value)
                            {
                                echo '<div class="col-sm-2" id="pic'.$index.'"><button type="button" class="close" onclick="remove_pic(\''.$index.'\',\''.','.$value.'\')" >&times;</button><img src="'.base_url("assets/admin/products/$value").'" class="product_imges" /></div>';
                                $index++;
                            }
                        }


                        ?>
                        <input type="hidden" id="index" value="<?php echo $index; ?>" />
                            <div class="img_uplod_glry">
                                <div class="col-inner">
                                    <div class="img_upld_labl">
                                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                                        <span> Upload Photo  </span>
                                    </div>

                                    <input type="file"  class="uplod_pic_input" id="file" value="<?php //echo $product_image; ?>"  />
                                    <label for="file" class="file__drop" data-image-uploader>
                                    <span class="text">&nbsp;</span>
                                    <!-- <img data-image src="<?php //echo base_url("assets/admin/products/$product_image"); ?>" style="width: 50px;height: 50px;padding: 10px 0;" /> -->
                                    <!-- <span class="choose-image"><?php echo "Choose Product Image"; ?></span> -->
                                    </label>
                                </div>
                                <!-- <p>image size must be (width-415 * height-410) </p> -->
                            </div>
                        <br><br>
                    </div>


                </div>


                <div class="col-sm-12">
	               <br>
	               <button type="submit" class="btn button-white uppercase"> Submit</button>
	            </div>

      	<?php echo $form->close(); ?>
   </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">





<script type="text/javascript">
	$(document).on("submit","#create_event",function()
	{
        var event_title                  	= $("#event_title").val();
        var event_link                  	= $("#event_link").val();
        var event_description               = $("#event_description").val();
        var post_through_group              = $("#post_through_group").val();
        var university_post_id              = $("#university_post_id").val();
        var group_id              			= $("#group_id").val();
        var user_id                         = $("#user_id").val(); 
        var event_images                    = $(".uplod_pic_input").val(); 
        var error=1;

        // alert(uplod_pic_input);
        // alert(option_first);
        // alert(university_school_id);
        // return false;

        if(event_title == '')
        {
            swal("","Please enter title",'warning');
            error=0;
            return false;
        }
        if(event_link == '')
        {
            swal("","Please enter event link",'warning');
            error=0;
            return false;
        }
        if(event_description == '')
        {
            swal("","Please enter description ",'warning');
            error=0;
            return false;
        }
        if(user_id == 0)
        {
            swal("","Please select user / admin ",'warning');
            error=0;
            return false;
        }

        if(university_post_id == 0)
        {
            swal("","Please select university/school ",'warning');
            error=0;
            return false;
        }


        if(post_through_group == 0)
        {
            swal("","Please select this post send to group ",'warning');
            error=0;
            return false;
        }
        if(post_through_group == 'yes')
        {
        	if(group_id == 0)
	        {
	            swal("","Please select group ",'warning');
	            error=0;
	            return false;
	        }
        }
        if(event_images == '')
        {
            swal("","Please upload event images ",'warning');
            error=0;
            return false;
            
        }
        
     
    });
</script>

<script type="text/javascript">
    $(function(){
        setTimeout(function() {
            $('.alert-success').fadeOut('slow');
        }, 5000); // <-- time in milliseconds

    });
</script>








<style type="text/css">

   
    .group_id_div{
    display: none;
    }



</style>


<script type="text/javascript">
   $(document).on("change","#user_id",function(){
       var u_id = $(this).val();      
       // alert(u_id);
       // return false;

        // this 4 lines are only to refresh post through group 
        $('#post_through_group').empty(); //remove all child nodes
        var newOption = $('<option value="0">Select option</option><option value="no">No</option><option value="yes">Yes</option>');
        $('#post_through_group').append(newOption);
        $('#post_through_group').trigger("chosen:updated");

        $("#group_id").css("display","none");
        $(".group_id_div").css("display","none");



       if(u_id!=0){
         $.ajax({
            type: 'POST',
             url: "<?php echo base_url(); ?>admin/post/get_user_school_uni",
             data: {u_id:u_id},
            success:function(response)
            {
               var html='';
               if(response==0) {
                  swal("","Something went worng","warning");
               }
               else if(response=="not_found") 
               {
                  // alert("yes2");
                  $('#university_post_id').prop('disabled', true).trigger("chosen:updated");
                  // $('#brand_id').prop('disabled', false).trigger("chosen:updated"); 
               }
               else 
               {
                  // $(".get_brands").css("display", "block");
                  var response = $.parseJSON(response);
                  // alert("yes");
                  html+="<option value='0'>Select University/School</option>";
                  $.each(response, function( k, v ) {           
                  html+="<option   value='"+v.id+"'>"+v.name+"</option>";
                  }); 
                  $('#university_post_id').prop('disabled', false).trigger("chosen:updated");                                
                  $("#university_post_id").html(html);
                  $('#university_post_id').trigger('chosen:updated'); 
               } 
            }
         });        
       } else {
           $('#university_post_id').prop('disabled', true).trigger("chosen:updated");
       }    
     });
</script>


<script type="text/javascript">
   $(document).on("change","#post_through_group",function()
   {
       var post_grup = $(this).val();  
       var user_id  = $("#user_id").val(); 
       var university_post_id  = $("#university_post_id").val(); 

        if (user_id == 0) 
        {
            $('#post_through_group').empty(); //remove all child nodes
            var newOption = $('<option value="0">Select option</option><option value="no">No</option><option value="yes">Yes</option>');
            $('#post_through_group').append(newOption);
            $('#post_through_group').trigger("chosen:updated");

            swal("","Please select user/admin",'warning');
            error=0;
            return false;
        }

        if (university_post_id == 0) 
        {
            // this 4 lines are only to refresh post through group 
            $('#post_through_group').empty(); //remove all child nodes
            var newOption = $('<option value="0">Select option</option><option value="no">No</option><option value="yes">Yes</option>');
            $('#post_through_group').append(newOption);
            $('#post_through_group').trigger("chosen:updated");


            swal("","Please select university/school",'warning');
            error=0;
            return false;
        }


       // alert(post_grup);
       // alert(user_id);
       // return false;

       if(post_grup== 'yes')
       {
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>admin/post/get_user_groups",
                data: {user_id:user_id,university_post_id:university_post_id},
                success:function(response)
                {
                    // alert(response);

                    var html='';
                    if(response == 0) 
                    {
                        swal("","Something went worng","warning");
                    }
                    else if(response == "not_found") 
                    {
                        $('#group_id').prop('disabled', true).trigger("chosen:updated");
                        swal("","No any group found .",'warning');
                        $("#group_id_div").css("display","block");
                    }
                    else 
                    {
                        $(".group_id_div").css("display","block");
                        // $(".get_brands").css("display", "block");
                        var response = $.parseJSON(response);
                        // alert("yes");
                        html+="<option value='0'>Select group</option>";
                        $.each(response, function( k, v ) 
                        {           
                            html+="<option   value='"+v.group_id+"'>"+v.group_name+"</option>";
                        }); 
                        $('#group_id').prop('disabled', false).trigger("chosen:updated");                                
                        $("#group_id").html(html);
                        $('#group_id').trigger('chosen:updated'); 
                    } 
                }
            });        
       }
       else 
       {
            $("#group_id").css("display","none");
            $(".group_id_div").css("display","none");
            $('#group_id').prop('disabled', true).trigger("chosen:updated");
       }    
     });
</script>


<script type="text/javascript">
    jQuery('body').on({'drop dragover dragenter': dropHandler}, '[data-image-uploader]');
    jQuery('body').on({'change': regularImageUpload}, '#file');

    function regularImageUpload(e) {
        var file =jQuery(this)[0],
        type = file.files[0].type.toLocaleLowerCase();

        if(type.match(/jpg/) !== null ||
        type.match(/jpeg/) !== null ||
        type.match(/png/) !== null ||
        type.match(/gif/) !== null) {
            readUploadedImage(file.files[0]);
        }
    }

    function dropHandler(e) 
    {
        e.preventDefault();

        if(e.type === 'drop' && e.originalEvent.dataTransfer && e.originalEvent.dataTransfer.files.length)
        {

            var files = e.originalEvent.dataTransfer.files,
            type = files[0].type.toLocaleLowerCase();

            if(type.match(/jpg/) !== null ||
            type.match(/jpeg/) !== null ||
            type.match(/png/) !== null ||
            type.match(/gif/) !== null) 
            {
                readUploadedImage(files[0]);
            }
        }
        return false;
    }

    function readUploadedImage(img) {
        var reader;

    if(window.FileReader) {
        reader = new FileReader();
        reader.readAsDataURL(img);

    reader.onload = function (file) 
    {
        if(file.target && file.target.result) 
        {
            imageLoader(file.target.result, displayImage);
        }

    };

    reader.onerror = function () 
    {
        throw new Error('Something went wrong!');
    };

    } 
    else 
    {
        throw new Error('FileReader not supported!');
    }

    }

    function imageLoader(src, callback) 
    {
        var img;
        img = new Image();
        img.src = src;

        img.onload = function() 
        {
            imageResizer(img, callback);
        }

    }

    function imageResizer(img, callback) 
    {
        var canvas = document.createElement('canvas');
        canvas.width = 50;
        canvas.height = 50;
        context = canvas.getContext('2d');
        context.drawImage( img, 0, 0, 50, 50 );
        callback(canvas.toDataURL());
    }

    function displayImage(img) 
    {
        file =jQuery("#file")[0];
        fd = new FormData();
        // console.log(file.files[0]);
        individual_capt = "My logo";
        fd.append("caption", individual_capt);  
        fd.append('action', 'fiu_upload_file'); 
        fd.append("file", file.files[0]);
        fd.append("path", $('#img_url').val());
        
        $('#loading').show();


        jQuery.ajax({
            type: 'POST',
            url: $('#photo_url').val(),
            data: fd,
            contentType: false,
            cache: false,
            processData: false,
            success: function(response)
            {
                if(response == "false")
                {
                    alert("Something went wrong, Please try again...");
                }
                else
                {
                    $('#loading').hide();
                    // jQuery('[data-image]').attr('src', img);
                    var images = jQuery('#event_images').val();
                    var index = jQuery('#index').val();
                    jQuery('#event_images').val(images + ',' + response);
                    jQuery('.prepend_img').prepend('<div class="img_uploaded_glry" id="pic'+index+'"><a  class="delt_optn_img" onclick="remove_pic(\''+index+'\',\''+',' + response+'\')" ><i class="fa fa-trash-o" aria-hidden="true"></i></a><img src="<?php echo base_url("assets/admin/products/"); ?>'+response+'" class="img_uploded_thum" /></div>');
                    index = parseInt(index) + 1;
                }
            }
        });
    }

    function remove_pic(id,name)
    {
        swal({
            title: "Are you sure?",
            text: "You want to remove this event image",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
        },
        function()
        {
            var event_images = jQuery('#event_images').val();
            event_images = event_images.replace(name,'');
            jQuery('#event_images').val(event_images);
            jQuery('#pic'+id).remove();
            swal("Deleted!", "Event image removed", "success");
        });
    }

</script>