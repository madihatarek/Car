<?php
include_once( 'includes/loginCkecker.php' );
if ( isset( $_GET[ 'id' ] ) &&  $_GET[ 'id' ] > 0 ) {
    $id = $_GET[ 'id' ];
    include_once( '../conn.php' );
    //Update car into DB...
    if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
        try {
            $sql = "UPDATE `cars` SET `title` =?,`image` = ?, `content` = ?,`model` = ?,
            `automatic` = ?,`consumption` = ?,`options` = ?,`price` = ?,
            `category_id` = ?, `published` = ? WHERE `id` = ?";
            $title = $_POST[ 'title' ];
            if ( $_FILES[ 'image' ][ 'error' ] === UPLOAD_ERR_OK ) {
                include_once( 'includes/upload.php' );
                $carImage = $image_name;
            } else {
                $carImage = $_POST[ 'oldImage' ];
            }
            $content = $_POST[ 'content' ];
            $model = $_POST[ 'model' ];
            $consumption = $_POST[ 'consumption' ];
            $options = $_POST[ 'options' ];
            $price = $_POST[ 'price' ];
            $category_id  = $_POST[ 'category_id' ];
            $automatic = ( isset( $_POST[ 'automatic' ] ) );
            $published = ( isset( $_POST[ 'published' ] ) );
            $stmtUpdata = $conn->prepare( $sql );
            $stmtUpdata->execute( [ $title, $carImage, $content, $model,
            $automatic, $consumption, $options, $price, $category_id, $published, $id ] );
            // echo 'updated Successfuly';
        } catch ( PDOException $e ) {
            echo 'falied update: '.$e->getMessage();
        }
    }

    // end updated..
    // show categories data/..
    try {
        $sql = 'SELECT * FROM `categories` ';
        $stmt = $conn->prepare( $sql );
        $stmt->execute();
        $resultCateg = $stmt->fetchAll();
    } catch( PDOException $e ) {
        $errMsg =  $e->getMessage();
    }
    // end select category.
    // show selected car details...
    try {
        $sql = 'SELECT * FROM `cars` WHERE `id` = ? ';
        $id=$_GET['id'];
        $stmtCar = $conn->prepare( $sql );
        $stmtCar->execute( [ $id ] );
        $resultCar = $stmtCar->fetch();
        $automatic = $resultCar[ 'automatic' ]?'checked':'';
        $published = $resultCar[ 'published' ]?'checked':'';
    } catch( PDOException $e ) {
        $errMsg =  $e->getMessage();
    }
}
// end selected car data.
?>
<!doctype html>
<html lang='en'>

<head>
    <?php
$title = 'UPdate Car';
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
                        <?php
if ( isset( $_GET[ 'update' ] ) && $_GET[ 'update' ] == 'success' ) {
    ?>
                        <div class='alert alert-success'>
                            <strong>Success!</strong>Updated_Successfuly
                        </div>
                        <?php
}
?>
                        <h2><?php echo $title?></h2>
                        <form action='' method='post' enctype='multipart/form-data'>
                            <div class='mb-3'>
                                <label for='name' class='form-label'>Car Title</label>
                                <input type='text' class='form-control' id='title' aria-describedby='emailHelp'
                                    name='title' value="<?php echo $resultCar['title']?>">
                            </div>
                            <br>
                            <div class='mb-3'>
                                <label for='content' class='form-label'>Car Description</label>
                                <textarea class='form-control' name='content'
                                    id='content'><?php echo $resultCar[ 'content' ]?></textarea>
                            </div>
                            <br>
                            <div class='mb-3'>
                                <label for='model' class='form-label'>Car Model</label>
                                <input type='number' min='1900' max='2030' class='form-control' id='model'
                                    aria-describedby='emailHelp' name='model' value="<?php echo $resultCar['model']?>">
                            </div>
                            <div class='mb-3 form-check'>
                                <input type='checkbox' class='form-check-input' id='automatic' name='automatic'
                                    <?php echo $automatic?>>
                                <label class='form-check-label' for='automatic'>Automatic</label>
                            </div>
                            <br>
                            <div class='mb-3'>
                                <label for='consumption' class='form-label'>Car Consumption</label>
                                <input type='number' class='form-control' name='consumption' id='consumption'
                                    aria-describedby='emailHelp' value="<?php echo $resultCar['consumption']?>">
                            </div>
                            <br>
                            <div class='mb-3'>
                                <label for='options' class='form-label'>Car Options</label>
                                <input type='text' class='form-control' id='options' aria-describedby='emailHelp'
                                    name='options' value="<?php echo $resultCar['options']?>">
                            </div>
                            <br>
                            <div class='mb-3'>
                                <label for='price' class='form-label'>Car Price</label>
                                <input type='number' class='form-control' name='price' id='price'
                                    aria-describedby='emailHelp' step='any' value="<?php echo $resultCar['price']?>">
                            </div>
                            <br>
                            <div class='mb-3 form-check'>
                                <input type='checkbox' class='form-check-input' id='published' name='published'
                                    <?php echo $published?>>
                                <label class='form-check-label' for='published'>Published</label>
                            </div>
                            <br>
                            <div class='mb-3 form-check'>
                                <label class='form-label' for='category_id'>Car Category</label>
                                <select class='form-control' name='category_id' id='category_id'>
                                    <?php
foreach ( $resultCateg as $rowCategory ) {
    ?>
                                    <option value="<?php echo $rowCategory['cat_id'];?>"
                                        <?php echo $resultCar[ 'category_id' ] == $rowCategory[ 'cat_id' ]?'selected':'' ?>>
                                        <?php echo $rowCategory[ 'category_name' ];
    ?></option>
                                    <?php }
    ?>
                                </select>

                            </div>
                            <br>
                            <div class='form-group'>
                                <label for='image' class='form-label'>Car Image</label>
                                <input type='file' class='form-control' id='image' name='image'>
                                <br>
                                <img src="../assets/images/<?php echo $resultCar['image'] ?>"
                                    alt="<?php echo $resultCar['title'] ?>" style='width:200px'>
                            </div>
                            <br>
                            <input type='hidden' name='oldImage' value="<?php echo $resultCar['image']?>">
                            <button type='submit' class='btn btn-primary'>Update Car</button>
                        </form>
                    </div>
                </div>
            </div>

            <?php
    include_once( 'includes/footerJS.php' );
    ?>
</body>

</html>