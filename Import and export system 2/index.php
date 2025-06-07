<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- fontawesome  -->
    <script src="https://kit.fontawesome.com/3e1d046fbe.js" crossorigin="anonymous"></script>
    <!-- webSite icon  -->
    <link rel="shortcut icon" href="images/icon.png">
    <!-- main css  -->
    <link rel="stylesheet" href="css/main.css">
    <title>MyWarehouse</title>
</head>

<body>
    <!-- start home section  -->
    <section class="home-section" id="home">
        <img src="images/bg-image.jpg" alt="">
    </section>
    <!-- start header  -->
    <header class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- start logo  -->
                        <div class="logo">
                            <a href="index.php"><span>My</span>Warehouse </a>
                        </div>
                        <!-- end logo  -->
                        <!-- Menu start  -->
                        <i class="fa-solid fa-bars toggle-menu"></i>
                        <ul class="links">
                            <li><a href="index.php" class="active">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#services">Services</a></li>
                            <li><a href="#features">Features</a></li>
                            <li><a href="logIn.php" class="signIn">SignIn</a></li>
                        </ul>


                        <!-- Menu end  -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <div class="main-banner">
        <!-- <div class="ques">
            <p>"Having trouble <br> managing inventory and branches?"</p>
        </div> -->
        <div class="ans">
            <p> With <span>MyWarehouse</span>, we provide the ultimate solution to track your inventory, organize branches, and maximize efficiency with ease .
            </p>
        </div>
    </div>
    <!-- end header  -->
    <!-- end home section  -->

    <!-- start about  -->
    <section id="about">
        <div class="container">
            <!-- <div class="row">
                <div class="col-12">
                    <h2 class="section-header about">About Us</h2>
                </div>
            </div> -->
            <div class="row">
                <div class="col-6">
                    <img src="images/aboutUs img.png" alt="">
                </div>
                <div class="col-6 aboutText">
                    <p>
                        "At <span>MyWarehouse</span>, we believe that efficient inventory management is the backbone of every successful business. Our platform is designed to simplify the way you manage your stock, track distributions, and analyze performance—all in one place."
                    </p>
                    <p>
                        "What sets us apart is our user-friendly interface, secure data handling, and advanced analytics tools. Whether you’re managing a small shop or a large chain, <span>MyWarehouse</span> adapts to your needs."
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- end about  -->

    <!-- start services  -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-3 serv1">
                    <img src="images/service1.png" alt="">
                    <h3>Branch Management</h3>
                    <p>"Organize and manage your branches effortlessly, including their locations and performance tracking."</p>
                </div>
                <div class="col-3 serv2">
                    <img src="images/serv2.png" alt="">
                    <h3>Inventory Management</h3>
                    <p>"Easily add, edit, and track your stock in real time, ensuring your inventory is always up-to-date."</p>
                </div>
                <div class="col-3 serv3">
                    <img src="images/service3.png" alt="">
                    <h3>Advanced Analytics</h3>
                    <p>"Gain insights into your inventory and sales with detailed reports and charts."</p>
                </div>
                <div class="col-3 serv4">
                    <img src="images/serv4.png" alt="">
                    <h3>Goods Distribution</h3>
                    <p>"Distribute goods to your branches with precision, while keeping your main stock updated automatically."</p>
                </div>
            </div>
        </div>
    </section>
    <!-- end services  -->

    <!-- start features  -->
    <section id="features">
        <div class="icons">
            <i class="fa-solid fa-chart-line icon1"></i>
            <i class="fa-solid fa-list-check icon2"></i>
            <i class="fa-solid fa-truck-moving icon3"></i>
            <i class="fa-solid fa-truck-ramp-box icon4"></i>
        </div>
        <div class="features-ques">
            <h3>What makes <span>MyWarehouse</span> <br>the perfect choice for your business ?</h3>
        </div>
        <div class="features-content">
            <div class="container features">
                <div class="row">
                    <div class="col-2 feat1 btn active" data-id="feat1">Simplified Inventory Management</div>
                    <div class="col-2 feat2 btn" data-id="feat2">Real-Time Updates</div>
                    <div class="col-2 feat3 btn" data-id="feat3">Advanced Search and Filters</div>
                    <div class="col-2 feat4 btn" data-id="feat4">Secure Data Handling</div>
                    <div class="col-2 feat5 btn" data-id="feat5">Comprehensive Analytics Dashboard</div>
                    <div class="col-2 feat6 btn" data-id="feat6">User-Friendly Design</div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="content active" id="feat1">
                            <p>"Track, organize, and manage your stock with just a few clicks."</p>
                        </div>
                        <div class="content" id="feat2">
                            <p>"Get instant updates on stock changes, distributions, and performance analytics."</p>
                        </div>
                        <div class="content" id="feat3">
                            <p>"Easily search and sort your inventory by name, quantity, or arrival date."</p>
                        </div>
                        <div class="content" id="feat4">
                            <p>"Your data is encrypted and protected with the highest security standards."</p>
                        </div>
                        <div class="content" id="feat5">
                            <p>"Analyze your stock performance and profits with interactive charts and reports."</p>
                        </div>
                        <div class="content" id="feat6">
                            <p>"An intuitive interface designed to save you time and effort."</p>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </section>
    <!-- end features  -->
    <a href="#home" class="scroll-link top-link">
        <i class="fa-solid fa-arrow-up"></i>
    </a>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="text">
                        <h4>MyWarehouse</h4>
                        <p>Simplify your inventory, streamline your operations, and watch your business grow with MyWarehouse.</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="footer-links">
                        <h5>Links</h5>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#services">Services</a></li>
                            <li><a href="#features">Features</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p>&copy; 2025 MyWarehouse. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <a href="#home" class="scroll-link top-link">
        <i class="fa-solid fa-arrow-up"></i>
    </a>
    <script src="js/app.js"></script>
</body>

</html>