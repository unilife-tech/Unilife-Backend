<?php echo $form->messages();
    $college_name = $concentration = $degree = $club_society = $grade = $start_date = $end_date  = '';

    if (isset($edit)) {
        $college_name = $edit['college_name'];
        $concentration = $edit['concentration'];
        $degree = $edit['degree'];
        $club_society = $edit['club_society'];
        $grade = $edit['grade'];
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
                        <span>College name</span>
                        <input type="text" name="college_name" value="<?php echo $college_name ?>" placeholder="College name" id="college_name" class="form-control " required>
                    </div>

                    <div class="form-line">
                        <span>Concentration</span>
                        <input type="text" name="concentration" value="<?php echo $concentration ?>" placeholder="Concentration" id="concentration" class="form-control " required>
                    </div>

                    <div class="form-line">
                        <span>Degree</span>
                        <input type="text" name="degree" value="<?php echo $degree ?>" placeholder="Degree" id="degree" class="form-control " required>
                    </div>

                    <div class="form-line">
                        <span>Club / society</span>
                        <input type="text" name="club_society" value="<?php echo $club_society ?>" placeholder="Club / society" id="club_society" class="form-control " required>
                    </div>



                    <div class="form-line">
                        <span>Grade</span>
                        <input type="text" name="grade" value="<?php echo $grade ?>" placeholder="Grade" id="grade" class="form-control " required>
                    </div>

                    <div class="form-line">
                        <span>Start date</span>
                        <input type="text" name="start_date" value="<?php echo $start_date ?>" placeholder="Start date" id="start_date" class="form-control " required>
                    </div>

                    <div class="form-line">
                        <span>End date</span>
                        <input type="text" name="end_date" value="<?php echo $end_date ?>" placeholder="End date" id="end_date" class="form-control " required>
                    </div>


                    

                    <div class="col-sm-12 submitt_edu">
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
    minDate : new Date(),
    time: false
  });

      jQuery('#end_date').bootstrapMaterialDatePicker({
    format: 'YYYY/MM/DD',
    clearButton: true,
    weekStart: 1,
    minDate : new Date(),
    time: false
  });
</script>

<style type="text/css">

     .submitt_edu{
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

