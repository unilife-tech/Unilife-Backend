
    
<!-- Top Bar -->
<nav class="navbar">
   <div class="container-fluid">
      <div class="click_menu_btn">
         <i class="material-icons menu_clas">menu</i>
         <i class="material-icons close_clas">close</i>
      </div>
      <div class="navbar-header">
         <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
         <a href="javascript:void(0);" class="bars"></a>
         <!-- <img style="margin-left: 10px;" src="<?php echo base_url(); ?>assets/admin/images/logo.png" height="50" width="200" > -->
         <a class="navbar-brand " href="">
         <?php echo $site_name; ?>
         </a>
      </div>
      <div class="collapse navbar-collapse" id="navbar-collapse">
         <ul class="nav navbar-nav navbar-right">
            <!-- Call Search -->
            <li class="dropdown Secondd">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <img class="img_admin_icon" src="<?php echo base_url('assets/admin/usersdata/').@$admin_logo[0]['logo']; ?>">
               <span class="user_name_text hidden-xs"><?php echo $user->first_name ; ?> <?php echo $user->last_name ; ?></span>
               </a>
               <ul class="dropdown-menu menu_admin_right">
                  <li class="header">
                     <p><?php echo $user->first_name ; ?> <?php echo $user->last_name ; ?> </p>
                  </li>
                  <li class="footer">
                     <div class="pull-left leftaln">
                        <a href="panel/account" class="btn btn-info waves-effect t">Account</a>
                     </div>
                     <div class="pull-right rightaln">
                        <a href="panel/logout" class="btn btn-danger waves-effect t">Sign out</a>
                     </div>
                  </li>
               </ul>
            </li>
            <li class="dropdown firsst">
               <a href="javascript:void(0);" onclick="toggleFullScreen(document.body)" class="ful_screen_optn dropdown-toggle" data-toggle="dropdown">
               <i class="material-icons">settings_overscan</i>
               </a>
            </li>
         </ul>
      </div>
   </div>
</nav>
<!-- #Top Bar -->





<script type="text/javascript">
  $(".click_menu_btn").click(function(){
  //alert("The paragraph was clicked.");
  });

  $(".click_menu_btn").click(function(){
      $(".sidebar_left").toggleClass("slider_menu_hide");
  });

  $(".click_menu_btn").click(function(){
      $(".page_inner_wrapper").toggleClass("page_inner_wrapper_full");
  });

  $(".click_menu_btn").click(function(){
      $(".click_menu_btn").toggleClass("click_menu_btn_close");
  });
</script>

<style type="text/css">
  #loading {
   width: 100%;
   height: 100%;
   top: 0;
   left: 0;
   position: fixed;
   display: block;
   opacity: 0.7;
   background-color: #fff;
   z-index: 99;
   text-align: center;
  }
  a.navbar-brand{
  font-size: 30px;
  margin: 10px;
  float: right;
  margin-left: 0px !important;
  margin-bottom: 0px;
  margin-right: 0px;
  font-weight: bold;
  margin-top: 0px;
  }
</style>



<div id="loading" style="display: none">
  <img id="loading-image" src="<?php echo base_url('assets/admin/images/') ?>loaders.gif" alt="Loading..." />
</div>