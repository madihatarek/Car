<?php
include_once( 'includes/loginCkecker.php' );
include_once( '../conn.php' );
$nameErr = $emailErr = $passErr =  '';
$errors = 0;
if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
    if ( isset( $_POST[ 'name' ] ) and empty( $_POST[ 'name' ] ) ) {
        $nameErr = 'Please enter your name';
        $errors++;
    }

    if ( isset( $_POST[ 'email' ] ) and empty( $_POST[ 'email' ] ) ) {
        $emailErr = 'Please enter your email';
        $errors++;
    }

    if ( isset( $_POST[ 'password' ] ) and empty( $_POST[ 'password' ] ) ) {
        $passErr = 'Password is required';
        $errors++;
    }
    if ( $errors == 0 ) {
        try {
            $sql = "INSERT INTO `users`(`name`, `password`, `email`,`active`) 
      VALUES (?, ?, ?, ?)";
            $name = $_POST[ 'name' ];
            $password = password_hash( $_POST[ 'password' ], PASSWORD_DEFAULT );
            $email = $_POST[ 'email' ];
            // if ( isset( $_POST[ 'active' ] ) ) {
            //     $active = $_POST[ 'active' ];
            //     $active = 1;
            // } else {
            //     $active = 0;
            // }
            $active =isset($_POST[ 'active' ]);
            $stmt = $conn->prepare( $sql );
            $stmt->execute( [ $name, $password, $email, $active ] );
            // echo 'Inserted Successfuly';
            header('location:insertUser.php?insert=success');
            die;
        } catch ( PDOException $e ) {
            echo 'falied insert: '.$e->getMessage();
        }
    }
}
?>
<!doctype html>
<html lang='en'>

<head>
    <?php
$title = 'Add Users';
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
                    <?php
if ( isset( $_GET[ 'insert' ] ) && $_GET[ 'insert' ] == 'success' ) {
    ?>
                        <div class='alert alert-success'>
                            <strong>Success!</strong>Inserted_Successfuly
                        </div>
                        <?php
}
?>
                        <h2>Add to Users</h2>
                        <form action='' method='post'>
                            <div class='mb-3'>
                                <label for='name' class='form-label'>Name</label>
                                <input type='text' class='form-control' id='name' aria-describedby='emailHelp'
                                    name='name'>
                                <span calss='err'><?php echo $nameErr?></span>
                            </div>
                            <br>
                            <div class='mb-3'>
                                <label for='exampleInputEmail1' class='form-label'>Email address</label>
                                <input type='email' class='form-control' id='exampleInputEmail1'
                                    aria-describedby='emailHelp' name='email'>
                                <span calss='err'><?php echo $emailErr?></span>
                                <div id='emailHelp' class='form-text'>We'll never share your email with anyone else.
                                </div>
                            </div>
                            <br>
                            <div class='mb-3'>
                                <label for='exampleInputPassword1' class='form-label'>Password</label>
                                <input type='password' class='form-control' id='exampleInputPassword1' name='password'>
                                <span calss='err'><?php echo $passErr?></span>
                            </div>
                            <br>
                            <div class='mb-3 form-check'>
                                <input type='checkbox' class='form-check-input' id='active' name='active'>
                                <label class='form-check-label' for='active'>Active</label>
                            </div>
                            <button type='submit' class='btn btn-primary'>Insert</button>
                        </form>
                    </div>
                </div>
            </div>

            <?php
    include_once( 'includes/footerJS.php' );
?>
</body>

</html>