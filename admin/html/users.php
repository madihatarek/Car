<?php
include_once( 'includes/loginCkecker.php' );
include_once( '../conn.php' );
try {
    $sql = 'SELECT * FROM `users`';
    $stmt = $conn->prepare( $sql );
    $stmt->execute();
} catch( PDOException $e ) {
    $errMsg =  $e->getMessage();
}
?>
<!doctype html>
<html lang='en'>

<head>
    <?php
$title = 'Users';
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
                        <div class='d-flex ' style='justify-content: space-between;'>
                            <h5 class='card-title fw-semibold mb-4'>
                                <?php echo $title;
?>
                            </h5>
                            <a href='insertUser.php'>
                                <div class='d-flex '>
                                    <img src='../assets/images/user.png' height='22px'>
                                    <h5 class='card-title fw-semibold mb-4' style='text-decoration-line: underline;'>
                                        Add a new user?
                                    </h5>
                                </div>
                            </a>
                        </div>
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Active</th>
                                    <th>Delete</th>
                                    <th>UPdate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
foreach ( $stmt->fetchAll() as $row ) {
    $user_id = $row[ 'user_id' ];
    $name = $row[ 'name' ];
    $email = $row[ 'email' ];
    // $active = $row[ 'active' ];
    if ( $row[ 'active' ] ) {
        $active =  $row[ 'active' ] = 'YES';
    } else {
        $active =  $row[ 'active' ] = 'NO';
    }
    $create_at = date( 'd M Y', strtotime( $row[ 'created_at' ] ) );
    ?>
                                <tr>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo $email ?></td>
                                    <td><?php echo $create_at ?></td>
                                    <td><?php echo $active ?></td>
                                    <td><a href="deleteUser.php?user_id=<?php echo $user_id ?>" onclick="return confirm('Are you sure you want to delete?')">
                                    <img src='../assets/images/delete.png' height='22px' alt='delete image'></a>
                                    </td>
                                    <td><a href="updateUser.php?user_id=<?php echo $user_id ?>"  onclick="return confirm('Are you sure you want to update?')" >
                                    <img src='../assets/images/edit.png' height='22px' alt='edit image'></a></td>
                                </tr>
                                <?php }
    ?>
                            </tbody>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
        <?php
    include_once( 'includes/footerJS.php' );
    ?>
</body>

</html>