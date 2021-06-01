<link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css' rel='stylesheet' media='screen'>
<!-- <script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script> -->
<!-- <script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/dataTables.buttons.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.flash.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/jszip.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/pdfmake.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.html5.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.print.min.js'></script> -->

<a target="_blank" href="<?php echo base_url("admin/users/create") ?>"><button type="button" class="btn btn-info btn-md" >Add User</button></a>
<a target="_blank" href="<?php echo base_url("admin/users/csv_dwonload") ?>"><button type="button" class="btn btn-info btn-md" >Export </button></a>

<div class="sraech">
   <label for="usr">Search:</label>
   <input type="text" class="" id="search_val" style="padding: 3px">
   <!-- <button class="btn btn-info" id="search_btn">Search</button> -->
</div>
<table class="table table-bordered table-striped table-hover dataTable js-exportable">
   <thead>
      <tr>
         <th>Id</th>
         <th>Name</th>
         <th style="width: 20%">Email</th>
         <th>User type</th>
         <th>University/School</th>
         <th>Total Post</th>
         <th style="width: 10%;">Date</th>
         <th style="width: 15%;">Action</th>
      </tr>
   </thead>
   <tbody id="table_body">
      <?php
         //print_r($list);
           if (!empty($users_data)){ foreach($users_data as $row) {?>
      <tr>
         <td><?php echo $row['id']?></td>
         <td><?php echo $row['username']?></td>
         <td><?php echo $row['university_school_email']?></td>
         <td><?php echo $row['user_type']?></td>
         <td><?php echo $row['university_school']?></td>
         <td><?php echo $row['post_count']?></td>
         <td><?php echo $row['created_at'];?></td>
         <td>
            <!-- <a style="width: 30px;" href="users/order_history/<?php echo $row['id'] ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">remove_red_eye</i></a> -->

            <a target="_blank" style="width: 30px;" href="users/edit/<?php echo $row['id'] ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">edit</i></a>

            <a target="_blank" style="width: 30px;" href="users/user_edit/<?php echo $row['id'] ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">eco</i></a>

            <a target="_blank" style="width: 30px;" href="users/show_friends/<?php echo $row['id'] ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">group_add</i></a>

            <a target="_blank" style="width: 30px;" href="users/post/<?php echo $row['id'] ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">post_add</i></a>

            <a data-id = "<?php echo $row['id'] ?>" target="_blank" style="width: 30px;" class="delete_post btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">delete</i></a>

         </td>
      </tr>
      <?php } } else { ?>
      <tr class="text-center text-danger">
         <td colspan="5" >No Record Found</td>
      </tr>
      <?php } ?>
   </tbody>
</table>
<div id="pagination"><?php echo @$pagination; ?></div>
<div id="pagination2" style="display:none"></div>
<div id="search_pagination" style="display:none"></div>

<style type="text/css">
  .img_sa{
    width: 100px;
    height: 100px;
  }
</style>
<script type="text/javascript">
  $(function () {    
    $('.js-exportable').DataTable({
        "searching": false,   // Search Box will Be Disabled
        // "ordering": false,    // Ordering (Sorting on Each Column)will Be Disabled
        // "info": true,         // Will show "1 to n of n entries" Text at bottom
        // "lengthChange": false // Will Disabled Record number per page
        dom: 'Bfrtip',
        responsive: true,
        "paging":   false,         
         "info":     false,
        "order": [[ 0, "desc" ]]       
    });
  });
</script> 

<script type="text/javascript">
    $(document).on("keyup","#search_val",function(){      
    var serach=$(this).val(); 
    // alert(serach);
    // return false; 
    $('#loading').show();     
      $.ajax({
           type: 'POST',
           url: "<?php echo base_url("admin/users/index"); ?>",
           data: {serach:serach,pagno:'0',ajax:'serach'},   
           dataType: 'json',           
           success: function(response)
           {            
              // alert(response);
              $('#loading').hide();
              var tabledata=response.result; 
              if(tabledata=='')
              {
                $('#table_body').html("<tr><td colspan='11'>No record found</td></tr>");
              }else{
                var trHTML= creatTable(tabledata);              
                $('#table_body').html(trHTML); 
                if(serach=='')
                {
                  $("#search_pagination").hide(); 
                  $("#pagination").show();
                  $("#pagination2").hide();
                  $('#pagination').html(response.pagination);
                }else{
                  $("#search_pagination").show(); 
                  $("#pagination").hide();
                  $("#pagination2").hide();
                  $('#search_pagination').html(response.pagination);                  
                }
              }             
          }
      });      
  });

