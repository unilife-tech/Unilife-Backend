<link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css' rel='stylesheet' media='screen'>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/dataTables.buttons.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.flash.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/jszip.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/pdfmake.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.html5.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.print.min.js'></script>


<table class="table table-bordered table-striped table-hover dataTable js-exportable">
   <thead>
      <tr>
         <th>Id</th>
         <th>User name</th>
         <th>Coupon Revealed Code</th>
         <th>Store Name</th>
         <th>Discount Type</th>
         <th>Discount Amount</th>
         <th>Redeem Date</th>
         <th>Type</th>
         <th width="">Action</th>
      </tr>
   </thead>
   <tbody>
      <?php
         if (!empty($coupon)) 
         {
          foreach($coupon as $row){
          ?>
      <tr>
         <td><?php echo $row['id']?></td>
         <td><?php echo $row['username']?></td>
         <td><?php echo $row['discount_code']?></td>
        <td><?php echo $row['brand_name']?></td>
        <td><?php echo $row['discount_type']?></td>
        <td><?php echo $row['discount_amount']?></td>
        <td><?php echo $row['created_at']?></td>
        <td><?php echo $row['type']?></td>

        <td>
            <a target="_blank" style="width: 30px;" href="coupon/edit/<?php echo $row['id'] ?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button"><i class="material-icons">edit</i></a>

            <a style="width: 30px;" data-id="<?php echo $row['id']; ?>"  class="btn bg-light-green btn-circle waves-effect waves-circle waves-float coupon_delete " role="button"><i class="material-icons">delete</i></a>

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
        order:[[0,"DESC"]],
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script>

<style type="text/css"> 
img.imag_pic {
     width: 40px; 
    height: 40px;
}
.back_buttton {
  position: absolute;
    z-index: 1;
}

</style>

<script type="text/javascript">
  $(document).on('click',".coupon_delete",function(){
    var r_id = $(this).data('id');
    // alert(e_id);
    // return false;

    if(r_id != '')
    {
      swal({
            title: "",
            text: "Are you sure you want to delete this redeem coupon !!",
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
              url: '<?php echo base_url('admin/coupon/delete_redeem_coupon') ?>',
              data: {r_id:r_id},
              success: function(response){                               
               if(response)
               {
                swal("","Redeem coupon deleted successfully.",'success');
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
