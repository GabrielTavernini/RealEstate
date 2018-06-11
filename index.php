<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Studio Immobiliare Europa | Home</title>

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
    
    <!-- ##### Hero Area Start ##### -->
    <section class="hero-area">
        <div class="hero-slides owl-carousel">
            <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img" style="background-image: url(img/bg-img/hero1.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="hero-slides-content">
                                <h2 data-animation="fadeInUp" data-delay="100ms">Trova la tua casa</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img" style="background-image: url(img/bg-img/hero2.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="hero-slides-content">
                                <h2 data-animation="fadeInUp" data-delay="100ms">La tua casa dei sogni</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Hero Slide
            <div class="single-hero-slide bg-img" style="background-image: url(img/bg-img/hero3.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="hero-slides-content">
                                <h2 data-animation="fadeInUp" data-delay="100ms">Find your perfect house</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </section>
    <!-- ##### Hero Area End ##### -->

    <!-- ##### Advance Search Area Start ##### -->
    <?php include("./search.php"); ?>
    <!-- ##### Advance Search Area End ##### -->

    <!-- ##### Featured Properties Area Start ##### -->
    <section class="featured-properties-area section-padding-100-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading wow fadeInUp">
                        <h2>Proprietà in Evidenza</h2>
                        <p>I migliori affari della zona selezionati da noi per te.</p>
                    </div>
                </div>
            </div>

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

                            $string = file_get_contents("./properties/featured.json");
                            $featured = json_decode($string);
                            setlocale(LC_MONETARY, 'it_IT');
                            
                            if(in_array(basename($file), $featured)){
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
                ?>

                
            </div>
        </div>
    </section>
    <!-- ##### Featured Properties Area End ##### -->

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

    <!-- ##### Testimonials Area Start #####
    <section class="south-testimonials-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading wow fadeInUp" data-wow-delay="250ms">
                        <h2>Client testimonials</h2>
                        <p>Suspendisse dictum enim sit amet libero malesuada feugiat.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="testimonials-slides owl-carousel wow fadeInUp" data-wow-delay="500ms">

                        
                        <div class="single-testimonial-slide text-center">
                            <h5>Perfect Home for me</h5>
                            <p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic iturut magna.</p>

                            <div class="testimonial-author-info">
                                <img src="img/bg-img/feature6.jpg" alt="">
                                <p>Daiane Smith, <span>Customer</span></p>
                            </div>
                        </div>

                        
                        <div class="single-testimonial-slide text-center">
                            <h5>Perfect Home for me</h5>
                            <p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic iturut magna.</p>

                            <div class="testimonial-author-info">
                                <img src="img/bg-img/feature6.jpg" alt="">
                                <p>Daiane Smith, <span>Customer</span></p>
                            </div>
                        </div>

                        
                        <div class="single-testimonial-slide text-center">
                            <h5>Perfect Home for me</h5>
                            <p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic iturut magna.</p>

                            <div class="testimonial-author-info">
                                <img src="img/bg-img/feature6.jpg" alt="">
                                <p>Daiane Smith, <span>Customer</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    ##### Testimonials Area End ##### -->

    <!-- ##### Editor Area Start #####
    <section class="south-editor-area d-flex align-items-center">
        <div class="editor-content-area">
            <div class="section-heading wow fadeInUp" data-wow-delay="250ms">
                <img src="img/icons/prize.png" alt="">
                <h2>jeremy Scott</h2>
                <p>Realtor</p>
            </div>
            <p class="wow fadeInUp" data-wow-delay="500ms">Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odiomattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic iturut magna. Curabitur rhoncus auctor eleifend. Fusce venenatis diam urna, eu pharetra arcu varius ac. Etiam cursus turpis lectus, id iaculis risus tempor id. Phasellus fringilla nisl sed sem scelerisque, eget aliquam magna vehicula.</p>
            <div class="address wow fadeInUp" data-wow-delay="750ms">
                <h6><img src="img/icons/phone-call.png" alt=""> +45 677 8993000 223</h6>
                <h6><img src="img/icons/envelope.png" alt=""> office@template.com</h6>
            </div>
            <div class="signature mt-50 wow fadeInUp" data-wow-delay="1000ms">
                <img src="img/core-img/signature.png" alt="">
            </div>
        </div>
        
        <div class="editor-thumbnail">
            <img src="img/bg-img/editor.jpg" alt="">
        </div>
    </section>
    ##### Editor Area End ##### -->

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

    <script>
        function propertyClicked(id) {
            window.location.href = "./single-listings.php?id=" + id;
        }
    </script>

</body>

</html>