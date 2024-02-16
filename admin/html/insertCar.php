<?php
include_once( 'includes/loginCkecker.php' );
include_once( '../conn.php' );
// show categories data/..
try {
    $sql = "SELECT * FROM `categories` ";
    $stmt = $conn->prepare( $sql );
    $stmt->execute();
    $resultCateg = $stmt->fetchAll();
} catch( PDOException $e ) {
    $errMsg =  $e->getMessage();
}
// end select category.
//insert car into DB...
$titleErr=$contentErr=$modelErr=$consumptionErr=
$optionsErr= $priceErr= '';
$errors = 0;
if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
    if ( isset( $_POST[ 'title' ] ) and empty( $_POST[ 'title' ] ) ) {
        $titleErr = 'Please enter the title of car';
        $errors++;
    }
    if ( isset( $_POST[ 'content' ] ) and empty( $_POST[ 'content' ] ) ) {
        $contentErr = 'Please enter the conten of car';
        $errors++;
    }
    if ( isset( $_POST[ 'model' ] ) and empty( $_POST[ 'model' ] ) ) {
        $modelErr = 'Please enter the car model';
        $errors++;
    }
    if ( isset( $_POST[ 'consumption' ] ) and empty( $_POST[ 'consumption' ] ) ) {
        $consumptionErr = 'Please enter the car consumption';
        $errors++;
    }
    if ( isset( $_POST[ 'options' ] ) and empty( $_POST[ 'options' ] ) ) {
        $optionsErr = 'Please enter the car options';
        $errors++;
    }
    if ( isset( $_POST[ 'price' ] ) and empty( $_POST[ 'price' ] ) ) {
        $priceErr = 'Please enter the price of car in Day';
        $errors++;
    }
    if ( $errors == 0 ) {
    include_once('includes/upload.php');
        try {
            $sql = "INSERT INTO `cars`(
                `title`,
                `image`,
                `content`,
                `model`,
                `automatic`,
                `consumption`,
                `options`,
                `price`,
                `category_id`,
                `published`)
            VALUES(?,?,?,?,?,?,?,?,?,?);";
            $title = $_POST[ 'title' ];
            $content = $_POST[ 'content' ];
            $model = $_POST['model'];
            $consumption = $_POST['consumption'];
            $options = $_POST['options'];
            $price = $_POST['price'];
            $category_id  =$_POST['category_id'];
            $automatic =(isset($_POST[ 'automatic' ]));
            $published =(isset($_POST[ 'published' ]));
            $stmt = $conn->prepare( $sql );
            $stmt->execute( [$title,$image_name,$content,$model,
            $automatic,$consumption,$options,$price,$category_id,$published] );
            // echo 'Inserted Successfuly';
            header('location:insertCar.php?insert=success');
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
$title = 'Insert Cars';
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
if ( isset( $_GET[ 'insert' ] ) && $_GET[ 'insert' ] == 'success' ) {
    ?>
                        <div class='alert alert-success'>
                            <strong>Success!</strong>Inserted_Successfuly
                        </div>
                        <?php
}
?>
                        <h2>Add to Cars</h2>
                        <form action='' method='post' enctype='multipart/form-data'>
                            <div class='mb-3'>
                                <label for='name' class='form-label'>Car Title</label>
                                <input type='text' class='form-control' id='name' aria-describedby='emailHelp'
                                    name='title'>
                                    <span calss='err' style="color:#f00;"><?php echo $titleErr?></span>
                            </div>
                            <br>
                            <div class='mb-3'>
                                <label for='content' class='form-label'>Car Description</label>
                                <textarea class='form-control' name="content" id="content"></textarea>
                                <span calss='err' style="color:#f00;"><?php echo $contentErr?></span>
                            </div>
                            <br>
                            <div class='mb-3'>
                                <label for='model' class='form-label'>Car Model</label>
                                <input type='number' min="1900" max="2030" class='form-control' id='model'
                                    aria-describedby='emailHelp' name='model'>
                                    <span calss='alert alert-danger' style="color:#f00;"><?php echo $modelErr?></span>
                            </div>
                            <div class='mb-3 form-check'>
                                <input type='checkbox' class='form-check-input' id='automatic' name='automatic'>
                                <label class='form-check-label' for='automatic'>Automatic</label>
                            </div>
                            <br>
                            <div class='mb-3'>
                                <label for='consumption' class='form-label'>Car Consumption</label>
                                <input type="number" class='form-control' name="consumption" id="consumption"
                                    aria-describedby='emailHelp'>
                                    <span calss='err' style="color:#f00;"><?php echo $consumptionErr?></span>
                            </div>
                            <br>
                            <div class='mb-3'>
                                <label for='options' class='form-label'>Car Options</label>
                                <input type='text' class='form-control' id='options' aria-describedby='emailHelp'
                                    name='options'>
                                    <span calss='err' style="color:#f00;"><?php echo $optionsErr?></span>
                            </div>
                            <br>
                            <div class='mb-3'>
                                <label for='price' class='form-label'>Car Price</label>
                                <input type="number" class='form-control' name="price" id="price"
                                    aria-describedby='emailHelp' step="any">
                                    <span calss='err' style="color:#f00;"><?php echo $priceErr?></span>
                            </div>
                            <br>
                            <div class='mb-3 form-check'>
                                <input type='checkbox' class='form-check-input' id='published' name='published'>
                                <label class='form-check-label' for='published'>Published</label>
                            </div>
                            <br>
                            <div class='mb-3 form-check'>
                                <label class='form-label' for='category_id'>Car Category</label>
                                <select class='form-control' name="category_id" id="category_id">
                                    <option value="Please Select The Category of Car">Please Select The Category of Car...</option>
                                    <span calss='err'style="color:#f00;" ><?php echo $categoryErr?></span>
                                    <?php
                                        foreach($resultCateg as $rowCategory) {
                                    ?>
                                    <option value="<?php echo $rowCategory['cat_id'];?>">
                                        <?php echo $rowCategory['category_name'];?></option>
                                    <?php } ?>
                                </select>
                               
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="image" class='form-label'>Car Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <br>

                            <br>

                            <button type='submit' class='btn btn-primary'>Insert Car</button>
                        </form>
                    </div>
                </div>
            </div>

            <?php
    include_once( 'includes/footerJS.php' );
?>
</body>

</html>