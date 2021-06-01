<?php echo $form->messages();

    $university_post_id = $question = $options  = $post_through_group = '';

    if (isset($edit)) 
    {
		$university_post_id = $edit['university_post_id'];
		$question 	= $edit['question'];
		$options 	= $edit['options'];
		$post_through_group 	= $edit['post_through_group'];

		$user_id 			= $edit['user_id'];
		if (empty($user_id)) 
		{
			$user_id = '1';
		}
		else
		{
			$user_id = $edit['user_id'];
		}

    }
 ?>



 <div class="row">
   <div class="col-sm-6">
      <!-- <form class="form-horizontal"> -->
      	<?php echo $form->open(); ?> 
	         <fieldset>
	         <!-- Text input-->
	         <div  class="form-line">
	            <div class="col-md-12 margin-bottom">
	               <span class="span_label">Ask a question...</span>
	               <input id="question" value="<?php echo $question ?>" name="question" type="text" placeholder="Ask a question..." class="form-control input-md">
	            </div>
	         </div>

	         <div  class="form-line">
	            <!-- <label class="col-md-12" >Option 1</label> -->
	            <div class="col-md-12 margin-bottom">
	               <input id="option_first" name="options[]" type="text" value="<?php echo @$options[0]['options'] ?>" placeholder="Enter option 1" class="form-control input-md" autocomplete="off">
	            </div>
	         </div>

	         <div  id="" class="form-line">
	            <!-- <label class="col-md-12" >Option 1</label> -->
	            <div class="col-md-12 margin-bottom">
	               <input id="option_second" name="options[]" value="<?php echo @$options[1]['options'] ?>" type="text" placeholder="Enter option 2" class="form-control input-md" autocomplete="off" >
	            </div>
	         </div>

	         <?php if (!empty($options)): ?>
	         <?php foreach ($options as $key => $value): ?>
	         		<?php if ($key >= 2): ?>
	         			
		         		<div class="next-option col-md-12">
		         			<input id="1" name="options[]" type="text" placeholder="Enter name another option" value="<?php echo @$value['options'] ?>" class="form-control input-md" autocomplete="off">
		         		</div>

	         		<?php endif ?>
	         <?php endforeach ?>
	         <?php endif ?>

	         <div  id="items" class="form-line">
	         </div>

	         <div class="col-sm-12">
	            <div class="form-line" style="margin-bottom: 10px;">
	               <span id="add" class="btn add-more button-yellow uppercase" type="button">+ Add another option</span> <span class="delete btn button-white uppercase">- Remove option</span>
	            </div>
	            


	            <div class="form-line">
                  <span class="span_label">Select User / Admin</span>
                  <select id="user_id" name="user_id" class="university_schoo" >
					<option value="0">Select user/admin</option>
					<option value="1" <?php if($user_id==='1') echo 'selected="selected"';?> >Admin</option>
					<?php if (!empty($users)) {
					foreach ($users as $ckey => $uvalue) {
						$user_s = ($user_id == $uvalue['id'] ) ? "selected" : "";
					?>
					<option value="<?php echo $uvalue['id']; ?>" <?php echo $user_s; ?> > <?php echo $uvalue['username']; ?> </option>
					<?php } } ?>
                 </select>
              	</div>
              	<br>

	            <div class="form-line">
                  <span class="span_label">University/School</span>
                  <select id="university_post_id" name="university_post_id" class="university_schoo" >
                      <option value="0">Select University/School</option>
                      <?php if (!empty($university_schools)) {

                      foreach ($university_schools as $ckey => $cvalue) {
                          $uni_schools = ($university_post_id == $cvalue['id'] ) ? "selected" : "";
                      ?>
                          <option value="<?php echo $cvalue['id']; ?>" <?php echo $uni_schools; ?>  ><?php echo $cvalue['name']; ?></option>
                      <?php } } ?>
                 </select>
              </div>
              <br>


              <div class="form-line">
	               <span class="span_label">Post through group</span>
	               <select id="post_through_group" name="post_through_group" class="post_through_group" >
	               	<option value="0">Select option</option>
	                  <option value="no" <?php if(@$post_through_group==='no') echo 'selected="selected"';?> >No</option>
	                  <option value="yes" <?php if(@$post_through_group==='yes') echo 'selected="selected"';?> >Yes</option>
	               </select>
	            </div>
	            <br>


              	<div class="form-line group_id_div" >
                  <span class="span_label">Select Group</span>
                  <select id="group_id" name="group_id" class="group_id" >
                      <option value="0">Select Group</option>
                      <?php if (!empty($select_group)) {

                      foreach ($select_group as $ckey => $cvalue) {
                          $gru_sel = ($group_id == $cvalue['group_id'] ) ? "selected" : "";
                      ?>
                          <option value="<?php echo $cvalue['group_id']; ?>" <?php echo $gru_sel; ?>  ><?php echo $cvalue['group_name']; ?></option>
                      <?php } } ?>
                 </select>
              	</div>



	            <div class="form-line">
	               <br>
	               <button type="submit" class="btn button-white uppercase"> Submit</button>
	            </div>
	         </div>
      	<?php echo $form->close(); ?>
   </div>
