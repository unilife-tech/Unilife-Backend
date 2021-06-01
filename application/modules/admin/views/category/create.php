<?php echo $form->messages();
    $name = $concentration = $active  = $image =  '';

    if (isset($edit)) {
        $name = $edit['name'];
        $image = $edit['image'];

        $active = $edit['status'] == 'active' ? 'checked' : '';
        $deactive = $edit['status'] == 'deactive' ? 'checked' : '';
        }else{

        $deactive = '';
        $active = 'checked';
        }

 ?>

<a href="<?php echo base_url("admin/application/category_listing") ?>"><button type="button" class="btn back_button btn-md" >Back to category listing </button></a>




<div class="row">

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $form->open(); ?>

                    <div class="form-line">
                        <span>Categories Name</span>
                        <input autocomplete="off" type="text" name="name" value="<?php echo $name ?>" placeholder="College name" id="name" class="categoryy_name " required>
                    </div>

                    <div class="form-line">
                        <span>Status</span>
                            <?php echo $form->bs3_radio('Active', 'status', 'active', array('required' => ''), $active); ?>
                            <?php echo $form->bs3_radio('Deactive', 'status', 'deactive', array('required' => ''), $deactive); ?>
                    </div>

                    <div class="form-line">
                        <span>Image</span>
                        <input type="file" name="image" class="category_image">

                        <?php $upload_dir = "http://15.206.103.14/public/admin/brand/"; ?>

                        <?php if (isset($edit)) { ?>
                            <img class="imag_pic" src="<?php echo $upload_dir.$image?>">
                        <?php } ?>
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


<style type="text/css">

    img.imag_pic {
    margin-top: 10px;
    width: 40%;
    }

    .submitt_edu{
    padding-left: 0px;
    }

    input.category_image {
    border: 1px solid #cdcdcd;
    padding: 4px;
    width: 100%;
    }

  

    .form-control:focus {
    box-shadow: none;
    }

    .form-line span{
    margin-top: 16px;
    display: block;
    margin-bottom: 11px;
    }

    .categoryy_name {
    border: none;
    box-shadow: none;
    border-bottom: 1px solid #cdcdcd;
    border-radius: 0;       width: 95%;
    }
    
</style>

