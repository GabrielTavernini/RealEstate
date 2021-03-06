<?php
	error_reporting(0);
	$string = file_get_contents("./infos.json");
	$infos = json_decode($string);
	$phonenumber = $infos->phonenumber;
	$email = $infos->email;
?>

<header class="header-area">

    <!-- Top Header Area -->
    <div class="top-header-area">
        <div class="h-100 d-md-flex justify-content-between align-items-center">
            <div class="email-address">
                <a href="mailto:<?php echo $email ?>"><?php echo $email ?></a>
            </div>
            <div class="phone-number d-flex">
                <div class="icon">
                    <a href="tel:<?php echo $phonenumber ?>"><img src="img/icons/phone-call.png" alt=""></a>
                </div>
                <div class="number">
                    <a href="tel:<?php echo $phonenumber ?>"><?php echo $phonenumber ?></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header Area -->
    <div class="main-header-area" id="stickyHeader">
        <div class="classy-nav-container breakpoint-off">
            <!-- Classy Menu -->
            <nav class="classy-navbar justify-content-between" id="southNav">

                <!-- Logo -->
                <a class="nav-brand" href="index.php"><img src="img/core-img/logo.png" alt=""></a>

                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>

                <!-- Menu -->
                <div class="classy-menu">

                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>

                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about-us.php">Chi Siamo</a></li>
                            <li><a href="listings.php">Proprietà</a></li>
                            <!-- <li><a href="#">Mega Menu</a>
                                <div class="megamenu">
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Headline 1</li>
                                        <li><a href="#">Mega Menu Item 1</a></li>
                                        <li><a href="#">Mega Menu Item 2</a></li>
                                        <li><a href="#">Mega Menu Item 3</a></li>
                                        <li><a href="#">Mega Menu Item 4</a></li>
                                        <li><a href="#">Mega Menu Item 5</a></li>
                                    </ul>
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Headline 2</li>
                                        <li><a href="#">Mega Menu Item 1</a></li>
                                        <li><a href="#">Mega Menu Item 2</a></li>
                                        <li><a href="#">Mega Menu Item 3</a></li>
                                        <li><a href="#">Mega Menu Item 4</a></li>
                                        <li><a href="#">Mega Menu Item 5</a></li>
                                    </ul>
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Headline 3</li>
                                        <li><a href="#">Mega Menu Item 1</a></li>
                                        <li><a href="#">Mega Menu Item 2</a></li>
                                        <li><a href="#">Mega Menu Item 3</a></li>
                                        <li><a href="#">Mega Menu Item 4</a></li>
                                        <li><a href="#">Mega Menu Item 5</a></li>
                                    </ul>
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Headline 4</li>
                                        <li><a href="#">Mega Menu Item 1</a></li>
                                        <li><a href="#">Mega Menu Item 2</a></li>
                                        <li><a href="#">Mega Menu Item 3</a></li>
                                        <li><a href="#">Mega Menu Item 4</a></li>
                                        <li><a href="#">Mega Menu Item 5</a></li>
                                    </ul>
                                </div>
                            </li> -->
                            <li><a href="contact.php">Contatti</a></li>
                        </ul>

                        <!-- Search Form 
                        <div class="south-search-form">
                            <form action="" method="get">
                                <input type="search" name="search" id="search" placeholder="Search Anything ...">
                                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
                        </div>-->

                        <!-- Search Button 
                        <a href="#" class="searchbtn"><i class="fa" aria-hidden="true"></i></a>-->
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>
        </div>
    </div>
</header>