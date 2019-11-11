<?php 
error_reporting(0); 
$string = file_get_contents("./properties/dictionary.json");
$dictionary = json_decode($string);
$cities = $dictionary->cities;
$categories = $dictionary->categories;
$offers = $dictionary->offers;
$actions = $dictionary->actions;
?>
<div class="south-search-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="advanced-search-form">
                    <!-- Search Title -->
                    <div class="search-title">
                        <p>Cerca un immobile</p>
                    </div>
                    <!-- Search Form -->
                    <form action="./listings.php" method="GET" id="advanceSearch" name="advanceSearch">
                        <div class="row">

                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <input type="input" class="form-control" name="input" placeholder="Parole Chiave"
                                    <?php if(isset($_GET['input'])) echo " value = \"".$_GET['input']."\"";?>>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <select class="form-control" name="cities">
                                        <option value="all" <?php if($_GET['cities'] == 'all') echo 'selected'?>>Tutte le città</option>
                                        <?php
                                            for ($x = 0; $x < count($cities); $x++) {
                                                if($cities[$x] == $_GET['cities']) { 
                                                    echo "<option value='$cities[$x]' selected>$cities[$x]</option>";
                                                }
                                                else{
                                                    echo "<option value='$cities[$x]'>$cities[$x]</option>";
                                                }
                                            } 
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <select class="form-control" name="categories">
                                        <option value="all" <?php if($_GET['categories'] == 'all') echo 'selected'?>>Tutte le categorie</option>
                                        <?php
                                            for ($x = 0; $x < count($categories); $x++) {
                                                if($categories[$x] == $_GET['categories']) { 
                                                    echo "<option value='$categories[$x]' selected>$categories[$x]</option>";
                                                }
                                                else{
                                                    echo "<option value='$categories[$x]'>$categories[$x]</option>";
                                                }
                                            } 
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="form-group">
									<select class="form-control" name="action">
										<option value="all" <?php if($_GET['action'] == 'all') echo 'selected'?>>Tutte le azioni</option>
										<?php
											for ($x = 0; $x < count($actions); $x++) {
												if($actions[$x] == $_GET['action']) { 
													echo "<option value='$actions[$x]' selected>$actions[$x]</option>";
												}
												else{
													echo "<option value='$actions[$x]'>$actions[$x]</option>";
												}
											} 
										?>
									</select>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-xl-3">
                                <div class="form-group">
                                    <select class="form-control" name="rooms">
										<option value="0" <?php if($_GET['rooms'] == '0') echo 'selected'?>>Locali</option>
                                        <option value="4" <?php if($_GET['rooms'] == '4') echo 'selected'?>>4+</option>
                                        <option value="6" <?php if($_GET['rooms'] == '6') echo 'selected'?>>6+</option>
                                        <option value="8" <?php if($_GET['rooms'] == '8') echo 'selected'?>>8+</option>
                                        <option value="10" <?php if($_GET['rooms'] == '10') echo 'selected'?>>10+</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-xl-2">
                                <div class="form-group">
                                    <select class="form-control" name="bedrooms">
                                        <option value="0" <?php if($_GET['bedrooms'] == '0') echo 'selected'?>>Camere</option>
                                        <option value="1" <?php if($_GET['bedrooms'] == '1') echo 'selected'?>>1+</option>
                                        <option value="2" <?php if($_GET['bedrooms'] == '2') echo 'selected'?>>2+</option>
                                        <option value="3" <?php if($_GET['bedrooms'] == '3') echo 'selected'?>>3+</option>
                                        <option value="4" <?php if($_GET['bedrooms'] == '4') echo 'selected'?>>4+</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-xl-2">
                                <div class="form-group">
                                    <select class="form-control" name="bathrooms">
                                        <option value="0" <?php if($_GET['bathrooms'] == '0') echo 'selected'?>>Bagni</option>
                                        <option value="1" <?php if($_GET['bathrooms'] == '1') echo 'selected'?>>1+</option>
                                        <option value="2" <?php if($_GET['bathrooms'] == '2') echo 'selected'?>>2+</option>
                                        <option value="3" <?php if($_GET['bathrooms'] == '3') echo 'selected'?>>3+</option>
                                        <option value="4" <?php if($_GET['bathrooms'] == '4') echo 'selected'?>>4+</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-8 col-lg-12 col-xl-5 d-flex">
                                <!-- Space Range -->
                                <div class="slider-range">
                                    <div data-min="0" data-max="820" data-unit=" m<SUP>2</SUP>" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"  
                                    <?php if(isset($_GET['sqmMin'])) echo " data-value-min = \"".$_GET['sqmMin']."\"";
                                        else echo "data-value-min=\"0\""; 
                                        if(isset($_GET['sqmMax'])) echo " data-value-max = \"".$_GET['sqmMax']."\"";
                                        else echo "data-value-max=\"820\""?>>

                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    </div>

                                    <input class="rangeInputMin" type="hidden" name="sqmMin" 
                                        <?php if(isset($_GET['sqmMin'])) echo " value=\"".$_GET['sqmMin']."\"";
                                        else echo "value=\"0\""; ?>>

                                    <input class="rangeInputMax" type="hidden" name="sqmMax"
                                        <?php if(isset($_GET['sqmMax'])) echo " value=\"".$_GET['sqmMax']."\"";
                                        else echo "value=\"820\""; ?>>

                                    <div class="range">
                                        <?php 
                                        if(isset($_GET['sqmMin'])) echo $_GET['sqmMin']." m<SUP>2</SUP> -";
                                        else echo "0 m<SUP>2</SUP> -";

                                        if(isset($_GET['sqmMax'])) echo " ".$_GET['sqmMax']." m<SUP>2</SUP>";
                                        else echo " 820 m<SUP>2</SUP>"; ?></div>
                                </div>

                                <!-- Distance Range -->
                                <div class="slider-range">
                                    <div data-min="0" data-max="1000000" data-unit=" €" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                                    <?php if(isset($_GET['priceMin'])) echo " data-value-min = \"".$_GET['priceMin']."\"";
                                        else echo "data-value-min=\"0\""; 
                                        if(isset($_GET['priceMax'])) echo " data-value-max = \"".$_GET['priceMax']."\"";
                                        else echo "data-value-max=\"1000000\""?>>

                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    </div>
                                    <input class="rangeInputMin" type="hidden" name="priceMin"
                                        <?php if(isset($_GET['priceMin'])) echo " value=\"".$_GET['priceMin']."\"";
                                        else echo "value=\"0\""; ?>>
                                        
                                    <input class="rangeInputMax" type="hidden" name="priceMax"
                                        <?php if(isset($_GET['priceMax'])) echo " value=\"".$_GET['priceMax']."\"";
                                        else echo "value=\"1000000\""; ?>>

                                    <div class="range">
                                        <?php 
                                        if(isset($_GET['priceMin'])) echo $_GET['priceMin']." € -";
                                        else echo "0 € -";

                                        if(isset($_GET['priceMax'])) echo " ".$_GET['priceMax']." €";
                                        else echo " 1000000 €"; ?></div>
                                </div>
                            </div>

                            <div class="col-12 search-form-second-steps">
                                <div class="row">

                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <select class="form-control" name="types">
                                                <option>All Types</option>
                                                <option>Apartment <span>(30)</span></option>
                                                <option>Land <span>(69)</span></option>
                                                <option>Villas <span>(103)</span></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <select class="form-control" name="catagories2">
                                                <option>All Catagories</option>
                                                <option>Apartment</option>
                                                <option>Bar</option>
                                                <option>Farm</option>
                                                <option>House</option>
                                                <option>Store</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <select class="form-control" name="Actions">
                                                <option>All Actions</option>
                                                <option>Sales</option>
                                                <option>Booking</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <select class="form-control" name="city2">
                                                <option>All City</option>
                                                <option>City 1</option>
                                                <option>City 2</option>
                                                <option>City 3</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" name="Actions3">
                                                <option>All Actions</option>
                                                <option>Sales</option>
                                                <option>Booking</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" name="city3">
                                                <option>All City</option>
                                                <option>City 1</option>
                                                <option>City 2</option>
                                                <option>City 3</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" name="city5">
                                                <option>All City</option>
                                                <option>City 1</option>
                                                <option>City 2</option>
                                                <option>City 3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-between align-items-end">
                                <!-- More Filter -->
                                <div class="more-filter">
                                   <!--<a href="#" id="moreFilter">+ Altri filtri</a>-->
                                </div>
                                <!-- Submit -->
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn south-btn">Cerca</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function search()
    {
        window.location.href = "./listings.php?keywords=" + document.getElementsByName("input").values
                                + "&cities=" + document.getElementById("cities").values
                                + "&catagories=" + document.getElementById("catagories").values
                                + "&offers=" + document.getElementById("offers")
                                + "&action=" + document.getElementById("action") 
                                + "&offers=" + document.getElementById("offers") 
                                + "&bedrooms=" + document.getElementById("bedrooms") 
                                + "&bathrooms=" + document.getElementById("bathrooms") 
                                + "&space=" + document.getElementsByClassName("range")[0]
                                + "&price=" + document.getElementsByClassName("range") [1];

    }
</script>