</script>
<script type="text/javascript">
  $('#pagination').on('click','a',function(e){
    e.preventDefault();        
    var ajax="call";
    var pageno = $(this).attr('data-ci-pagination-page');   
    if (typeof pageno !== 'undefined'){       
       loadPagination(pageno,ajax);      
    }else{
      swal("","You are already on pageno 1",'warning');
    }    
  });

  $('#pagination2').on('click','a',function(e){
      e.preventDefault();      
      var ajax="call";
      var pageno = $(this).attr('data-ci-pagination-page');  
       if (typeof pageno !== 'undefined')
      {       
       loadPagination(pageno,ajax);
      }else{
        swal("","You are already on pageno 1",'warning');
      }      
       
    });
  $('#search_pagination').on('click','a',function(e){
      e.preventDefault();
      var serach=$("#search_val").val();
      // alert("serach pat");
      var ajax="serach";
      var pageno = $(this).attr('data-ci-pagination-page');    
      if (typeof pageno !== 'undefined')
      {       
       loadPagination(pageno,ajax,serach);
      }else{
        swal("","You are already on pageno 1",'warning');
      }
       
    });

  function loadPagination(pagno,ajax,serach=''){
  // if(pagno==1)
  // {
  //   pagno=0;
  // }      
    $('#loading').show();
     $.ajax({        
       url: "<?php echo base_url("admin/users/index") ?>",
        type: 'post',
        data:{pagno:pagno,ajax:ajax,serach:serach},
       dataType: 'json',       
       success: function(response){  
       $('#loading').hide(); 
       // alert(response);       
        //var response = $.parseJSON(response);         
        if(serach=='')
        {
          $("#pagination").hide();
          $("#pagination2").show();                   
          $('#pagination2').html(response.pagination);            
        }else {
          $("#pagination").hide();
          $("#pagination2").hide();                   
          $("#search_pagination").show();                   
          $('#search_pagination').html(response.pagination);
        }
           var tabledata=response.result;
            // alert(tabledata);
            var trHTML= creatTable(tabledata);              
          $('#table_body').html(trHTML);            
       }
     });
   }
</script>
<script type="text/javascript">
     function creatTable(tabledata) {
      if(tabledata!=''){
        var trHTML='';
       
      $.each(tabledata, function( k, v ) {   
           trHTML+='<tr><td>'+v.id+'</td>';
           // full_name=v.first_name+' '+v.last_name;
           trHTML+='<td>'+v.username+'</td>';
           trHTML+='<td>'+v.university_school_email+'</td>';
           trHTML+='<td>'+v.user_type+'</td>';
           trHTML+='<td>'+v.university_school+'</td>';
           // trHTML+='<td>'+v.address+'</td>';
           trHTML+='<td>'+v.post_count+'</td>';
           // trHTML+='<td><img class="img_sa" width="100px" height="100px" src="<?php //echo base_url('assets/admin/products/') ?>'+v.product_image+' "></td>';
           // trHTML+='<td>'+v.country_name+'</td>';
           trHTML+='<td>'+v.created_at+'</td>'; 

       
          trHTML+='<td> <a  target="_blank" style="width: 30px;"  href="<?php echo base_url();?>admin/users/edit/'+v.id+'" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float" role="button"><i class="material-icons">edit</i></a><a  target="_blank" style="width: 30px;"  href="<?php echo base_url();?>admin/users/user_edit/'+v.id+'" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float" role="button"><i class="material-icons">eco</i></a><a  target="_blank" style="width: 30px;"  href="<?php echo base_url();?>admin/users/show_friends/'+v.id+'" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float" role="button"><i class="material-icons">group_add</i></a><a target="_blank" style="width: 30px;" href="users/post/'+v.id+'" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">post_add</i></a><a   data-id = "'+v.id+'" target="_blank" style="width: 30px;" class="delete_post btn bg-light-green btn-circle waves-effect waves-circle waves-float" role="button"><i class="material-icons">delete</i></a></td>';  

                      

   
          
      trHTML+='</tr>';                                
      });  
      return trHTML;    
     }
    }
</script>


<script type="text/javascript">
  $(document).on('click',".delete_post",function(){
    var u_id = $(this).data('id');
    // alert(u_id);
    // return false;

    if(u_id != '')
    {
      swal({
            title: "",
            text: "Are you sure you want to delete this user !!",
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
              url: '<?php echo base_url('admin/users/delete_user') ?>',
              data: {u_id:u_id},
              success: function(response){                               
               if(response)
               {
                swal("","User deleted successfully. ",'success');
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