
<div class="">
	<div class="row">
		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header">
					<h4 class="box-title">Self introduction</h4>
				</div>
				<div class="box-body">
					<!-- <form action="" method="post" id="self_introduction" > -->

						<div class="form-group form-float form-group-lg">
							<div class="form-line">
								<span>Username</span>
								<input autocomplete="off" type="text" name="username" value="<?php echo $edit['username'] ?>" placeholder="Last Name" id="username" class="form-control ">
							</div>

							<div class="form-line">
								<span>Status</span>
								<input autocomplete="off" type="text" name="designation" value="<?php echo $edit['designation'] ?>" placeholder="Last Name" id="designation" class="form-control ">
							</div>

							<div class="form-line">
								<span>Headline</span>
								<input autocomplete="off" type="text" name="organisation" value="<?php echo $edit['organisation'] ?>" placeholder="Last Name" id="organisation" class="form-control ">
							</div>

							<button type="submit" class="btn btn-primary update" id="self_introduction">Update</button>

						</div>

					</form>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header">
					<h4 class="box-title">Personal Mission Statemant</h4>
				</div>
				<div class="box-body">
					<!-- <form action="" method="post" > -->

						<div class="form-group form-float form-group-lg">
							<div class="form-line">
								<span>Personal Mission Statemant</span>
								<input type="text" name="personal_mission" value="<?php echo $edit['personal_mission'] ?>" placeholder="Personal Mission Statemant" id="personal_mission" class="form-control ">
							</div>

							<div class="form-line">
								<span>Personal Mission Description</span>
								<textarea id="personal_description" name="personal_description" ><?php echo $edit['personal_description'] ?></textarea> 
								<!-- type="text" name="personal_description" value="<?php echo $edit['personal_description'] ?>" placeholder="Personal Mission Description" id="personal_description" class="form-control "> -->
							</div>

							

							<button type="submit" id="personal_mission_statement" class="btn btn-primary update">Update</button>

						</div>

					<!-- </form> -->
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header">
					<h4 class="box-title">Personal Highlights</h4>
				</div>
				<div class="box-body personal_height">
					<!-- <form action="" method="post" > -->

						<div class="form-group form-float form-group-lg">
							<div class="form-line">
								<span>Currently working at </span>
								<input type="text" name="currently_working" value="<?php echo $user_highlights[0]['currently_working'] ?>" placeholder="Currently working at" id="currently_working" class="form-control ">
							</div>

							<div class="form-line">
								<span>Currently studying </span>
								<input type="text" name="currently_studying" value="<?php echo $user_highlights[0]['currently_studying'] ?>" placeholder="Currently studying" id="currently_studying" class="form-control ">
							</div>

							<div class="form-line">
								<span>Grauated from </span>
								<input type="text" name="graduated_from" value="<?php echo $user_highlights[0]['graduated_from'] ?>" placeholder="Grauated from" id="graduated_from" class="form-control ">
							</div>

							<div class="form-line">
								<span>Complete highschool at </span>
								<input type="text" name="complete_highschool_at" value="<?php echo $user_highlights[0]['complete_highschool_at'] ?>" placeholder="Complete highschool at" id="complete_highschool_at" class="form-control ">
							</div>

							<div class="form-line">
								<span>Lives in </span>
								<input type="text" name="lives_in" value="<?php echo $user_highlights[0]['lives_in'] ?>" placeholder="Lives in" id="lives_in" class="form-control ">
							</div>

							<div class="form-line">
								<span>From </span>
								<input type="text" name="from" value="<?php echo $user_highlights[0]['from'] ?>" placeholder="From" id="from" class="form-control ">
							</div>

						</div>

					<!-- </form> -->
				</div>
				<button type="submit" id="personal_highlights" class="btn btn-primary update">Update</button>

			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header">
					<h4 class="box-title">Social Profile</h4>
				</div>
				<div class="box-body">
					<!-- <form action="" method="post" > -->

						<div class="form-group form-float form-group-lg">
							<div class="form-line">
								<!-- <span>Facebbok</span> -->
								<input autocomplete="off" type="text" name="facebook" value="<?php echo $user_social_profile[0]['facebook'] ?>" placeholder="Facebook link" id="facebook" class="form-control">
							</div>

							<div class="form-line">
								<!-- <span>Instagram</span> -->
								<input autocomplete="off"  type="text" name="instagram" value="<?php echo $user_social_profile[0]['instagram'] ?>" placeholder="Instagram link" id="instagram" class="form-control ">
							</div>

							<div class="form-line">
								<!-- <span>Snapchat</span> -->
								<input autocomplete="off"  type="text" name="snapchat" value="<?php echo $user_social_profile[0]['snapchat'] ?>" placeholder="Snapchat link" id="snapchat" class="form-control ">
							</div>

							<div class="form-line">
								<!-- <span>Twitter</span> -->
								<input autocomplete="off"  type="text" name="twitter" value="<?php echo $user_social_profile[0]['twitter'] ?>" placeholder="Twitter link" id="twitter" class="form-control ">
							</div>

							<div class="form-line">
								<!-- <span>LinkedIn</span> -->
								<input autocomplete="off"  type="text" name="linkedIn" value="<?php echo $user_social_profile[0]['linkedIn'] ?>" placeholder="LinkedIn link" id="linkedIn" class="form-control ">
							</div>



							<button type="submit" id="social_media" class="btn btn-primary update">Update</button>

						</div>

					<!-- </form> -->
				</div>
			</div>
		</div>


		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header">
					<h4 class="box-title">User interest</h4>
				</div>
				<div class="box-body">
					<!-- <form action="" method="post" > -->

						<div class="form-group form-float form-group-lg">
							<div class="form-line">
								<!-- <span>Facebbok</span> -->
								<input type="text" name="user_interest" value="<?php echo $user_interest ?>" placeholder="Enter user interest with comma seprate" id="user_interest" class="form-control ">
							</div>
							<button type="submit" id="user_interest_update" class="btn btn-primary update">Update</button>
						</div>
					<!-- </form> -->
				</div>

				<br>

				<div class="box-header">
					<h4 class="box-title">User course</h4>
				</div>

				<div class="box-body">
					<!-- <form action="" method="post" > -->

						<div class="form-group form-float form-group-lg">
							<div class="form-line">
								<!-- <span>Facebbok</span> -->
								<input type="text" name="user_course" value="<?php echo $user_course ?>" placeholder="Enter user courses with comma seprate" id="user_course" class="form-control ">
							</div>

							<button type="submit" id="user_course_update" class="btn btn-primary update">Update</button>

						</div>

					<!-- </form> -->
				</div>


			</div>
		</div>

		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header">
					<h4 class="box-title">User languages</h4>
				</div>

				<div class="box-body">
					<!-- <form action="" method="post" > -->

						<div class="form-group form-float form-group-lg">
							<div class="form-line">
								<!-- <span>Facebbok</span> -->
								<input type="text" name="user_languages" value="<?php echo $user_languages ?>" placeholder="Enter languages with comma seprate" id="user_languages" class="form-control ">
							</div>

							<button type="submit" id="user_language_update" class="btn btn-primary update">Update</button>

						</div>

					<!-- </form> -->
				</div>

				
			</div>
		</div>
	</div>
