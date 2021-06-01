<?php echo $form->messages();
    $company_name = $emp_type = $industry = $designation = $location = $start_date = $end_date  = '';

    if (isset($edit)) {
        $company_name = $edit['company_name'];
        $emp_type = $edit['emp_type'];
        $industry = $edit['industry'];
        $designation = $edit['designation'];

        $location = $edit['location'];
        $start_date = $edit['start_date'];
        $end_date = $edit['end_date'];
    }
 ?>




<div class="row">

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>

                    <div class="form-line">
                        <span>Company name</span>
                        <input autocomplete="off" type="text" name="company_name" value="<?php echo $company_name ?>" placeholder="Enter Company name" id="company_name" class="form-control " required>
                    </div>

                    <div class="form-line">
                        <span>Employee type</span>
                        <input autocomplete="off"  type="text" name="emp_type" value="<?php echo $emp_type ?>" placeholder="Enter Employee type" id="emp_type" class="form-control " required>
                    </div>

                    <div class="form-line">
                        <span>Industry</span>
                        <input  autocomplete="off" type="text" name="industry" value="<?php echo $industry ?>" placeholder="Enter Industry" id="industry" class="form-control " required>
                    </div>

                    <div class="form-line">
                        <span>Designation</span>
                        <input autocomplete="off"  type="text" name="designation" value="<?php echo $designation ?>" placeholder="Enter Designation" id="designation" class="form-control " required>
                    </div>



                    <div class="form-line">
                        <span>Location</span>
                        <input  autocomplete="off" type="text" name="location" value="<?php echo $location ?>" placeholder="Location" id="location" class="form-control " required>
                    </div>

                    <div class="form-line">
                        <span>Start date</span>
                        <input autocomplete="off"  type="text" name="start_date" value="<?php echo $start_date ?>" placeholder="Enter Start date" id="start_date" class="form-control " required>
                    </div>

                    <div class="form-line">
                        <span>End date</span>
                        <input  autocomplete="off" type="text" name="end_date" value="<?php echo $end_date ?>" placeholder="Enter End date" id="end_date" class="form-control " required>
                    </div>


                    

                    <div class="col-sm-12 submitt_exp">
                        <br>
                        <?php echo $form->bs3_submit(); ?>
                        <?php echo $form->close(); ?>
                    </div>
                    
            </div>
        </div>
    </div>
    
</div>


<script type="text/javascript">
   jQuery('#start_date').bootstrapMaterialDatePicker({
    format: 'YYYY/MM/DD',
    clearButton: true,
    weekStart: 1,
    // minDate : new Date(),
    time: false
  });

      jQuery('#end_date').bootstrapMaterialDatePicker({
    format: 'YYYY/MM/DD',
    clearButton: true,
    weekStart: 1,
    // minDate : new Date(),
    time: false
  });


</script>

<style type="text/css">
    .submitt_exp{
        padding-left: 0px;
    }
    .form-line {
    width: 50%;
    float: left;
    }


    .form-control:focus {
    box-shadow: none;
    }

    .form-line span{
    margin-top: 16px;
    display: block;
    margin-left: 11px;
    }
    .form-line span{
    margin-top: 16px;
    display: block;
    }
    .form-line input {
    border: none;
    box-shadow: none;
    border-bottom: 1px solid #cdcdcd;
    border-radius: 0;       width: 95%;
    }

</style>