</div>




<script type="text/javascript">
	$(document).on("submit","#edit_post",function()
	{
        var question                  			= $("#question").val();
        var option_first                  	= $("#option_first").val();
        var option_second                  	= $("#option_second").val();
        var post_through_group               = $("#post_through_group").val();
        var university_post_id               = $("#university_post_id").val();
	    var group_id              			= $("#group_id").val();

        var error=1;

        // alert(group_id);
        // alert(option_first);
        // alert(university_school_id);
        // return false;

        if(question == '')
        {
            swal("","Please enter question",'warning');
            error=0;
            return false;
        }
        if(option_first == '')
        {
            swal("","Please enter option first",'warning');
            error=0;
            return false;
        }
        if(option_second == '')
        {
            swal("","Please enter second option ",'warning');
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

        
     
    });
</script>





<script type="text/javascript">
  	$(document).ready(function() 
  	{
  		var counter = 1;

		// $(".delete").hide();

		//when the Add Field button is clicked
		$("#add").click(function(e) 
		{
			$(".delete").fadeIn("1500");
			//Append a new row of code to the "#items" div
			$("#items").append(
				'<div class="next-option col-md-12"><input id="'+counter+'" name="options[]" type="text" placeholder="Enter name another option" class="form-control input-md" autocomplete="off"></div>'
			);

			counter++;   

		});

		$("body").on("click", ".delete", function(e) 
		{
			$(".next-option").last().remove();
		});
	});


</script>


<style type="text/css">
	span.span_label {
	margin-bottom: 10px;
	display: block;
	}

	span#add  ,  span.delete.btn.button-white.uppercase {
	border: 1px solid #cdcdcd;
	}

</style>



<script type="text/javascript">
   $(document).on("change","#user_id",function(){
       var u_id = $(this).val();      
       // alert(u_id);
       // return false;



        $('#post_through_group').empty(); //remove all child nodes
        var newOption = $('<option value="0">Select option</option><option value="no">No</option><option value="yes">Yes</option>');
        $('#post_through_group').append(newOption);
        $('#post_through_group').trigger("chosen:updated");



       if(u_id!=0)
       {
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
	$(function(){
		setTimeout(function() {
		    $('.alert-success').fadeOut('slow');
		}, 5000); // <-- time in milliseconds

	});
</script>

<?php if ($post_through_group =='no'): ?>
	<script type="text/javascript">
		$("#group_id").css("display","none");
		$(".group_id_div").css("display","none");
		$('#group_id').prop('disabled', true).trigger("chosen:updated");
	</script>
<?php endif ?>


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