</div>

<div class="">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h4 class="box-title">User Experience 
						<a target="_blank" href="<?php echo base_url('/admin/experience/create/') ?><?php echo $edit['id'] ?>"><span class="material-icons library_add">library_add </span> </a>
					</h4>

				</div>
				<div class="box-body">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
						    <tr>
						        <th>Id</th>
						        <th>Company name</th>
						        <th>Emp type</th>
						        <th>Industry</th>
						        <th>Designation</th>
						        <th>Start date</th>
						        <th>End date</th>
						        <th>Location</th>
						        <th>Actions</th>
						    </tr>
						</thead>

					    <tbody id="table_body">      
					    <?php
					    if(!empty($user_experience)){
					    foreach($user_experience as $ekey => $eerow)
					    { ?>
					     <tr>
					      <td><?php echo $eerow['id']?></td>
					      <td><?php echo $eerow['company_name']?></td>
					      <td><?php echo $eerow['emp_type']?></td>
					      <td><?php echo $eerow['industry']?></td>
					      <td><?php echo $eerow['designation']?></td>
					      <td><?php echo $eerow['start_date']?></td>
					      <td><?php echo $eerow['end_date']?></td>
					      <td><?php echo $eerow['location']?></td>
					      
					      <td>
					         <a target="_blank" style="width: 30px;" href="experience/edit/<?php echo $eerow['id'] ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">edit</i></a>

					         <a style="width: 30px;"  href="javascript:void(0)" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float  detete_user_experience" data-id="<?php echo $eerow['id']; ?>" role="button" ><i class="material-icons">delete</i></a>
					      </td>

					      </tr>

					    <?php } }else{ ?>
					      <tr><td colspan="9">No Record found</td></tr>
					    <?php }?>
					    </tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h4 class="box-title">User Education 
						<a target="_blank" href="<?php echo base_url('/admin/education/create/') ?><?php echo $edit['id'] ?>"><span class="material-icons library_add">library_add </span> </a>
					</h4>

				</div>
				<div class="box-body">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
						    <tr>
						        <th>Id</th>
						        <th>College name</th>
						        <!-- <th>Image</th> -->
						        <th>Concentration</th>
						        <th>Degree</th>
						        <th>Club society</th>
						        <th>Grade</th>
						        <th>Start date</th>
						        <th>End date</th>
						        <th>Actions</th>
						    </tr>
						</thead>

					    <tbody id="table_body">      
					    <?php
					    if(!empty($user_education)){
					    foreach($user_education as $ekey => $urrow)
					    { ?>
					     <tr>
					      <td><?php echo $urrow['id']?></td>
					      <td><?php echo $urrow['college_name']?></td>
					      <!-- <td><?php echo $urrow['image']?></td> -->
					      <td><?php echo $urrow['concentration']?></td>
					      <td><?php echo $urrow['degree']?></td>
					      <td><?php echo $urrow['club_society']?></td>
					      <td><?php echo $urrow['grade']?></td>
					      <td><?php echo $urrow['start_date']?></td>
					      <td><?php echo $urrow['end_date']?></td>
					      
					      <td>
					         <a target="_blank" style="width: 30px;" href="education/edit/<?php echo $urrow['id'] ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">edit</i></a>

					         <a style="width: 30px;"  href="javascript:void(0)" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float  detete_user_education" data-id="<?php echo $urrow['id']; ?>" role="button" ><i class="material-icons">delete</i></a>
					      </td>

					      </tr>

					    <?php } }else{ ?>
					      <tr><td colspan="9">No Record found</td></tr>
					    <?php }?>
					    </tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h4 class="box-title">User Achievements 
						<a target="_blank" href="<?php echo base_url('/admin/achievements/create/') ?><?php echo $edit['id'] ?>"><span class="material-icons library_add">library_add </span> </a>
					</h4>
					
				</div>
				<div class="box-body">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
						<thead>
						    <tr>
						        <th>Id</th>
						        <th>Certificate name</th>
						        <th>Offered by</th>
						        <th>Offered date</th>
						        <th>Duration</th>
						        <th>Actions</th>
						    </tr>
						</thead>

					    <tbody id="table_body">      
					    <?php
					    if(!empty($user_achievements)){
					    foreach($user_achievements as $akey => $avalue)
					    { ?>
					     <tr>
					      <td><?php echo $avalue['id']?></td>
					      <td><?php echo $avalue['certificate_name']?></td>
					      <td><?php echo $avalue['offered_by']?></td>
					      <td><?php echo $avalue['offered_date']?></td>
					      <td><?php echo $avalue['duration']?></td>
					      
					      <td>
					         <a target="_blank" style="width: 30px;" href="<?php echo base_url('/admin/achievements/edit/') ?><?php echo $avalue['id'] ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">edit</i></a>

					         <a style="width: 30px;"  href="javascript:void(0)" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float  delete_user_achievements" data-id="<?php echo $avalue['id']; ?>" role="button" ><i class="material-icons">delete</i></a>
					      </td>

					      </tr>

					    <?php } }else{ ?>
					      <tr><td colspan="6">No Record found</td></tr>
					    <?php }?>
					    </tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
