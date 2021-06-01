<!-- <link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css' rel='stylesheet' media='screen'> -->
<!-- <script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script> -->
<!-- <script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/dataTables.buttons.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.flash.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/jszip.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/pdfmake.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.html5.min.js'></script> -->
<!-- <script src='<?php //echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.print.min.js'></script> -->


<div class="sraech">
   <label for="usr">Search:</label>
   <input type="text" class="" id="search_val" style="padding: 3px">
   <!-- <button class="btn btn-info" id="search_btn">Search</button> -->
</div>
<table class="table table-bordered table-striped table-hover dataTable js-exportable">
   <thead>
      <tr>
         <th>Id</th>
         <th>Complain By</th>
         <th>Complain Against</th>
         <th>Type</th>
         <th>Reason</th>
         <th>See Post</th>
         <th>Created at</th>
         <th style="width: 15%;">Action</th>
      </tr>
   </thead>
   <tbody id="table_body">
      <?php
        // echo "<pre>";
        //  print_r($users_data);
           if (!empty($users_data)){ foreach($users_data as $row) {?>
      <tr>
         <td><?php echo $row['id']?></td>
         <td><?php echo $row['username']?></td>
         <td><?php echo $row['againt_complain']?></td>
         <td><?php echo $row['type']?></td>
         <td><?php echo $row['reason']?></td>
         <td><a target="_blank" style="width: 30px;" href = "post/edit/<?php echo $row['report_post_id']?>"  style="width: 30px;" class="see_post" role="button">See Post</a> </td>
         <td><?php echo $row['created_at']?></td>
         <td>

            <a  style="width: 30px;" data-id = "<?php echo $row['id'] ?>"  style="width: 30px;" class="delete_report btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">delete</i></a>

            <a  style="width: 30px;" data-id = "<?php echo $row['report_post_id']?>,<?php echo $row['id'] ?>"  style="width: 30px;" class="delete_user_post btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">auto_delete</i></a>

         </td>
      </tr>
      <?php } } else { ?>
      <tr class="text-center text-danger">
         <td colspan="8" >No Record Found</td>
      </tr>
      <?php } ?>
   </tbody>
</table>
<div id="pagination"><?php echo @$pagination; ?></div>
<div id="pagination2" style="display:none"></div>
<div id="search_pagination" style="display:none"></div>

<style type="text/css">
  .sweet-alert p {
  text-transform: capitalize;
  }
  a.see_post {
  text-decoration: none;
  }
</style>

<!-- <script type="text/javascript">
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
</script>  -->

<script type="text/javascript">
  $(document).on("keyup","#search_val",function(){      
    var serach=$(this).val(); 
    // alert(serach);
    // return false; 
    $('#loading').show();     
      $.ajax({
           type: 'POST',
           url: "<?php echo base_url("admin/report/post"); ?>",
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
       url: "<?php echo base_url("admin/report/post") ?>",
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
           trHTML+='<td>'+v.againt_complain+'</td>';
           trHTML+='<td>'+v.type+'</td>';
           trHTML+='<td>'+v.reason+'</td>';
           trHTML+='<td><a target="_blank"  style="width: 30px;" href = "post/edit/'+v.report_post_id+'"  style="width: 30px;" class="see_post" role="button">See post</a>   </td>';
           // trHTML+='<td>'+v.university_school+'</td>';
           // trHTML+='<td>'+v.address+'</td>';
           // trHTML+='<td>'+v.post_count+'</td>';
           // trHTML+='<td><img class="img_sa" width="100px" height="100px" src="<?php //echo base_url('assets/admin/products/') ?>'+v.product_image+' "></td>';
           // trHTML+='<td>'+v.country_name+'</td>';
           trHTML+='<td>'+v.created_at+'</td>'; 

       
          trHTML+='<td>   <a  style="width: 30px;" data-id = "'+v.id+'"  style="width: 30px;" class="delete_report btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">delete</i></a>            <a  style="width: 30px;" data-id = "'+v.report_post_id+','+v.id+',"  style="width: 30px;" class="delete_user_post btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">auto_delete</i></a>            </td>';     
          
      trHTML+='</tr>';                                
      });  
      return trHTML;    
     }
    }
</script>





<script type="text/javascript">
  $(document).on('click',".delete_user_post",function(){
    var post_id = $(this).data('id').split(",");
    var p_id = post_id[0];
    var r_id = post_id[1];

    // alert(post_id[0]);
    // alert(id);
    // return false;

    if(p_id != '')
    {
      swal({
            title: "",
            text: "Are you sure you want to delete this post (" + post_id[0] + ") !!" ,
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
              url: '<?php echo base_url('admin/report/delete_post') ?>',
              data: {p_id:p_id,r_id:r_id},
              success: function(response){                               
               if(response)
               {
                swal(""," User post deleted successfully. ",'success');
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
  $(document).on('click',".delete_report",function(){
    var report_id = $(this).data('id');

    // alert(report_id);
    // return false;

    if(report_id != '')
    {
      swal({
            title: "",
            text: "Are you sure you want to delete this report !!" ,
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
              url: '<?php echo base_url('admin/report/delete_report') ?>',
              data: {report_id,report_id},
              success: function(response){                               
                if(response)
                {
                  swal(""," Report data deleted successfully. ",'success');
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
