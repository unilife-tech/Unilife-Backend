<a target="_blank" href="<?php echo base_url("admin/coupon/create") ?>"><button type="button" class=" btn btn-info btn-md" >Add Discount Coupon </button></a>

<a target="_blank" href="<?php  echo base_url("admin/coupon/category_csv_dwonload") ?>"><button type="button" class="btn btn-info btn-md" >Export </button></a>


<link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css' rel='stylesheet' media='screen'>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/dataTables.buttons.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.flash.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/jszip.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/pdfmake.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.html5.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.print.min.js'></script>

<?php 
    $upload_dir = "http://15.206.103.14/public/offer_imgs/";
 ?>
<table class="table table-bordered table-striped table-hover dataTable js-exportable">
   <thead>
      <tr>
         <th>Id</th>
         <th>Categories Name</th>
         <th>Brand name</th>
         <th>Image</th>
         <th>Start date</th>
         <th>Exp date</th>
         <th>Type</th>
         <th>Discount type</th>
         <th>Amount</th>
         <th>Slide show</th>
         <th>Status</th>
         <th width="">Action</th>
      </tr>
   </thead>
   <tbody>
      <?php
         if (!empty($offers)) 
         {
          foreach($offers as $row){
          ?>
      <tr>
         <td><?php echo $row['id']?></td>
         <td><?php echo $row['category_name']?></td>
         <td><?php echo $row['brand_name']?></td>
         <td><a target="_blank" href="<?php echo $row['image']?>">
                <img class="imag_pic" src="<?php echo $upload_dir.$row['image']?>">
              </a>
        </td>
        <td><?php echo $row['start_date']?></td>
        <td><?php echo $row['exp_date']?></td>
        <td><?php echo $row['type']?></td>
        <td><?php echo $row['discount_type']?></td>
        <td><?php echo $row['discount_percent']?></td>
        <td><?php echo $row['slider']?></td>
        <td><?php echo $row['status']?></td>

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
.coupon_delete
{
  /*margin-top: 10px;*/
}
</style>

<script type="text/javascript">
  $(document).on('click',".coupon_delete",function(){
    var cid = $(this).data('id');
    // alert(e_id);
    // return false;

    if(cid != '')
    {
      swal({
            title: "",
            text: "Are you sure you want to delete this coupon !!",
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
              url: '<?php echo base_url('admin/coupon/delete_coupon') ?>',
              data: {cid:cid},
              success: function(response){                               
               if(response)
               {
                swal("","Coupon deleted successfully.",'success');
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
