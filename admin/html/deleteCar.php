<?php
   include_once( 'includes/loginCkecker.php' );
   include_once('../conn.php');
    if ( isset( $_GET[ 'id' ]) &&  $_GET[ 'id' ] > 0 ) {
        try {
           $id = $_GET['id'];
           $sql = 'DELETE FROM `cars` WHERE `id`= ?';
           $stmt = $conn->prepare($sql);
           $stmt->execute([$id]);
           $msg = 'Deleted Successfuly';
           $alert = "alert-success";
        //    echo 'Deleted Successfuly';
            // header( 'Location:carList.php?delete=success' );
            // exit;
        } catch( PDOException $e ) {
            $msg = 'Error'.$e->getMessage();
            $alert = "alert-danger";
        }
    } else {
        echo 'Invalid Request';
    
    }
?>
<!doctype html>
<html lang='en'>

<head>
    <?php
$title = 'Delete Car';
include_once( 'includes/head.php' );
?>
</head>

<body>
    <!--  Body Wrapper -->
    <div class='page-wrapper' id='main-wrapper' data-layout='vertical' data-navbarbg='skin6' data-sidebartype='full'
        data-sidebar-position='fixed' data-header-position='fixed'>
        <!-- Sidebar Start -->
        <aside class='left-sidebar'>
            <?php
include_once( 'includes/sideScroller.php' );
include_once( 'includes/navigation.php' );
?>

        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class='body-wrapper'>
            <?php
include_once( 'includes/header.php' );
?>
            <div class='container-fluid'>
                <div class='card'>
                    <div class='card-body'>
                        <h5><?php echo $title?></h5>
                        <div class='alert <?php echo $alert?>'>
                            <strong><?php echo $msg?></strong>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php
    include_once( 'includes/footerJS.php' );
    ?>
</body>

</html>