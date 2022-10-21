<?php  
   if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
        $url = "https://";   
   else  
        $url = "http://";   
   // Append the host(domain name, ip) to the URL.   
   $url.= $_SERVER['HTTP_HOST'];   
   
   // Append the requested resource location to the URL   
   $url.= $_SERVER['REQUEST_URI'];    
     
   ?>  
<!-- Main left sidebar menu -->
<div id="left-sidebar" class="sidebar light_active">
   <!--  <a href="javascript:void(0);" class="menu_toggle"><i class="fa fa-angle-left"></i></a> -->
   <div class="logo">
      <a href="<?= base_url('/dashboard');?>">
      <img src="<?= base_url('assets/images/logo/logo-admin.png');?>" alt="logo">
      </a>
   </div>
   <div class="navbar-brand">  
      <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i class="fa fa-close"></i></button>
   </div>
   <div class="sidebar-scroll">
      <nav id="left-sidebar-nav" class="sidebar-nav">
         <ul id="main-menu" class="metismenu animation-li-delay">
            <?php if(isset($_SESSION['user_login'])) { 
               if($_SESSION['user_login']['Role'] == '2') { ?>
            <li>
               <div class="clearfix"></div>
            </li>
            <li class="<?php if(base_url('/dashboard') == $url){echo 'active';} ?>"><a href="<?= base_url('/dashboard');?>"><i class="fa fa-unlink"></i> <span>Shorten URL Now</span></a></li>
            <!-- <li>
               <a href="#Doctors" class="has-arrow"><i class="fa fa-user-md"></i><span>Doctors</span></a>
               <ul>
                   <li><a href="dr-all.html">All Doctors</a></li>
                   <li><a href="dr-add.html">Add Doctors</a></li>
                   <li><a href="dr-profile.html">Doctors Profile</a></li>
                   <li><a href="dr-schedule.html">Doctors Schedule</a></li>
               </ul>
               </li> -->
            <li class="<?php if(base_url('/statistics') == $url){echo 'active';} ?>"><a href="<?= base_url('/statistics');?>"><i class="fa fa-bar-chart"></i> <span>Statistics</span></a></li>
            <li class="<?php if(base_url('/manage-links') == $url){echo 'active';} ?>"><a href="<?= base_url('/manage-links');?>"><i class="fa fa-link"></i> <span>Manage Links</span></a></li>
            <li class="<?php if(base_url('/withdraw') == $url){echo 'active';} ?>"><a href="<?= base_url('/withdraw');?>"><i class="fa fa-dollar"></i><span>Withdraw</span></a></li>
            <li class="<?php if(base_url('/referal') == $url){echo 'active';} ?>"><a href="<?= base_url('/referal');?>"><i class="fa fa-user-plus"></i><span>Referal</span></a></li>
            <li class="<?php if(base_url('/invoices') == $url){echo 'active';} ?>"><a href="<?= base_url('/invoices');?>"><i class="fa fa-file-text-o"></i><span>Invoices</span></a></li>
            <li class="<?php if(base_url('/settings') == $url){echo 'active';} ?>"><a href="<?= base_url('/settings');?>"><i class="fa fa-cogs"></i><span>Settings</span></a></li>
            <li class="<?php if(base_url('/send-query') == $url){echo 'active';} ?>" style="margin-top: 30px;"><a href="<?= base_url('/send-query');?>" style="padding-left: 20px;"><span>Contact Us</span></a></li>
            <?php } else if($_SESSION['user_login']['Role'] == '1'){ ?>
            <li>
               <div class="clearfix"></div>
            </li>
            <li class="<?php if(base_url('/admin-dashboard') == $url){echo 'active';} ?>"><a href="<?= base_url('/admin-dashboard');?>"><i class="fa fa-users"></i> <span>All Users</span></a></li>
            <li><a href="<?= base_url('/admin-dashboard');?>"><i class="fa fa-user"></i> <span>Top 4 Users</span></a></li>
            <li><a href="<?= base_url('/admin-dashboard');?>"><i class="fa fa-dollar"></i> <span>Manage Payment</span></a></li>
            <li><a href="<?= base_url('/admin-dashboard');?>"><i class="fa fa-edit"></i><span>Manage Users</span></a></li>
            <li><a href="<?= base_url('/admin-dashboard');?>"><i class="fa fa-newspaper-o"></i><span>Manage Ads</span></a></li>
            <li class="<?php if(base_url('/user-queries') == $url){echo 'active';} ?>"><a href="<?= base_url('/user-queries');?>"><i class="fa fa-question"></i><span>Queries</span></a></li>
            <li class="<?php if(base_url('/contact-queries') == $url){echo 'active';} ?>"><a href="<?= base_url('/contact-queries');?>"><i class="fa fa-question"></i><span>Website Queries</span></a></li>
            <?php } } ?>
         </ul>
      </nav>
   </div>
</div>