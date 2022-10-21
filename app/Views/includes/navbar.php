<!--============= Header Section Starts Here =============-->
    <header class="header-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4 col-md-4 small-logo">
                    <div class="logo">
                        <a href="<?= base_url('/');?>">
                            <img src="<?= base_url('assets/images/logo/logo.png');?>" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-8 col-md-8 small-header">
                    <div class="header-top">

                        <!-- <ul class="menu">
                            <li class="d-sm-none text-center">
                                <a href="<?= base_url('/login');?>" class="header-button">Login</a>
                            </li>
                            <li class="d-sm-none text-center">
                                <a href="<?= base_url('/register');?>" class="mb-4 header-button">Register</a>
                            </li>
                        </ul> -->

                        <div class="header-right">
                            <ul class="menu">
                                <li><a href="<?= base_url('/login');?>" class="login-btn d-none d-sm-inline-block m-0">Login</a></li>
                                <li><a href="<?= base_url('/register');?>" class="header-button d-none d-sm-inline-block">Sign Up</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="header-top2">

                        <ul class="menu">
                            <li>
                                <a href="<?= base_url('/');?>">Home</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/');?>">Publisher Rate</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/about-us');?>">About</a>
                            </li>
                            <li>
                                <a href="#getintouch">Contact Us</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/blogs');?>">Blogs</a>
                            </li>
                            <li><a href="<?= base_url('/login');?>" class="header-button hidden-big-screen">Login</a> <a href="<?= base_url('/register');?>" class="header-button hidden-big-screen">Sign Up</a></li>
                            
                        </ul>

                    </div>
                    <div class="header-bar d-lg-none mr-sm-3">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                </div>
        </div>
    </header>
    <!--============= Header Section Ends Here =============