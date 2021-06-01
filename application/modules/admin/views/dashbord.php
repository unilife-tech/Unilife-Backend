<div class="main_wrp_hd_dsh" >
<div class="main dashboard">
   <div class="center">
      <div class="container">
         <div class="row ">
            <div class="card">
               <div class="box_container full" style="margin-bottom: 0px;" >
                  <h2 style="color: #000; margin-top: -8px; margin-bottom: 5px;" >Total Summary</h2>
                  <div class="row card_main" style="margin-bottom: 0px;">
                     <div class="col-sm-3">
                        <a href="users">
                           <div class="card one">
                              <i class="fa fa-users"></i>
                              <div class="card-content">
                                 <p class="title">Total Users</p>
                                 <p class="count"><?php echo $users; ?></p>
                              </div>
                           </div>
                        </a>
                     </div>

                     <div class="col-sm-3">
                        <a href="users/deleted_users">
                           <div class="card two">
                              <i class="fa fa-users"></i>
                              <div class="card-content">
                                 <p class="title">Total Deleted Users</p>
                                 <p class="count"><?php echo  $delete_users; ?></p>
                              </div>
                           </div>
                        </a>
                     </div>

                     <!-- col-sm-3 -->
                     <div class="col-sm-3">
                        <a href="coupon">
                           <div class="card three">
                              <i class="fa fa-shopping-cart"></i>
                              <div class="card-content">
                                 <p class="title">Total Coupons</p>
                                 <p class="count"><?php echo  $offers; ?></p>
                              </div>
                           </div>
                        </a>
                     </div>
                     <!-- col-xs-2 -->
                     <div class="col-sm-3">
                        <a href="blog">
                           <div class="card four">
                              <i class="fa fa-building"></i>
                              <div class="card-content">
                                 <p class="title">Total Blogs</p>
                                 <p class="count"><?php echo  $blogs; ?></p>
                              </div>
                           </div>
                        </a>
                     </div>
                     <!-- col-xs-2 -->
                     <!-- col-xs-2 -->
                     <div class="col-sm-3">
                        <a href="brands">
                           <div class="card four">
                              <i class="fa fa-building"></i>
                              <div class="card-content">
                                 <p class="title">Total Brands</p>
                                 <p class="count"><?php echo  $brands; ?></p>
                              </div>
                           </div>
                        </a>
                     </div>
                     <!-- col-xs-2 -->
                     <div class="col-sm-3">
                        <a href="post">
                           <div class="card three">
                              <i class="fa fa-money"></i>
                              <div class="card-content">
                                 <p class="title">Total Posts</p>
                                 <p class="count"><?php echo  $posts; ?></p>
                              </div>
                           </div>
                        </a>
                     </div>
                     <!-- col-xs-2 -->
                     <div class="col-sm-3">
                        <a href="groups">
                           <div class="card two">
                              <i class="fa fa-money"></i>
                              <div class="card-content">
                                 <p class="title">Total Groups</p>
                                 <p class="count"><?php echo  $groups; ?></p>
                              </div>
                           </div>
                        </a>
                     </div>

                     <div class="col-sm-3">
                        <a href="university">
                           <div class="card one">
                              <i class="fa fa-money"></i>
                              <div class="card-content">
                                 <p class="title">Total School/Universities</p>
                                 <p class="count"><?php echo  $university_schools; ?></p>
                              </div>
                           </div>
                        </a>
                     </div>

                  </div>
                  <!--form_header-->
               </div>
            </div>

            <div class="row">
               <div class="col-lg-12">
                  <div class="card">
                     <div class="col-sm-12">
                        <div class="top_action">
                           <div class="">
                              <h2 style="color: #000;margin-top: 0px;margin-bottom: -3px;margin-left: 0px;" >Recent 05 redeem coupon</h2>
                              <h5 style="    margin-bottom: 15px;" >Friday 17th of July 2020</h5>
                           </div>
                           <!--col-xs-12-->
                        </div>
                        <!--top_action-->
                        <div class="table-responsive" style="color: black">
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


                        </div>
                        <!--table-responsive-->
                     </div>
                  </div>
               </div>
            </div>
            <!-- row -->
         </div>
         <!--box_container-->
      </div>
   </div>
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style type="text/css"> 
   .box_container { margin: 0 auto; max-width: 650px; width: 100%; padding: 25px; background: #fff; border-radius: 6px; margin-top: 10px; margin-bottom: 70px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); position: relative; display: inline-block; text-align: left !important; }
   .box_container.full { max-width: 100%; }
   .dashboard h2 { opacity: 0.7; text-transform: uppercase; font-size: 20px }
   .dashboard .card_main { margin-bottom: 30px }
   .dashboard .table { margin: 0px; font-size: 15px }
   .dashboard .table td:last-child { text-align: center; font-family: 'RobotoMedium'; }
   .dashboard .box_container { background: none; padding: 0px; box-shadow: none; }
   .dashboard .card { float: left; width: 100%; margin-top: 15px; padding: 25px 20px; border-radius: 6px; box-shadow: 0px 1px 12px rgba(0, 0, 0, 0.30); color: #fff; position: relative; overflow: hidden; font-size: 17px; border-bottom: 4px solid rgba(0, 0, 0, 0.25) }
   .dashboard .card .fa { position: absolute; right: -10px; bottom: -10px; font-size: 80px; opacity: 0.4;    color: #0f0f0f; }
   .dashboard .card.four .fa { bottom: -15px }
   .dashboard .card p.count { margin-bottom: 0px; font-family: 'RobotoMedium'; font-size: 28px; margin-top: 20px }
   .dashboard .card.one { background: #119BD2; background: -moz-linear-gradient(-45deg, #3bd1bf 0%, #119bd2 100%); background: -webkit-linear-gradient(-45deg, #3bd1bf 0%, #119bd2 100%); background: linear-gradient(135deg, #3bd1bf 0%, #119bd2 100%); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#3bd1bf', endColorstr='#119bd2', GradientType=1); }
   .dashboard .card.two { background: #ff875e; background: -moz-linear-gradient(-45deg, #ff875e 1%, #fc629d 100%); background: -webkit-linear-gradient(-45deg, #ff875e 1%, #fc629d 100%); background: linear-gradient(135deg, #ff875e 1%, #fc629d 100%); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff875e', endColorstr='#fc629d', GradientType=1); }
   .dashboard .card.three { background: #8363f9; background: -moz-linear-gradient(-45deg, #ee70e9 0%, #8363f9 100%); background: -webkit-linear-gradient(-45deg, #ee70e9 0%, #8363f9 100%); background: linear-gradient(135deg, #ee70e9 0%, #8363f9 100%); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ee70e9', endColorstr='#8363f9', GradientType=1); }
   .dashboard .card.four { background: #39ce86; background: -moz-linear-gradient(-45deg, #f7cd13 1%, #39ce86 100%); background: -webkit-linear-gradient(-45deg, #f7cd13 1%, #39ce86 100%); background: linear-gradient(135deg, #f7cd13 1%, #39ce86 100%); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f7cd13', endColorstr='#39ce86', GradientType=1); }

    .container {
    width: 100%;
    }
    img.shop_img {
    height: 50px;
    width: 50px;
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
