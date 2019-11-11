<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Studio Immobiliare Europa | Proprietà</title>

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
    <?php include("header.php"); ?>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img" style="background-image: url(img/bg-img/hero1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-content">
                        <h3 class="breadcumb-title">Proprietà</h3>
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
                                                <p>".str_replace('EUR', '€', money_format('%.0n', $json->price))."</p>
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
									&& ($_GET['rooms'] <= $json->rooms || $_GET['rooms'] == '0')
                                    && ($_GET['bedrooms'] <= $json->bed || $_GET['bedrooms'] == '0')
                                    && ($_GET['bathrooms'] <= $json->bath || $_GET['bathrooms'] == '0')
                                    && $_GET['priceMin'] <= $json->price  
                                    && $_GET['priceMax'] >= $json->price
                                    && $_GET['sqmMin'] <= $json->sqm 
                                    && $_GET['sqmMax'] >= $json->sqm
									&& (stripos($json->name, $_GET['input']) !== FALSE
										|| stripos($json->shortdescription, $_GET['input']) !== FALSE 
										|| stripos($json->longdescription, $_GET['input']) !== FALSE 
										|| $_GET['input'] == ""))
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
                                                            <p>".str_replace('EUR', '€', money_format('%.0n', $json->price))."</p>
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