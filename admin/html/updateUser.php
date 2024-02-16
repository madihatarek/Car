<?php
    //check user logged
    include_once( 'includes/loginCkecker.php' );
    // db connection
    include_once( '../conn.php' );
    //get id if found.
    if ( isset( $_GET[ 'user_id' ] ) ) {
        $user_id = $_GET[ 'user_id' ];
    } else {
        header( 'location:users.php' );
        die;
    }
    //START update user
    if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
        try {
            $sql = "UPDATE `users` SET `name`=?,`password`=?,`email`=?,`active`=? WHERE `user_id`=?";
            $name = $_POST[ 'name' ];
            $email = $_POST[ 'email' ];
            if ( empty( $_POST[ 'password' ] ) ) {
                $password = $_POST[ 'oldPassword' ];
            } else {
                $password = password_hash( $_POST[ 'password' ], PASSWORD_DEFAULT );
            }
            $active = isset( $_POST[ 'active' ] );
            $stmt = $conn->prepare( $sql );
            $stmt->execute([$name, $password, $email, $active, $user_id]);
            // echo 'updated Successfuly';
            header( 'location:users.php' );
            die;
        }catch( PDOException $e ) {
        $errMsg = $e->getMessage();
       }
    }else {
        echo 'invalid';
    }

    // start user person data...
    try {
        $sql = 'SELECT * FROM `users` WHERE `user_id` = ?';
        $stmt = $conn->prepare( $sql );
        $stmt->execute( [ $user_id ] );
        // if ( $stmt->rowCount() ) {
        $row_result = $stmt->fetch();
        $name = $row_result[ 'name' ];
        $email = $row_result[ 'email' ];
        $password = $row_result['password'];
        $active = $row_result[ 'active' ]?'checked':'';
        // }
    } catch( PDOException $e ) {
        $errMsg = $e->getMessage();
    }
    //end select user data...
?>
<!doctype html>
<html lang='en'>
<head>
    <?php
$title = 'Update User';
include_once( 'includes/head.php' );
?>
    <style>
    .err {
        color: #f00;
    }
    </style>
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
                        <!-- <?php
if ( isset( $_GET[ 'updated' ] ) && $_GET[ 'updated' ] == 'success' ) {
    ?>
    <div class = 'alert alert-success'>
    <strong>Success!</strong>Updated_Successfuly
    </div>
    <?php
}
?> -->
                        <h2>update Users</h2>
                        <form action='' method='post'>
                            <div class='mb-3'>
                                <label for='name' class='form-label'>Name</label>
                                <input type='text' class='form-control' id='name' aria-describedby='emailHelp'
                                    name='name' value="<?php echo $name?>">
                            </div>
                            <br>
                            <div class='mb-3'>
                                <label for='exampleInputEmail1' class='form-label'>Email address</label>
                                <input type='email' class='form-control' id='exampleInputEmail1'
                                    aria-describedby='emailHelp' name='email' value="<?php echo $email?>">

                                <div id='emailHelp' class='form-text'>We'll never share your email with anyone else.
                                </div>
                            </div>
                            <br>
                            <div class='mb-3'>
                                <label for='exampleInputPassword1' class='form-label'>Password</label>
                                <input type='password' class='form-control' id='exampleInputPassword1' name='password'>

                            </div>
                            <br>
                            <div class='mb-3 form-check'>
                                <input type='checkbox' class='form-check-input' id='active' name='active'
                                    <?php echo $active?>>
                                <label class='form-check-label' for='active'>Active</label>
                            </div>
                            <input type="hidden" name="oldPassword" value=<?php echo $password ?>>
                            <button type='submit' class='btn btn-primary'>Update</button>
                        </form>
                    </div>
                </div>
            </div>

            <?php
    include_once( 'includes/footerJS.php' );
?>
</body>

</html>