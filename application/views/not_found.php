
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <a class="navbar-brand" href="#"> 
   <img class="logo" src="http://chickfarm.in/assets/admin/images/header-logo.png" height="40"> 
   <span class="logo_text" >
   Chickfarm
   </span>
   </a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbar1">
      <ul class="navbar-nav ml-auto">
         <li class="nav-item active">
            <a class="nav-link">Welcome to Chickfarm </a>
         </li>
      </ul>
   </div>
</nav>
<div class="container" style="text-align: center;margin-top: 10%;margin-bottom: 0%;">
   <br>

   <p class="ops_page" >Oops, the page you're looking for doesn't exist. <br>
The Link is expired kindly request again for new Password.</p>
   <a class="back_to_login" href="<?php echo base_url('/') ?>">Back to login</a>
</div>

<!-- .//container -->


<style type="text/css">
  p{
        font-size: 16px;

  }
</style>


<!-- _________________________CSS_02_Oct_________________ -->

<style>


.navbar-brand{

}

.logo_text{
font-weight: 600;
font-size: 26px;
letter-spacing:1.5px;
}

.ops_page {
    font-size: 20px;
    color: #979797;
}

.back_to_login {
    background: linear-gradient(-131deg, #2b98e1 0%, #186aa1 100%) !important;
    display: inline-block;
    color: #fff;
    padding: 12px 32px;
    margin-top: 20px;
    border-radius: 3px;
    font-size: 18px;
    font-weight: 500;
}

.back_to_login:hover{
  background:linear-gradient(-131deg, #1a7dc0 0%, #0a4b76 100%) !important;
  cursor: pointer;
  color: #fff;
  text-decoration: none;
}

.bg-dark {
    background: linear-gradient(-131deg, #2b98e1 0%, #186aa1 100%) !important;
}

.bg-secondary {
    background-color: #063351!important;
    margin-bottom: 0px !important;
}

</style>



<script type="text/javascript">
  setTimeout(function(){
  window.location = "<?php echo base_url() ?>";
}, 10000);

</script>