<?php
   include_once( 'includes/loginCkecker.php' );
   include_once('../conn.php');
    if ( isset( $_GET[ 'user_id' ] )) {
        try {
           $user_id = $_GET['user_id'];
           $sql = 'DELETE FROM `users` WHERE `user_id`= ?';
           $stmt = $conn->prepare($sql);
           $stmt->execute([$user_id]);
        //    echo 'Deleted Successfuly';
            header( 'Location:users.php?delete=success' );
            exit;
        } catch( PDOException $e ) {
            $errMsg = $e->getMessage();
        }
    } else {
        echo 'Invalid Request';
    
    }
    
   
?>