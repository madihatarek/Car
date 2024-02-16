<!DOCTYPE html>
<html lang="en">

<head>
  <?php
    $current_page = basename($_SERVER['PHP_SELF']);
    $title = "Car Project";
    include_once('includes/head.php');
  ?>
</head>

<body>
  <?php
    include_once('includes/topbar.php');
    include_once('includes/navbar.php');
    include_once('includes/search.php');
    include_once('includes/carousel.php');
    include_once('includes/about.php');
    include_once('includes/services.php');
    include_once('includes/banner.php');
    include_once('includes/rentAcar.php');
    include_once('includes/team.php');
    include_once('includes/banner2.php');
    include_once('includes/testimonial.php');
    include_once('includes/contact.php');
    include_once('includes/vendor.php');
    include_once('includes/footer.php');
    include_once('includes/backTotop.php');
    include_once('includes/footerJS.php');
  ?>
    
</body>

</html>