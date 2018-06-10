<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>South - Real Estate Agency Template | Listings</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Style CSS -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="south-load"></div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <?php include("header.html"); ?>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img" style="background-image: url(img/bg-img/hero1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-content">
                        <h3 class="breadcumb-title">Listings</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Advance Search Area Start ##### -->
    <?php include("./search.php"); ?>
    <!-- ##### Advance Search Area End ##### -->

    <!-- ##### Listing Content Wrapper Area Start ##### -->
    <section class="listings-content-wrapper section-padding-100">
        <div class="container">
            <!--<div class="row">
                <div class="col-12">
                    <div class="listings-top-meta d-flex justify-content-between mb-100">
                        <div class="view-area d-flex align-items-center">
                            <span>View as:</span>
                            <div class="grid_view ml-15"><a href="#" class="active"><i class="fa fa-th" aria-hidden="true"></i></a></div>
                            <div class="list_view ml-15"><a href="#"><i class="fa fa-th-list" aria-hidden="true"></i></a></div>
                        </div>
                        <div class="order-by-area d-flex align-items-center">
                            <span class="mr-15">Order by:</span>
                            <select>
                              <option selected>Default</option>
                              <option value="1">Newest</option>
                              <option value="2">Sales</option>
                              <option value="3">Ratings</option>
                              <option value="3">Popularity</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>-->

            <div class="row">
            <?php 
                    //path to directory to scan
                    $directory = "./properties/";
                    $files = glob($directory . "*");
                    
                    //print each file name
                    foreach($files as $file)
                    {
                        //check to see if the file is a folder/directory
                        if(is_dir($file))
                        {
                            $string = file_get_contents($file."/info.json");
                            $json = json_decode($string);
                            setlocale(LC_MONETARY, 'it_IT');

                            if(empty($_GET))
                            {
                               echo "<!-- Single Featured Property -->
                                <div class=\"col-12 col-md-6 col-xl-4\" onclick=\"propertyClicked('".basename($file)."')\">
                                    <div class=\"single-featured-property mb-50 wow fadeInUp\" data-wow-delay=\"100ms\">
                                        <!-- Property Thumbnail -->
                                        <div class=\"property-thumb\">
                                            <img src=\"".$file."/img/feature.jpg\" alt=\"\">

                                            <div class=\"tag\">
                                                <span>".$json->action."</span>
                                            </div>
                                            <div class=\"list-price\">
                                                <p>".str_replace('Eu', '€', money_format('%n', $json->price))."</p>
                                            </div>
                                        </div>
                                        <!-- Property Content -->
                                        <div class=\"property-content\">
                                            <h5>".$json->name."</h5>
                                            <p class=\"location\"><img src=\"img/icons/location.png\" alt=\"\">".$json->address."</p>
                                            <p>".$json->shortdescription."</p>
                                            <div class=\"property-meta-data d-flex align-items-end justify-content-between\">
                                                <div class=\"new-tag\">
                                                    <img src=\"img/icons/new.png\" alt=\"\">
                                                </div>
                                                <div class=\"bathroom\">
                                                    <img src=\"img/icons/bathtub.png\" alt=\"\">
                                                    <span>".$json->bath."</span>
                                                </div>
                                                <div class=\"garage\">
                                                    <img src=\"img/icons/bed.png\" alt=\"\">
                                                    <span>".$json->bed."</span>
                                                </div>
                                                <div class=\"space\">
                                                    <img src=\"img/icons/space.png\" alt=\"\">
                                                    <span>".$json->sqm." m<SUP>2</SUP></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>"; 
                            }
                            else
                            {
                                if(($_GET['cities'] == $json->city || $_GET['cities'] == 'all')
                                    && ($_GET['categories'] == $json->category || $_GET['categories'] == 'all')
                                    && ($_GET['action'] == $json->action || $_GET['action'] == 'all')
                                    //&& ($_GET['offers'] == $json->offers || $_GET['offers'] == 'all')
                                    && ($_GET['bedrooms'] <= $json->bed || $_GET['bedrooms'] == '0')
                                    && ($_GET['bathrooms'] <= $json->bath || $_GET['bathrooms'] == '0')
                                    && $_GET['priceMin'] <= $json->price  
                                    && $_GET['priceMax'] >= $json->price
                                    && $_GET['sqmMin'] <= $json->sqm 
                                    && $_GET['sqmMax'] >= $json->sqm
                                    )
                                    {
                                        echo "<!-- Single Featured Property -->
                                            <div class=\"col-12 col-md-6 col-xl-4\" onclick=\"propertyClicked('".basename($file)."')\">
                                                <div class=\"single-featured-property mb-50 wow fadeInUp\" data-wow-delay=\"100ms\">
                                                    <!-- Property Thumbnail -->
                                                    <div class=\"property-thumb\">
                                                        <img src=\"".$file."/img/feature.jpg\" alt=\"\">

                                                        <div class=\"tag\">
                                                            <span>".$json->action."</span>
                                                        </div>
                                                        <div class=\"list-price\">
                                                            <p>".str_replace('Eu', '€', money_format('%n', $json->price))."</p>
                                                        </div>
                                                    </div>
                                                    <!-- Property Content -->
                                                    <div class=\"property-content\">
                                                        <h5>".$json->name."</h5>
                                                        <p class=\"location\"><img src=\"img/icons/location.png\" alt=\"\">".$json->address."</p>
                                                        <p>".$json->shortdescription."</p>
                                                        <div class=\"property-meta-data d-flex align-items-end justify-content-between\">
                                                            <div class=\"new-tag\">
                                                                <img src=\"img/icons/new.png\" alt=\"\">
                                                            </div>
                                                            <div class=\"bathroom\">
                                                                <img src=\"img/icons/bathtub.png\" alt=\"\">
                                                                <span>".$json->bath."</span>
                                                            </div>
                                                            <div class=\"garage\">
                                                                <img src=\"img/icons/bed.png\" alt=\"\">
                                                                <span>".$json->bed."</span>
                                                            </div>
                                                            <div class=\"space\">
                                                                <img src=\"img/icons/space.png\" alt=\"\">
                                                                <span>".$json->sqm." m<SUP>2</SUP></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>";  
                                    }
                            }
                        }
                    }
                ?>
            </div>

            <!--<div class="row">
                <div class="col-12">
                    <div class="south-pagination d-flex justify-content-end">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link active" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>-->
        </div>
    </section>
    <!-- ##### Listing Content Wrapper Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area section-padding-100-0 bg-img gradient-background-overlay" style="background-image: url(img/bg-img/cta.jpg);">
        <!-- Main Footer Area -->
        <div class="main-footer-area">
            <div class="container">
                <div class="row">

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="footer-widget-area mb-100">
                            <!-- Widget Title -->
                            <div class="widget-title">
                                <h6>About Us</h6>
                            </div>

                            <img src="img/bg-img/footer.jpg" alt="">
                            <div class="footer-logo my-4">
                                <img src="img/core-img/logo.png" alt="">
                            </div>
                            <p>Integer nec bibendum lacus. Suspen disse dictum enim sit amet libero males uada feugiat. Praesent malesuada.</p>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="footer-widget-area mb-100">
                            <!-- Widget Title -->
                            <div class="widget-title">
                                <h6>Hours</h6>
                            </div>
                            <!-- Office Hours -->
                            <div class="weekly-office-hours">
                                <ul>
                                    <li class="d-flex align-items-center justify-content-between"><span>Monday - Friday</span> <span>09 AM - 19 PM</span></li>
                                    <li class="d-flex align-items-center justify-content-between"><span>Saturday</span> <span>09 AM - 14 PM</span></li>
                                    <li class="d-flex align-items-center justify-content-between"><span>Sunday</span> <span>Closed</span></li>
                                </ul>
                            </div>
                            <!-- Address -->
                            <div class="address">
                                <h6><img src="img/icons/phone-call.png" alt=""> +45 677 8993000 223</h6>
                                <h6><img src="img/icons/envelope.png" alt=""> office@template.com</h6>
                                <h6><img src="img/icons/location.png" alt=""> Main Str. no 45-46, b3, 56832, Los Angeles, CA</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="footer-widget-area mb-100">
                            <!-- Widget Title -->
                            <div class="widget-title">
                                <h6>Useful Links</h6>
                            </div>
                            <!-- Nav -->
                            <ul class="useful-links-nav d-flex align-items-center">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">About us</a></li>
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Services</a></li>
                                <li><a href="#">Properties</a></li>
                                <li><a href="#">Listings</a></li>
                                <li><a href="#">Testimonials</a></li>
                                <li><a href="#">Properties</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Testimonials</a></li>
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">Elements</a></li>
                                <li><a href="#">FAQ</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="footer-widget-area mb-100">
                            <!-- Widget Title -->
                            <div class="widget-title">
                                <h6>Featured Properties</h6>
                            </div>
                            <!-- Featured Properties Slides -->
                            <div class="featured-properties-slides owl-carousel">
                                <!-- Single Slide -->
                                <div class="single-featured-properties-slide">
                                    <a href="#"><img src="img/bg-img/fea-product.jpg" alt=""></a>
                                </div>
                                <!-- Single Slide -->
                                <div class="single-featured-properties-slide">
                                    <a href="#"><img src="img/bg-img/fea-product.jpg" alt=""></a>
                                </div>
                                <!-- Single Slide -->
                                <div class="single-featured-properties-slide">
                                    <a href="#"><img src="img/bg-img/fea-product.jpg" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Copywrite Text -->
        <div class="copywrite-text d-flex align-items-center justify-content-center">
            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <script src="js/classy-nav.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>

    <script>
        function propertyClicked(id) {
            window.location.href = "./single-listings.php?id=" + id;
        }
    </script>
    
</body>

</html>