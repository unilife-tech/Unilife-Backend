<div class="col-sm-12 col-md-12 group_btns">
  <a target="_blank" href="<?php echo base_url("admin/university/create") ?>"><button type="button" class=" btn btn-info btn-md" > Add University/School  </button></a>
  <a target="_blank" href="<?php echo base_url("admin/university/csv_dwonload") ?>"><button type="button" class="btn btn-info btn-md" >Export </button></a>
</div>


<link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css' rel='stylesheet' media='screen'>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/dataTables.buttons.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.flash.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/jszip.min.js'></script>
<!-- <script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/pdfmake.min.js'></script> -->
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.html5.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.print.min.js'></script>

<?php 
    $upload_dir = "http://15.206.103.14/public/blog_imgs/";
 ?>
<table class="table table-bordered table-striped table-hover dataTable js-exportable">
   <thead>
      <tr>
         <th>Id</th>
         <th style="width: 20%">University/School </th>
         <th style="width: 15%">Dean Name</th>
         <th style="width: 10%">Total Student</th>
         <th style="width: 10%">Student Registered in App</th>
         <th style="width: 20%" >Domain</th>
         <th>Creation Date</th>
         <th>Status</th>
         <th style="width: 10%">Action</th>
      </tr>
   </thead>
   <tbody>
      <?php
         if (!empty($university_schools)) 
         {
          foreach($university_schools as $row){
          ?>
      <tr>
         <td><?php echo $row['id']?></td>
         <td><?php echo $row['name']?></td>
         <td><?php echo $row['dean_name']?></td>
        <td><?php echo $row['no_of_students']?></td>
        <td><?php echo $row['student_count']?></td>
        <td><?php echo $row['domain']?></td>
        <td style=""><?php echo $row['created_at']?></td>
        <td><?php echo $row['status']?></td>

        <td>
            <a target="_blank" style="width: 30px;" href="university/edit/<?php echo $row['id'] ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">edit</i></a>

            <a style="width: 30px;" data-id="<?php echo $row['id']; ?>"  class="btn bg-light-green btn-circle waves-effect waves-circle waves-float delete_university " role="button"><i class="material-icons">delete</i></a>

        </td>
      </tr>
      <?php } } ?>
   </tbody>
</table>





<script type="text/javascript">
  $(function () {
    $('.js-basic-example').DataTable({
        responsive: true
    });

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        order:[[0,"asc"]],
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    });
});
</script>

<script type="text/javascript">
  $(document).on('click',".delete_university",function(){
    var u_id = $(this).data('id');
    // alert(e_id);
    // return false;

    if(u_id != '')
    {
      swal({
            title: "",
            text: "Are you sure you want to delete this university !!",
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
              url: '<?php echo base_url('admin/university/delete_university') ?>',
              data: {u_id:u_id},
              success: function(response){                               
               if(response)
               {
                  swal("","University deleted successfully.",'success');
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

<style type="text/css">
  .group_btns{
    position: absolute;
    z-index: 1;
    width: 80%;
  }
</style>