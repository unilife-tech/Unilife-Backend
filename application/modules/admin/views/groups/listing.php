<div class="col-sm-12 col-md-12 group_btns">
  <a target="_blank" href="<?php echo base_url("admin/groups/create") ?>"><button type="button" class=" btn btn-info btn-md" >Create Group </button></a>
  <a target="_blank" href="<?php echo base_url("admin/groups/csv_dwonload") ?>"><button type="button" class="btn btn-info btn-md" >Export </button></a>
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
         <th>Group name </th>
         <th>Group Creater Name</th>
         <th>Total Members</th>
         <th>Total Posts</th>
         <th>Creation Date</th>
         <th>Status</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody>
      <?php
         if (!empty($groups)) 
         {
          foreach($groups as $row){
          ?>
      <tr>
         <td><?php echo $row['id']?></td>
         <td><?php echo $row['group_name']?></td>
         <td><?php echo $row['username']?></td>
        <td><?php echo $row['count_member']?></td>
        <td><?php echo $row['posts_posted']?></td>
        <td style=""><?php echo $row['created_at']?></td>
        <td><?php echo $row['status']?></td>

        <td>
            <a target="_blank" style="width: 30px;" href="groups/edit/<?php echo $row['id'] ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">edit</i></a>

            <a style="width: 30px;" data-id="<?php echo $row['id']; ?>"  class="btn bg-light-green btn-circle waves-effect waves-circle waves-float group_delete " role="button"><i class="material-icons">delete</i></a>

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
  $(document).on('click',".group_delete",function(){
    var group_id = $(this).data('id');
    // alert(e_id);
    // return false;

    if(group_id != '')
    {
      swal({
            title: "",
            text: "Are you sure you want to delete this group !!",
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
              url: '<?php echo base_url('admin/groups/delete_group') ?>',
              data: {group_id:group_id},
              success: function(response){                               
               if(response)
               {
                  swal("","Group deleted successfully.",'success');
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
  }
</style>