</div>

<style type="text/css">

	button.btn.btn-primary.update {
	margin-top: 10px;
	}

	.form-control:focus {
    box-shadow: none;
        border-bottom: 1px solid #650f92cd;
    }


	span.material-icons.library_add {
	position: absolute;
	top: 7px;
	margin-left: 10px;
	}
	#personal_description{
	height: 123px;
	border: none;
	width: 100%;
	}
	.form-line span{
	margin-top: 16px;
	display: block;
	}
	.personal_height{
	height: 240px;
	overflow-y: scroll;
	}
</style>

<script type="text/javascript">
  $(document).on('click',".delete_user_achievements",function(){
    var aid = $(this).data('id');
    // alert(aid);
    // return false;

    if(aid != '')
    {
      swal({
            title: "",
            text: "Are you sure you want to delete this achievements !!",
            type:"warning",                                  
            showCancelButton: true,                  
            confirmButtonText: "OK",
            cancelButtonText: "CANCEL",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(inputValue){         
            if (inputValue===true) {                
              $.ajax({
              type: 'POST',
              url: '<?php echo base_url('admin/users/delete_achievements') ?>',
              data: {aid:aid},
              success: function(response){                               
               if(response)
               {
                swal("","Achievements Deleted successfully. ",'success');
                setTimeout(function(){ location.reload(); }, 2000);
               }else {
                swal("","Some thing want worng!!","warning");
               }
              }
        });            
            } 
      });
    } else {
      swal("","Some thing want worng!!","warning");
    }
     
  });    
</script>

<script type="text/javascript">
  $(document).on('click',".detete_user_education",function(){
    var e_id = $(this).data('id');
    // alert(e_id);
    // return false;

    if(e_id != '')
    {
      swal({
            title: "",
            text: "Are you sure you want to delete this education !!",
            type:"warning",                                  
            showCancelButton: true,                  
            confirmButtonText: "OK",
            cancelButtonText: "CANCEL",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(inputValue){         
            if (inputValue===true) {                    
              $.ajax({
              type: 'POST',
              url: '<?php echo base_url('admin/users/delete_education') ?>',
              data: {e_id:e_id},
              success: function(response){                               
               if(response)
               {
                swal("","Education Deleted successfully.",'success');
                setTimeout(function(){ location.reload(); }, 2000);
               }else {
                swal("","Some thing want worng!!","warning");
               }
              }
        });            
            } 
      });
    } else {
      swal("","Some thing want worng!!","warning");
    }
     
  });    
</script>

<script type="text/javascript">
  $(document).on('click',".detete_user_experience",function(){
    var ue_id = $(this).data('id');
    // alert(ue_id);
    // return false;

    if(ue_id != '')
    {
      swal({
            title: "",
            text: "Are you sure you want to delete this experience !!",
            type:"warning",                                  
            showCancelButton: true,                  
            confirmButtonText: "OK",
            cancelButtonText: "CANCEL",
            closeOnConfirm: true,
            closeOnCancel: true
          },
          function(inputValue){         
            if (inputValue===true) {                    
              $.ajax({
              type: 'POST',
              url: '<?php echo base_url('admin/users/delete_experience') ?>',
              data: {ue_id:ue_id},
              success: function(response){                               
               if(response)
               {
                swal("","Experience Deleted successfully.",'success');
                setTimeout(function(){ location.reload(); }, 2000);
               }else {
                swal("","Some thing want worng!!","warning");
               }
              }
        });            
            } 
      });
    } else {
      swal("","Some thing want worng!!","warning");
    }
     
  });    
</script>

<script type="text/javascript">
	$(document).on("click","#self_introduction",function(){
		var user_id 		= "<?php echo $edit['id']; ?>"
		var username 		= $("#username").val();
		var designation 	= $("#designation").val();
		var organisation 	= $("#organisation").val();
		var error=1;

		// alert(user_id);
		// return false;

		if(username == '')
		{
			swal("","Please enter product name",'warning');
			error=0;
			return false;
		}
		if(designation == '')
		{
			swal("","Please enter designation in status",'warning');
			error=0;
			return false;
		}
		if(organisation == '')
		{
			swal("","Please enter organisation name in headline",'warning');
			error=0;
			return false;
		}
		
		$('#loading').show();
		$.ajax({
			type: 'POST',
			url: "<?php echo base_url(); ?>admin/users/update_self_introduction",
			data: {user_id:user_id,username:username,designation:designation,organisation:organisation},
			// dataType: 'json',       
			success: function(response)
			{ 
				response = response.trim();
				$('#loading').hide(); 
				if(response == 'username')
				{
					$("#username").val('');
					swal("","Username already available",'warning');
				}
				else if(response == 'success') 
				{
					swal("","Self introduction updated successfully .",'success');
				}
			}
		});

     
    });
</script>

<script type="text/javascript">
	$(document).on("click","#personal_mission_statement",function(){
		var user_id 		= "<?php echo $edit['id']; ?>"
		var personal_mission 		= $("#personal_mission").val();
		var personal_description 	= $("#personal_description").val();
		var error=1;

		// alert(personal_description);
		// return false;

		if(personal_mission == '')
		{
			swal("","Please enter personal mission statemant",'warning');
			error=0;
			return false;
		}
		if(personal_description == '')
		{
			swal("","Please enter personal mission description",'warning');
			error=0;
			return false;
		}
		
		$('#loading').show();
		$.ajax({
			type: 'POST',
			url: "<?php echo base_url(); ?>admin/users/update_personal_mission_statement",
			data: {user_id:user_id,personal_mission:personal_mission,personal_description:personal_description},
			// dataType: 'json',       
			success: function(response)
			{ 
				response = response.trim();
				$('#loading').hide(); 
				if(response == 'success') 
				{
					swal("","Personal mission statemant updated successfully .",'success');
				}
				else
				{
					swal("","Something went wrong",'warning');
				}
			}
		});

     
    });
</script>

<script type="text/javascript">
	$(document).on("click","#personal_highlights",function(){
		var user_id 				= "<?php echo $edit['id']; ?>"
		var currently_working 		= $("#currently_working").val();
		var currently_studying 		= $("#currently_studying").val();
		var graduated_from 			= $("#graduated_from").val();
		var complete_highschool_at 	= $("#complete_highschool_at").val();
		var lives_in 				= $("#lives_in").val();
		var from 					= $("#from").val();
		var error=1;

		// alert(currently_working);
		// return false;

		if(currently_working == '')
		{
			swal("","Please enter your current company name",'warning');
			error=0;
			return false;
		}
		if(currently_studying == '')
		{
			swal("","Please enter your studying or not ",'warning');
			error=0;
			return false;
		}
		if(graduated_from == '')
		{
			swal("","Please enter where you graduated from ",'warning');
			error=0;
			return false;
		}
		if(complete_highschool_at == '')
		{
			swal("","Please enter your highschool name ",'warning');
			error=0;
			return false;
		}
		if(lives_in == '')
		{
			swal("","Please enter where you live ",'warning');
			error=0;
			return false;
		}
		if(from == '')
		{
			swal("","Please enter where are you from ",'warning');
			error=0;
			return false;
		}
		
		$('#loading').show();
		$.ajax({
			type: 'POST',
			url: "<?php echo base_url(); ?>admin/users/update_personal_highlights",
			data: {user_id:user_id,currently_working:currently_working,currently_studying:currently_studying,graduated_from:graduated_from,complete_highschool_at:complete_highschool_at,lives_in:lives_in,from:from},
			// dataType: 'json',       
			success: function(response)
			{ 
				response = response.trim();
				$('#loading').hide(); 
				if(response == 'success') 
				{
					swal("","Personal  highlights updated successfully .",'success');
				}
				else
				{
					swal("","Something went wrong",'warning');
				}
			}
		});

     
    });
</script>

<script type="text/javascript">
	$(document).on("click","#social_media",function(){
		var user_id 		= "<?php echo $edit['id']; ?>"
		var facebook 		= $("#facebook").val();
		var instagram 		= $("#instagram").val();
		var snapchat 		= $("#snapchat").val();
		var twitter 		= $("#twitter").val();
		var linkedIn 		= $("#linkedIn").val();
		var error=1;

		// alert(currently_working);
		// return false;

		if(facebook == '')
		{
			swal("","Please enter facebook url",'warning');
			error=0;
			return false;
		}
		if(instagram == '')
		{
			swal("","Please enter instagram url ",'warning');
			error=0;
			return false;
		}
		if(snapchat == '')
		{
			swal("","Please enter snapchat url ",'warning');
			error=0;
			return false;
		}
		if(twitter == '')
		{
			swal("","Please enter twitter url ",'warning');
			error=0;
			return false;
		}
		if(linkedIn == '')
		{
			swal("","Please enter linkedIn url ",'warning');
			error=0;
			return false;
		}
		
		$('#loading').show();
		$.ajax({
			type: 'POST',
			url: "<?php echo base_url(); ?>admin/users/update_social_media",
			data: {user_id:user_id,facebook:facebook,instagram:instagram,snapchat:snapchat,twitter:twitter,linkedIn:linkedIn},
			// dataType: 'json',       
			success: function(response)
			{ 
				response = response.trim();
				$('#loading').hide(); 
				if(response == 'success') 
				{
					swal("","Social profile data updated successfully .",'success');
				}
				else
				{
					swal("","Something went wrong",'warning');
				}
			}
		});

     
    });
</script>

<script type="text/javascript">
	$(document).on("click","#user_interest_update",function(){
		var user_id 		= "<?php echo $edit['id']; ?>"
		var user_interest 		= $("#user_interest").val();
		var error=1;

		// alert(user_interest);
		// return false;

		if(user_interest == '')
		{
			swal("","Please enter user interest .",'warning');
			error=0;
			return false;
		}
		
		$('#loading').show();
		$.ajax({
			type: 'POST',
			url: "<?php echo base_url(); ?>admin/users/update_interest",
			data: {user_id:user_id,user_interest:user_interest},
			// dataType: 'json',       
			success: function(response)
			{ 
				response = response.trim();
				$('#loading').hide(); 
				if(response == 'success') 
				{
					swal("","User interest data updated successfully .",'success');
				}
				else
				{
					swal("","Something went wrong",'warning');
				}
			}
		});

     
    });
</script>


<script type="text/javascript">
	$(document).on("click","#user_course_update",function(){
		var user_id 		= "<?php echo $edit['id']; ?>"
		var u_course 		= $("#user_course").val();
		var error=1;

		// alert(user_course);
		// return false;

		if(u_course == '')
		{
			swal("","Please enter user interest .",'warning');
			error=0;
			return false;
		}
		
		$('#loading').show();
		$.ajax({
			type: 'POST',
			url: "<?php echo base_url(); ?>admin/users/update_course",
			data: {user_id:user_id,u_course:u_course},
			// dataType: 'json',       
			success: function(response)
			{ 
				response = response.trim();
				$('#loading').hide(); 
				if(response == 'success') 
				{
					swal("","User course data updated successfully .",'success');
				}
				else
				{
					swal("","Something went wrongddd",'warning');
				}
			}
		});

     
    });
</script>

<script type="text/javascript">
	$(document).on("click","#user_language_update",function(){
		var user_id 		= "<?php echo $edit['id']; ?>"
		var u_languages 		= $("#user_languages").val();
		var error=1;

		// alert(u_languages);
		// return false;

		if(u_languages == '')
		{
			swal("","Please enter user languages .",'warning');
			error=0;
			return false;
		}
		
		$('#loading').show();
		$.ajax({
			type: 'POST',
			url: "<?php echo base_url(); ?>admin/users/update_languages",
			data: {user_id:user_id,u_languages:u_languages},
			// dataType: 'json',       
			success: function(response)
			{ 
				response = response.trim();
				$('#loading').hide(); 
				if(response == 'success') 
				{
					swal("","User languages data updated successfully .",'success');
				}
				else
				{
					swal("","Something went wrongddd",'warning');
				}
			}
		});

     
    });
</script>