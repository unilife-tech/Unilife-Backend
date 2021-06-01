

<div class="col-md-12" style=" margin-bottom: 0px;  ">
  <a href="<?php echo base_url('') ?>admin/social_media_post/create" class="back_button">Add social media post</a>
</div>







<link href='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.css' rel='stylesheet' media='screen'>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/jquery.dataTables.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/dataTables.bootstrap.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/dataTables.buttons.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.flash.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/jszip.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/pdfmake.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.html5.min.js'></script>
<script src='<?php echo base_url(); ?>assets/grocery_crud/themes/datatables/jquery-datatable/extensions/buttons.print.min.js'></script>
<div class="form-group">
</div>
<table class="table table-bordered table-striped table-hover dataTable js-exportable">
<thead>
    <tr>
        <th>id</th>
        <th>Category name</th>
        <th style="    width: 30%;">Post</th>
        <th>Type</th>
        <th>Status</th>
        <th>Created date</th>
        <th>Actions</th>
    </tr>
</thead>

    <tbody>
    <?php 
    if (!empty($data)) {
    foreach ($data as $key => $value) { ?>

    <tr>
        <td><?php echo $value['id']?></td>
        <td><?php echo $value['category_id']?></td>
        <td style=""><?php echo $value['post']?></td>
        <td><?php echo $value['type']?></td>
        <td><?php echo $value['status']?></td>
        <td><?php echo $value['created_date']?></td>

      
        <td class="actions">
          <a href="<?php echo base_url();?>admin/social_media_post/edit/<?php echo $value['id']?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button">
            <i class="material-icons">edit</i>
          </a>
          <a data-id = "<?php echo $value['id']?>" class="delete_social_post btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button">
            <i class="material-icons">delete</i>
          </a>
          <!-- <a href="<?php echo base_url();?>admin/city/edit/<?php echo $value['id']?>" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float " role="button">
            <i class="material-icons">remove_red_eye</i>
          </a> -->

        </td>
    </tr>

    <?php } } ?>
    </tbody>

</table>


<script type="text/javascript">
    $(function () {
        $('.js-basic-example').DataTable({
            responsive: true,
            "order": [[ 0, "desc" ]],
        });

        //Exportable table
        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            "order": [[ 0, "desc" ]],
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>


<style type="text/css">
    img#img-upload {
    height: 100px;
    width: 100px;
    }
    a.btn.bg-light-green.btn-circle.waves-effect.waves-circle.waves-float {
    width: 30px;
    }
</style>



<script type="text/javascript">
  $(document).on('click',".delete_social_post",function(){
    var p_id=$(this).data('id');
    if(p_id!='')
    {
      swal({
            title: "",
            text: "Are you sure you want to delete this post!!",
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
              url: '<?php echo base_url('admin/social_media_post/detete_post') ?>',
              data: {p_id:p_id},
              success: function(response){                               
               if(response)
               {
                swal("","Post Delete successfully",'success');
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
