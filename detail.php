<!DOCTYPE html>
<html lang="en">

<head>
<?php  
   $current_page = basename($_SERVER['PHP_SELF']);
    $pageHeader = "CAR DETAIL";
    $title = "Detail";
    include_once('includes/head.php');
  ?>
</head>

<body>
    <?php
        include_once('includes/topbar.php');
        include_once('includes/navbar.php');
        include_once('includes/search.php');   
        include_once("includes/pageHeader.php");
        include_once('includes/details.php');
        include_once('includes/relatedCar.php');
        include_once('includes/vendor.php');
        include_once('includes/footer.php');
        include_once('includes/backTotop.php');
        include_once('includes/footerJS.php');
    ?> 
</body>

</html>