<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!doctype html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel='stylesheet' id='bootstrap-css' href='css/bootstrap.min.css' type='text/css' media='all' />
    <link rel='stylesheet' id='jquery-ui-theme-css' href='css/jquery-ui.min.css' type='text/css' media='all' />
    <link rel='stylesheet' id='jquery-ui-timepicker-css' href='css/jquery-ui-timepicker-addon.min.css' type='text/css' media='all' />
    <link rel='stylesheet' id='custom-style-u-css' href='css/style-u.css' type='text/css' media='all' />
    <link rel='stylesheet' id='slick-style-css' href='css/slick.css' type='text/css' media='all' />
    <link rel='stylesheet' id='slick-style-theme-css' href='css/slick-theme.css' type='text/css' media='all' />
    <link rel='stylesheet' id='helper-style-css' href='css/helper.css' type='text/css' media='all' />
    <link rel='stylesheet' id='font-awesome-css' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css' type='text/css' media='all' />
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tamma+2:wght@400;500;600;700;800&family=Julius+Sans+One&family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link rel='stylesheet' id='owl-carousel-css' href='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css' type='text/css' media='all' />
    <link rel='stylesheet' id='qasa-style-css' href='css/style.css' type='text/css' media='all' />
    <script type='text/javascript' src='js/jquery.js'></script>
    <script type='text/javascript' src='js/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='js/js-u.js'></script>
    <script type='text/javascript' src='js/slick.js'></script>
    <script type='text/javascript' src='js/slick.min.js'></script>
    <title>Popup Login and Signup Forms</title>
    <style>
        .button-container {
            text-align: center;
            margin-top: 50px;
        }

        .button {
            margin-left: 60px;
            margin-top: 11px;
            border: none;
            width: 366px;
            height: 66px;
            border-radius: 5px;
            background: #000;
            color: #fff;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            line-height: 66px;
        }

        .button:hover {
            background-color: #333;
        }

        .button a {
            color: #fff;
            text-decoration: none;
            display: inline-block;
            width: 100%;
            height: 100%;
        }


        .overlay {
            display: none;
            position:absolute;
            top: 100;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
            z-index: 1;
        }

        /* Style for the popup */
        .popup {
            display: none;
            position:absolute;
            top: 100%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 8;
            width: 80%; /* Adjust the width as needed */
            max-width: 400px; /* Set a maximum width for the popup */
        }
    </style>

</head>

