<?php echo $form->messages();
    $certificate_name = $offered_date = $offered_by = $duration = $myimage  = '';

    if (isset($edit)) {
        $certificate_name = $edit['certificate_name'];
        $offered_by = $edit['offered_by'];
        $offered_date = $edit['offered_date'];
        $duration = $edit['duration'];
    }
 ?>




<div class="row">

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>

                    <div class="box-body">
                    <div class="form-line">
                        <span>Certificate name</span>
                        <input autocomplete="off" type="text" name="certificate_name" value="<?php echo $certificate_name ?>" placeholder="Enter Certificate Name" id="certificate_name" class="form-control " required>
                    </div>

                    <div class="form-line">
                        <span>Offered by</span>
                        <input  autocomplete="off" type="text" name="offered_by" value="<?php echo $offered_by ?>" placeholder="Enter Offered By" id="offered_by" class="form-control " required>
                    </div>

                    <div class="form-line">
                        <span>Offered date</span>
                        <input  autocomplete="off" type="text" name="offered_date" value="<?php echo $offered_date ?>" placeholder="Enter Offered Date" id="offered_date" class="form-control " required>
                    </div>

                    <div class="form-line">
                        <span>Duration</span>
                        <input  autocomplete="off" type="text" name="duration" value="<?php echo $duration ?>" placeholder="Enter Duration" id="duration" class="form-control " required>
                    </div>
                    </div>
                    

                    <!-- <div class="col-sm-12"> -->
                        <br>
                        <?php echo $form->bs3_submit(); ?>
                        <?php echo $form->close(); ?>
                    <!-- </div> -->
                    
            </div>
        </div>
    </div>
    
</div>


<script type="text/javascript">
   jQuery('#offered_date').bootstrapMaterialDatePicker({
    format: 'YYYY/MM/DD',
    clearButton: true,
    weekStart: 1,
    minDate : new Date(),
    time: false
  });
</script>

<style type="text/css">

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
    border-radius: 0;    }

</style>

