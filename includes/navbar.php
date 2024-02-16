    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="position-relative px-lg-5" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-secondary navbar-dark py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="" class="navbar-brand">
                    <h1 class="text-uppercase text-primary mb-1">Royal Cars</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="index.php" class="nav-item nav-link <?php echo $current_page == 'index.php' ? 'active':''; ?>">Home</a>            
                        <a href="about.php" class="nav-item nav-link <?php echo $current_page == 'about.php' ? 'active':''; ?>">About</a>
                        <a href="service.php" class="nav-item nav-link <?php echo $current_page == 'service.php' ? 'active':''; ?>">Service</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle <?php echo $current_page == 'car.php'|  
                            $current_page == 'detail.php'|  
                            $current_page == 'booking.php' ? 'active':''; ?>" 
                            data-toggle="dropdown">Cars</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="car.php" class="dropdown-item <?php echo $current_page == 'car.php' ? 'active':''; ?>">Car Listing</a>
                                <a href="detail.php" class="dropdown-item <?php echo $current_page == 'detail.php' ? 'active':''; ?>">Car Detail</a>
                                <a href="booking.php" class="dropdown-item <?php echo $current_page == 'booking.php' ? 'active':''; ?>">Car Booking</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle <?php echo $current_page == 'team.php'|   
                            $current_page == 'testimonial.php' ? 'active':''; ?> "  
                            data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="team.php" class="dropdown-item <?php echo $current_page == 'team.php' ? 'active':''; ?>">The Team</a>
                                <a href="testimonial.php" class="dropdown-item <?php echo $current_page == 'testimonial.php' ? 'active':''; ?>">Testimonial</a>
                            </div>
                        </div>
                        <a href="contact.php" class="nav-item nav-link <?php echo $current_page == 'contact.php' ? 'active':''; ?>">Contact</a>
                       
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->