<body class="home page-template page-template-tmpl-frontpage page-template-tmpl-frontpage-php page page-id-6" style="color: burlywood;">
    <div class="contact-video"></div>
    <div id="page" class="site" style="color: burlywood;">
        <header id="masthead" class="site-header">
            <div class="container main-header-container" style="color: burlywood;">
                <div class="site-branding">
                    <a href="index.html" class="logo-link" rel="home" target="_self"><img src="images/large-honey-removebg-preview.png" alt="logo"/></a>
                    <p class="site-title"><a href="index.html" rel="home"></a></p>
                </div>

                <nav id="site-navigation" class="main-navigation" data-el="aria">
                    <ul id="mastmenu" class="nav primary-menu">
                        <li class="menu-item"><a href="#menu">our menu</a></li>
                        <li class="menu-item"><a href="#meetchef">apiary</a></li>
                        <li class="menu-item"><a href="#blog">read blog</a></li>
                        <li class="menu-item"><a href="#gallery">gallery</a></li>
                        <li class="menu-item"><a href="#contact">contact</a></li>
                        <div class="content">
                            <!-- notification message -->
                            <?php if (isset($_SESSION['success'])) : ?>
                            <div class="error success" >
                                <h3>
                                <?php 
                                    echo $_SESSION['success']; 
                                    unset($_SESSION['success']);
                                ?>
                                </h3>
                            </div>
                            <?php endif ?>

                            <!-- logged in user information -->
                            <?php  if (isset($_SESSION['username'])) : ?>
                                <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
                            <?php endif ?>
                        </div>
                    </ul>
                    <div class="overlay" id="overlay"></div>

                    <div id="loginPopup" class="popup">
        <h2>Login</h2>
        <form>
            <label for="loginUsername">Username:</label>
            <input type="text" id="loginUsername" name="loginUsername"><br><br>
            
            <label for="loginEmail">Email:</label>
            <input type="email" id="loginEmail" name="loginEmail"><br><br>
            
            <label for="loginPassword">Password:</label>
            <input type="password" id="loginPassword" name="loginPassword"><br><br>
            
            <button type="submit">Login</button>
        </form>
        <button id="closeLoginPopup">Close</button>
    </div>

    <div id="signupPopup" class="popup">
        <h2>Sign Up</h2>
        <form action="signup.php" method="post">
            <label for="signupUsername">Username:</label>
            <input type="text" id="signupUsername" name="username"><br><br>
            
            <label for="signupEmail">Email:</label>
            <input type="email" id="signupEmail" name="email"><br><br>
            
            <label for="signupPassword">Password:</label>
            <input type="password" id="signupPassword" name="password"><br><br>
            
            <button type="submit" name="submit">Sign Up</button>
        </form>
        <button id="closeSignupPopup">Close</button>
    </div>


    <script>
        // Get references to the buttons and popup elements
        const loginButton = document.getElementById("loginButton");
        const signupButton = document.getElementById("signupButton");
        const overlay = document.getElementById("overlay");
        const loginPopup = document.getElementById("loginPopup");
        const signupPopup = document.getElementById("signupPopup");
        const closeLoginPopup = document.getElementById("closeLoginPopup");
        const closeSignupPopup = document.getElementById("closeSignupPopup");

        // Open login popup when login button is clicked
        loginButton.addEventListener("click", () => {
            overlay.style.display = "block";
            loginPopup.style.display = "block";
        });

        // Open signup popup when signup button is clicked
        signupButton.addEventListener("click", () => {
            overlay.style.display = "block";
            signupPopup.style.display = "block";
        });

        // Close the login popup when the close button is clicked
        closeLoginPopup.addEventListener("click", () => {
            overlay.style.display = "none";
            loginPopup.style.display = "none";
        });

        // Close the signup popup when the close button is clicked
        closeSignupPopup.addEventListener("click", () => {
            overlay.style.display = "none";
            signupPopup.style.display = "none";
        });

        // Close the popups when clicking on the overlay
        overlay.addEventListener("click", () => {
            overlay.style.display = "none";
            loginPopup.style.display = "none";
            signupPopup.style.display = "none";
        });
    </script>
                </nav>
                
                <nav id="site-nav-tools" class="site-nav-tools">
                    <button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false" data-el="aria">
                        <span class="screen-reader-text">Primary Menu</span>
                        <span class="menu-icon"></span>
                    </button>
                </nav>
            </div>
        </header>
        
        <div id="content" class="site-content">

            <div id="primary" class="content-area front-page-content-area">
                <main id="main" class="site-main">
                <section id="banner" class="section banner-section" data-eltype="frontpagesection" style="background-image: url(images/output-onlinepngtools.png); position: relative;">
                    <div class="container section-inner">
                        <div class="section-body">
                            <div class="section-header">
                                <div class="section-title" style="color: black; font-size: 40px; font-weight: bold;">
                                    <p>Harvesting Nature's Bounty: Nectar to Your Doorstep Through HiveToHome :)</p>
                                </div>
                                <p class="section-subtitle" style="color: black; font-size: 25px; font-weight: bold;">Discover the symphony of flavors in our HiveToHome: Honey Order and Apiary Management System. Order nature's liquid gold effortlessly while exploring advanced apiary management tools.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
                    <section id="introduce" class="section introduce-section" data-eltype="frontpagesection">
                        <div class="container section-inner">
                            <div class="section-header bigsub">
                                <div class="contact-video-inner"></div>
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/2k38vE79Idw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="icon-video">
                                <button>Play</button>
                            </div>
                            <div class="section-content row">
                                <div class="img-border col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <img src="images/haney-bottle2.jpeg" alt=""> <img src="images/honey-bottle3.jpeg" alt="">
                                    <div class="border-deflection"></div>
                                </div>
                                <div class="section-header col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="section-title">
                                        <p>Sweetness Bottled for You!</p>
                                    </div>
                                    <div class="section-subtitle">
                                        <p>Embark on a journey of exquisite flavors with HiveToHome's pure, organic honey collection. Our commitment to quality ensures that every jar encapsulates the rich essence of nature's wonder.</p>
                                        <p>Your palate awaits – select your jar before you go!</p>
                                    </div>
                                    <div class="button-container">
                                        <button class="button"><a href="order.php" target="_self">Order Now</a></button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="menu" class="section menu-section" data-eltype="frontpagesection">
                        <div class="container section-inner">
                            <div class="section-header">
                                <div class="section-title">
                                    <p>browse Our Menu’s</p>
                                </div>
                                <div class="row">
                                    <div class="section-subtitle col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <p>Discover the pure essence of nature with our exquisite honey collection. Sourced from the most pristine landscapes, our honey captures the unique flavors of various blossoms and blooms. From the delicate sweetness of wildflowers to the robust richness of forest nectar, each jar tells a story of the bees' tireless work and the land's bounty.</p>
                                    </div>
                                    <div class="section-subtitle col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <p>Whether drizzled over warm pastries or paired with artisan cheeses, our honey brings a touch of natural luxury to your table, inviting you to experience the unparalleled taste of the wilderness in every golden drop.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="section-content">
                                <div class="row" id="slider-menu">
                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 menu-grid">
                                        <div class="menu-img">
                                            <div class="menu-block has-post-thumbnail">
                                                <div class="entry-thumbnail"><img width="330" height="331" src="images/h5.jpeg" class="attachment-full size-full wp-post-image" alt="" /></div>
                                            </div>
                                        </div>
                                        <div class="menu-grid-col">
                                            <div class="entry-body"><button class="entry-title"><a href="#" rel="bookmark">Clover Honey</a></button></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 menu-grid">
                                        <div class="menu-img">
                                            <div class="menu-block has-post-thumbnail">
                                                <div class="entry-thumbnail"><img width="330" height="331" src="images/h6.jpeg" class="attachment-full size-full wp-post-image" alt="" /></div>
                                            </div>
                                        </div>
                                        <div class="menu-grid-col">
                                            <div class="entry-body"><button class="entry-title"><a href="#" rel="bookmark">Acacia Honey</a></button></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 menu-grid">
                                        <div class="menu-img">
                                            <div class="menu-block has-post-thumbnail">
                                                <div class="entry-thumbnail"><img width="330" height="331" src="images/h8.webp" class="attachment-full size-full wp-post-image" alt="" /></div>
                                            </div>
                                        </div>
                                        <div class="menu-grid-col">
                                            <div class="entry-body"><button class="entry-title"><a href="#" rel="bookmark">Dandelion Honey</a></button></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 menu-grid">
                                        <div class="menu-img">
                                            <div class="menu-block has-post-thumbnail">
                                                <div class="entry-thumbnail"><img width="329" height="331" src="images/h9.jpeg" class="attachment-full size-full wp-post-image" alt="" /></div>
                                            </div>
                                        </div>
                                        <div class="menu-grid-col">
                                            <div class="entry-body"><button class="entry-title"><a href="#" rel="bookmark">Linden Honey</a></button></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 menu-grid">
                                        <div class="menu-img">
                                            <div class="menu-block has-post-thumbnail">
                                                <div class="entry-thumbnail"><img width="330" height="331" src="images/h11.jpeg" class="attachment-full size-full wp-post-image" alt="" /></div>
                                            </div>
                                        </div>
                                        <div class="menu-grid-col">
                                            <div class="entry-body"><button class="entry-title"><a href="#" rel="bookmark">Orange Blossom Honey</a></button></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 menu-grid">
                                        <div class="menu-img">
                                            <div class="menu-block has-post-thumbnail">
                                                <div class="entry-thumbnail"><img width="330" height="331" src="images/h15.webp" class="attachment-full size-full wp-post-image" alt="" /></div>
                                            </div>
                                        </div>
                                        <div class="menu-grid-col">
                                            <div class="entry-body"><button class="entry-title"><a href="#" rel="bookmark">Wildflower Honey</a></button></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 menu-grid">
                                        <div class="menu-img">
                                            <div class="menu-block has-post-thumbnail">
                                                <div class="entry-thumbnail"><img width="329" height="331" src="images/h13.webp" class="attachment-full size-full wp-post-image" alt="" /></div>
                                            </div>
                                        </div>
                                        <div class="menu-grid-col">
                                            <div class="entry-body"><button class="entry-title"><a href="#" rel="bookmark">Buckwheat honey</a></button></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 menu-grid">
                                        <div class="menu-img">
                                            <div class="menu-block has-post-thumbnail">
                                                <div class="entry-thumbnail"><img width="330" height="331" src="images/h14.webp" class="attachment-full size-full wp-post-image" alt="" /></div>
                                            </div>
                                        </div>
                                        <div class="menu-grid-col">
                                            <div class="entry-body"><button class="entry-title"><a href="#" rel="bookmark">Sage honey</a></button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="meetchef" class="section meetchef-section" data-eltype="frontpagesection">
                        <div class="section-inner">
                            <div class="bg-contact"></div>
                            <div class="section-inner">
                                <div class="section-header">
                                    <div class="section-title">
                                        <p>Unlock the hives of our partners</p>
                                    </div>
                                </div>
                                <div class="section-content container">
                                    <div class="meetchef-grid row">
                                        <div class="meetchef-grid-col col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                            <div class="blog-img">
                                                <div class="blog-block has-post-thumbnail">
                                                    <div class="entry-thumbnail"><img width="423" height="362" src="images/apiary4.jpg" class="attachment-full size-full wp-post-image" alt="" /></div>
                                                </div>
                                            </div>
                                            <div class="entry-body">
                                                <h6 class="entry-title">Inzerki Apiary</h6>
                                                <div class="entry-position">Agadir, Morocco </div>
                                                <p>The Inzerki Apiary in the Souss-Massa region 82 kilometers north of Agadir is the largest traditional collective apiary, or bee yard, in the world. The population living around the apiary is only in 100s, and most of them are beekeepers.</p>
                                                <ul>
                                                    <li><a class="fb" href="#" target="_blank" rel="noopener">facebook</a> /</li>
                                                    <li><a class="tw" href="#" target="_blank" rel="noopener">twitter</a> /</li>
                                                    <li><a class="in" href="#" target="_blank" rel="noopener">linkedin</a> /</li>
                                                    <li><a class="insta" href="#" target="_blank" rel="noopener">instagram</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="meetchef-grid-col col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                            <div class="blog-img">
                                                <div class="blog-block has-post-thumbnail">
                                                    <div class="entry-thumbnail">
                                                        <img width="423" height="362" src="images/apiary2.jpg" class="attachment-full size-full wp-post-image" alt="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="entry-body">
                                                <h6 class="entry-title">Rock Hill Honey Bee Farm</h6>
                                                <div class="entry-position">Stafford, VA</div>
                                                <p>Their farm sits on five acres of land, and their staff takes great pride in caring for the bees, offering advice and assistance, and providing the highest quality products.</p>
                                                <ul>
                                                    <li><a class="fb" href="#" target="_blank" rel="noopener">facebook</a> /</li>
                                                    <li><a class="tw" href="#" target="_blank" rel="noopener">twitter</a> /</li>
                                                    <li><a class="in" href="#" target="_blank" rel="noopener">linkedin</a> /</li>
                                                    <li><a class="insta" href="#" target="_blank" rel="noopener">instagram</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="meetchef-grid-col col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                            <div class="blog-img">
                                                <div class="blog-block has-post-thumbnail">
                                                    <div class="entry-thumbnail"><img width="423" height="362" src="images/apiary6.jpg" class="attachment-full size-full wp-post-image" alt="" /></div>
                                                </div>
                                            </div>
                                            <div class="entry-body">
                                                <h6 class="entry-title">Kashmir Apiaries Exports</h6>
                                                <div class="entry-position">Doraha, Ludhiana, India</div>
                                                <p>Kashmir Apiaries has 50,000 bee colonies across India. It is considered the largest exporter in the country and supplies to a good number of nations around the globe. </p>
                                                <ul>
                                                    <li><a class="fb" href="#" target="_blank" rel="noopener">facebook</a> /</li>
                                                    <li><a class="tw" href="#" target="_blank" rel="noopener">twitter</a> /</li>
                                                    <li><a class="in" href="#" target="_blank" rel="noopener">linkedin</a> /</li>
                                                    <li><a class="insta" href="#" target="_blank" rel="noopener">instagram</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>


                    <section id="blog" class="section blog-section" data-eltype="frontpagesection">
                        <div class="section-inner">
                            <div class="section-header">
                                <div class="section-title">
                                    <p>read blog articles</p>
                                </div>
                                <div class="section-subtitle">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipi scing elit, sed do eiusmod tempor incididunt ut labore et dolore morbi Lorem ipsum dolor sit amet adipiscing.</p>
                                </div>
                            </div>
                            <div class="section-content">
                                <div id="slider-blog">
                                    <div class="article-grid-col">
                                        <article class="grid-hentry post-89 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized">
                                            <div class="post-single">
                                                <div class="post-thumbnail">
                                                    <img width="404" height="312" src="images/15.jpg" class="attachment-full size-full wp-post-image" alt="" />
                                                </div>
                                                <div class="content">
                                                    <header class="entry-header">
                                                        <h3 class="entry-title"><a href="#" rel="bookmark">Make Dirt Pudding Just Like Mom Used To do</a></h3>
                                                    </header>
                                                    <div class="entry-summary"></div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="article-grid-col">
                                        <article class="grid-hentry post-87 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized">
                                            <div class="post-single">
                                                <div class="post-thumbnail"><img width="404" height="315" src="images/16.jpg" class="attachment-full size-full wp-post-image" alt="" /></div>
                                                <div class="content">
                                                    <header class="entry-header">
                                                        <h3 class="entry-title"><a href="#" rel="bookmark">Make Dirt Pudding Just Like Mom Used To do</a></h3>
                                                    </header>
                                                    <div class="entry-summary"></div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="article-grid-col">
                                        <article class="grid-hentry post-85 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized">
                                            <div class="post-single">
                                                <div class="post-thumbnail"><img width="404" height="315" src="images/17.jpg" class="attachment-full size-full wp-post-image" alt="" /></div>
                                                <div class="content">
                                                    <header class="entry-header">
                                                        <h3 class="entry-title"><a href="#" rel="bookmark">Mummy Hot Dogs Are A Must At Your Halloween Party</a></h3> <!--  -->
                                                        <!-- <button class="link-post"><a href="">Continue Reading</a></button> -->
                                                    </header>
                                                    <div class="entry-summary"></div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="article-grid-col">
                                        <article class="grid-hentry post-82 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized">
                                            <div class="post-single">
                                                <div class="post-thumbnail"><img width="404" height="312" src="images/15.jpg" class="attachment-full size-full wp-post-image" alt="" /></div>
                                                <div class="content">
                                                    <header class="entry-header">
                                                        <h3 class="entry-title"><a href="#" rel="bookmark">Make Dirt Pudding Just Like Mom Used To do</a></h3> <!--  -->
                                                        <!-- <button class="link-post"><a href="">Continue Reading</a></button> -->
                                                    </header>
                                                    <div class="entry-summary"></div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="article-grid-col">
                                        <article class="grid-hentry post-79 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized">
                                            <div class="post-single">
                                                <div class="post-thumbnail"><img width="404" height="315" src="images/16.jpg" class="attachment-full size-full wp-post-image" alt="" /></div>
                                                <div class="content">
                                                    <header class="entry-header">
                                                        <h3 class="entry-title"><a href="#" rel="bookmark">Make Dirt Pudding Just Like Mom Used To do</a></h3> <!--  -->
                                                        <!-- <button class="link-post"><a href="">Continue Reading</a></button> -->
                                                    </header>
                                                    <div class="entry-summary"></div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="article-grid-col">
                                        <article class="grid-hentry post-76 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized">
                                            <div class="post-single">
                                                <div class="post-thumbnail"><img width="404" height="315" src="images/17.jpg" class="attachment-full size-full wp-post-image" alt="" /></div>
                                                <div class="content">
                                                    <header class="entry-header">
                                                        <h3 class="entry-title"><a href="#" rel="bookmark">Mummy Hot Dogs Are A Must At Your Halloween Party</a></h3>
                                                    </header>
                                                    <div class="entry-summary"></div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="subscribe" class="section subscribe-section" data-eltype="frontpagesection" style="background-image:url(images/19.jpg);">
                        <div class="boc-section">
                            <div class="section-inner">
                                <div class="content-info-1">
                                    <div class="section-body">
                                        <div class="section-header">
                                            <div class="section-title">
                                                <p>Write A Review</p>
                                            </div>
                                            <div class="section-content">
                                                <p>Step into the HiveToHome review realm, where your feedback crafts a honeyed narrative. Your words, like bees to blossoms, help us curate excellence for your doorstep. Share your story, enrich our hive.</p>
                                            </div>
                                        </div>
                                        <div class="newsletter-col">
                                            <div>
                                                <div class="screen-reader-response"></div>
                                                <form class="wpcf7-form">
                                                    <div class="c-cot-1">
                                                        <span class="wpcf7-form-control-wrap your-name">
                                                            <input type="text" name="your-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Rating(/10)" required />
                                                        </span>
                                                    </div>
                                                    <div class="c-cot-2">
                                                        <span class="wpcf7-form-control-wrap your-email">
                                                            <input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Comment" required />
                                                        </span>
                                                    </div>
                                                    <div class="c-cot-3"><input type="submit" value="Review" class="wpcf7-form-control wpcf7-submit" /></div>
                                                    <div class="wpcf7-response-output wpcf7-display-none"></div>
                                                    <p style="display: none !important">
                                                        <span class="wpcf7-form-control-wrap referer-page">
                                                            <input type="hidden" name="referer-page" value="direct visit" class="wpcf7-form-control wpcf7-text referer-page" aria-invalid="false">
                                                        </span>
                                                    </p>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="about" class="section about-section" data-eltype="frontpagesection">
                        <div class="section-inner">
                            <div class="container">
                                <div class="row">
                                    <div class="content-info-1 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="section-body">
                                            <div class="section-header">
                                                <div class="section-title">
                                                    <p>About HiveToHome</p>
                                                </div>
                                            </div>
                                            <div class="section-content" id="slide-meetour">
                                                <div class="section-about">
                                                    <p>"Hive To Home is an online platform for easy honey ordering and efficient apiary management. It offers customers a seamless way to buy honey products. Home To Hive offers a user-friendly interface that facilitates the seamless purchase of high-quality honey products.It not only revolutionizes the honey ordering process but also fosters a sense of community among apiarists and honey enthusiasts</p>
                                                </div>
                                                <a href="#" class="about-link" rel="about" target="_blank">Read More</a><span>...</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content-info-2 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="section-body">
                                            <div class="section-header">
                                                <div class="section-title">
                                                    <p>Contact Us</p>
                                                </div>
                                                <div class="section-content">
                                                    <br>
                                                    <br><br>
                                                    <p style="text-align: center">Phone: <a href="tel:">+91 8660527370</a><br />
                                                        <a href="mailto:">ashalpearl@gmail.com</a> / <a href="http:">alriyatreeza@gmail.com</a></p>
                                                    <ul>
                                                        <li style="text-align: center"><a class="fb" href="#" target="_blank" rel="noopener">facebook</a> /</li>
                                                        <li style="text-align: center"><a class="tw" href="#" target="_blank" rel="noopener">twitter</a> /</li>
                                                        <li style="text-align: center"><a class="in" href="#" target="_blank" rel="noopener">linkedin</a> /</li>
                                                        <li style="text-align: center"><a class="pint" href="#" target="_blank" rel="noopener">pinterest</a> /</li>
                                                        <li style="text-align: center"><a class="insta" href="#" target="_blank" rel="noopener">instagram</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <br>
                    <br>
                </main>
            </div>
        </div>

        <footer id="colophon" class="site-footer text-center">

            <div class="footer-bottom">
                <div class="container">
                    <div class="footer-menu-container">
                        <ul id="footer-menu" class="footer-menu">
                            <li class="menu-item"><a href="index.html">Home</a></li>
                            <li class="menu-item"><a href="#about">About Us</a></li>
                            <li class="menu-item"><a href="#menu">Our Menu</a></li>
                            <li class="menu-item"><a href="#gallery">View Gallery</a></li>
                            <li class="menu-item"><a href="#testimonials">Client Testimonials</a></li>
                            <li class="menu-item"><a href="#blog">blog</a></li>
                            <li class="menu-item"><a href="#contact">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="site-info">
                        <p>(C) 2019. All Rights Reserved. Designed &amp; Developed by <a href="template.net" target="_blank" rel="noopener">Template.net</a></p>
                    </div>
                </div>
            </div>
        </footer>
        <a href="javascript:void(0)" class="back-to-top" data-eltype="totopbtn">
            <span class="screen-reader-text">Back to top</span>
            <i class="fa fa-angle-up"></i>
        </a>
    </div>
    <script type='text/javascript' src='js/core.min.js'></script>
    <script type='text/javascript' src='js/datepicker.min.js'></script>
    <script type='text/javascript'>
        jQuery(document).ready(function(jQuery) {
            jQuery.datepicker.setDefaults({
                "closeText": "Close",
                "currentText": "Today",
                "monthNames": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                "monthNamesShort": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                "nextText": "Next",
                "prevText": "Previous",
                "dayNames": ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                "dayNamesShort": ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                "dayNamesMin": ["S", "M", "T", "W", "T", "F", "S"],
                "dateFormat": "MM d, yy",
                "firstDay": 1,
                "isRTL": false
            });
        });

    </script>
    <script type='text/javascript' src='js/bootstrap.min.js'></script>
    <script type='text/javascript' src='js/jquery-ui-timepicker-addon.min.js'></script>
    <script type='text/javascript' src='js/jquery-ui-sliderAccess.js'></script>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js'></script>
    <script type='text/javascript'>
        var qasaLocalize = {
            "isfront": "1",
            "homeurl": "index.html"
        };
    </script>
    <script type='text/javascript' src='js/script.min.js'></script>
    <script type="text/javascript">
        jQuery(function($) {
            $('input[name="date-772"]').datepicker({
                "dateFormat": "M.dd",
                "controlType": "slider",
                "addSliderAccess": true,
                "sliderAccessArgs": {
                    "touchonly": true
                },
                "stepHour": 1,
                "stepMinute": 1,
                "stepSecond": 1
            }).datepicker('option', 'minDate', "").datepicker('option', 'maxDate', "").datepicker('refresh');
        });

    </script>

    <script type="text/javascript">
        jQuery(function($) {
            $('input[name="time-398"]').timepicker({
                "timeFormat": "H:mm",
                "addSliderAccess": true,
                "sliderAccessArgs": {
                    "touchonly": true
                }
            }).timepicker('refresh');
        });

    </script>
</body>

</html>
