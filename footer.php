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
                        <h6>Chi siamo</h6>
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
                        <h6>Orari</h6>
                    </div>
                    <!-- Office Hours -->
                    <div class="weekly-office-hours">
                        <ul>
                            <li class="d-flex align-items-center justify-content-between"><span>Lunedì - Venerdì</span> <span>08.50 - 13.00</span></li>
                            <li class="d-flex align-items-center justify-content-between"><span>Sabaro</span> <span>Chiuso</span></li>
                            <li class="d-flex align-items-center justify-content-between"><span>Domenica</span> <span>Chiuso</span></li>
                        </ul>
                    </div>
                    <!-- Address -->
                    <div class="address">
                        <h6><img src="img/icons/phone-call.png" alt=""> +39 0464 519200</h6>
                        <h6><img src="img/icons/envelope.png" alt=""> office@template.com</h6>
                        <h6><img src="img/icons/location.png" alt=""> Via Guglielmo Marconi, 27, 38062 Arco TN</h6>
                    </div>
                </div>
            </div>

            <!-- Single Footer Widget -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="footer-widget-area mb-100">
                    <!-- Widget Title -->
                    <div class="widget-title">
                        <h6>Link Utili</h6>
                    </div>
                    <!-- Nav -->
                    <ul class="useful-links-nav d-flex align-items-center">
                        <li><a href="">Home</a></li>
                        <li><a href="./about-us.php">Chi Siamo</a></li>
                        <li><a href="./listings.php">Proprietà</a></li>
                        <li><a href="./contact.php">Contatti</a></li>
                        <li><a href="tel:+39 0464 519200">Chiama</a></li>
                        <li><a href="mailto:contact@southtemplate.com">E-Mail</a></li>
                        <li><a href="https://www.casa.it/vendita-residenziale/da-119699/lista-1?gclid=Cj0KCQjwmPPYBRCgARIsALOziAP20AVX_0dsUT03A5BlSuwbKLWxWauHi4W8tanUp1fIgfwPQuiH2KgaAvY1EALw_wcB">Casa.it</a></li>
                        <li><a href="https://goo.gl/maps/g3uJK6WUmgD2">Maps</a></li>
                        <li><a href="./listings.php?input=&cities=all&categories=all&offers=all&action=In+Affitto&bedrooms=0&bathrooms=0&sqmMin=20&sqmMax=820&priceMin=10000&priceMax=1000000">In Affitto</a></li>
                        <li><a href="./listings.php?input=&cities=all&categories=all&offers=all&action=In+Vendita&bedrooms=0&bathrooms=0&sqmMin=20&sqmMax=820&priceMin=10000&priceMax=1000000">In Vendita</a></li>
                        <li><a href="./listings.php?input=&cities=Arco&categories=all&offers=all&action=all&bedrooms=0&bathrooms=0&sqmMin=20&sqmMax=820&priceMin=10000&priceMax=1000000">Ad Arco</a></li>
                        <li><a href="./listings.php?input=&cities=Riva&categories=all&offers=all&action=all&bedrooms=0&bathrooms=0&sqmMin=20&sqmMax=820&priceMin=10000&priceMax=1000000">A Riva</a></li>
                        <li><a href="./listings.php?input=&cities=Dro&categories=all&offers=all&action=all&bedrooms=0&bathrooms=0&sqmMin=20&sqmMax=820&priceMin=10000&priceMax=1000000">A Dro</a></li>
                    </ul>
                </div>
            </div>

            <!-- Single Footer Widget -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="footer-widget-area mb-100">
                    <!-- Widget Title -->
                    <div class="widget-title">
                        <h6>In Evidenza</h6>
                    </div>
                    <!-- Featured Properties Slides -->
                    <div class="featured-properties-slides owl-carousel">
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
                                                <h5 style=\"color:white\">".$json->name."</h5>
                                                <p class=\"location\"><img src=\"img/icons/location.png\" alt=\"\">".$json->address."</p>
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
    </div>
</div>

<!-- Copywrite Text -->
<div class="copywrite-text d-flex align-items-center justify-content-center">
    <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://gabrieltavernini.github.io" target="_blank">Gabriel Tavernini </a> & <a href="https://colorlib.com" target="_blank">ColorLib</p>
</div>
</footer>