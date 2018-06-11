<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Studio Immobiliare Europa | Chi Siamo</title>

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
                        <h3 class="breadcumb-title">Chi siamo</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Advance Search Area Start ##### -->
    <?php include("./search.php"); ?>
    <!-- ##### Advance Search Area End ##### -->

    <!-- ##### About Content Wrapper Start ##### -->
    <section class="about-content-wrapper section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="section-heading text-left wow fadeInUp" data-wow-delay="250ms">
                        <h2>Noi cerchiamo la casa perfetta</h2>
                        <p>Suspendisse dictum enim sit amet libero</p>
                    </div>
                    <div class="about-content">
                        <img class="wow fadeInUp" data-wow-delay="350ms" src="img/bg-img/about.jpg" alt="">
                        <p class="wow fadeInUp" data-wow-delay="450ms">Integer nec bibendum lacus. Suspendisse dictum enim sit amet libero malesuada. Integer nec bibendum lacus. Suspendisse dictum enim sit amet libero malesuada feugiat. Praesent malesuada congue magna at finibus. In hac habitasse platea dictumst. Curabitur rhoncus auctor eleifend. Fusce venenatis diam urna, eu pharetra arcu varius ac. Etiam cursus turpis lectus, id iaculis risus tempor id. Phasellus fringilla nisl sed sem scelerisque, eget aliquam magna vehicula.</p>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="section-heading text-left wow fadeInUp" data-wow-delay="250ms">
                        <h2>Proprietà in Evidenza</h2>
                        <p>I migliori affari della zona.</p>
                    </div>

                    <div class="featured-properties-slides owl-carousel wow fadeInUp" data-wow-delay="350ms">
                    
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

                                    $string = file_get_contents("./properties/featured.json");
                                    $featured = json_decode($string);
                                    setlocale(LC_MONETARY, 'it_IT');
                                    
                                    if(in_array(basename($file), $featured)){
                                        echo "<!-- Single Slide -->
                                        <div class=\"single-featured-property\" onclick=\"propertyClicked('".basename($file)."')\">
                                            <!-- Property Thumbnail -->
                                            <div class=\"property-thumb\">
                                                <img src=\"".$file."/img/feature.jpg\" alt=\"\">
                
                                                <div class=\"tag\">
                                                <span>".$json->action."</span>
                                                </div>
                                                <div class=\"list-price\">
                                                    <p>".str_replace('Eu', '€', money_format('%.0n', $json->price))."</p>
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
                                                        <img src=\"img/icons/garage.png\" alt=\"\">
                                                        <span>".$json->bed."</span>
                                                    </div>
                                                    <div class=\"space\">
                                                        <img src=\"img/icons/space.png\" alt=\"\">
                                                        <span>".$json->sqm." m<SUP>2</SUP></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>"; 
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### About Content Wrapper End ##### -->

    <!-- ##### Call To Action Area Start #####
    <section class="call-to-action-area bg-fixed bg-overlay-black" style="background-image: url(img/bg-img/cta.jpg)">
        <div class="container h-100">
            <div class="row align-items-center h-100">
                <div class="col-12">
                    <div class="cta-content text-center">
                        <h2 class="wow fadeInUp" data-wow-delay="300ms">Are you looking for a place to rent?</h2>
                        <h6 class="wow fadeInUp" data-wow-delay="400ms">Suspendisse dictum enim sit amet libero malesuada feugiat.</h6>
                        <a href="#" class="btn south-btn mt-50 wow fadeInUp" data-wow-delay="500ms">Search</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    ##### Call To Action Area End ##### -->


    <!-- ##### Footer Area Start ##### -->
    <?php include("footer.php"); ?>
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

</body>

</html>