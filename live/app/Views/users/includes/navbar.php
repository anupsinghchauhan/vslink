<!-- Page top navbar -->
        <nav class="navbar navbar-fixed-top">
            <div class="container-fluid">
                <?php if(isset($_SESSION['user_login'])) { 
                                if($_SESSION['user_login']['Role'] == '2') { ?>
                                    <div class="navbar-left">
                                        <div class="navbar-btn">
                                            <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-align-left"></i></button>
                                        </div>  
                                        <div id="navbar-search" class="navbar-form search-form">
                                            <h5>Balance  : $<?= $earning_count; ?></h5>
                                        </div>
                                    </div>
                                    <div class="navbar-right">
                                        <div id="navbar-menu">
                                            <ul class="nav navbar-nav">
                                               
                                                <li class="hidden-xs" style="display:none;"><a href="javascript:void(0);" id="btnFullscreen" class=""></a></li>
                                               
                                                <li class="dropdown">
                                                    <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">Hi, <?= $_SESSION['user_login']['Fullname']; ?>  <i class="fa fa-user"></i></a>
                                                    <div class="dropdown-menu pb-0 mt-0">
                                                        <a class="dropdown-item pt-2 pb-2" href="<?= base_url('/settings'); ?>">Profile</a>
                                                        <a class="dropdown-item pt-2 pb-2" href="<?= base_url('/logout'); ?>">Logout</a>
                                                    </div>
                                                </li>
                                               
                                            </ul>
                                        </div>
                                    </div>
                 <?php } else if($_SESSION['user_login']['Role'] == '1'){ ?>
                                <div class="navbar-left">
                                        <div class="navbar-btn">
                                            <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-align-left"></i></button>
                                        </div>  
                                        <div id="navbar-search" class="navbar-form search-form">
                                            <h5></h5>
                                        </div>
                                    </div>
                                <div class="navbar-right">
                                        <div id="navbar-menu">
                                            <ul class="nav navbar-nav">
                                                
                                                <li class="hidden-xs" style="display:none;"><a href="javascript:void(0);" id="btnFullscreen" class=""></a></li>
                                               
                                                <li class="dropdown">
                                                    <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">Hi, <?= $_SESSION['user_login']['Fullname']; ?> <i class="fa fa-user"></i></a>
                                                    <div class="dropdown-menu pb-0 mt-0">
                                                        <a class="dropdown-item pt-2 pb-2" href="<?= base_url('/change-password'); ?>">Change Password</a>
                                                        <a class="dropdown-item pt-2 pb-2" href="<?= base_url('/logout'); ?>">Logout</a>
                                                    </div>
                                                </li>
                                               
                                            </ul>
                                        </div>
                                    </div>
                <?php } } ?>
                
            </div>
        </nav>