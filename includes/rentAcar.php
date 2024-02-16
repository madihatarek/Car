<?php
include_once( 'admin/conn.php' );
try {
    $sql = "SELECT`id`,`title`,`model`,`automatic`,`consumption`,`price`, `image` FROM `cars` WHERE `published` = 1";
    $stmt = $conn->prepare( $sql );
    $stmt->execute();
    $resultCar = $stmt->fetchAll();
} catch( PDOException $e ) {
    $errMsg =  $e->getMessage();
}
?>
<!-- Rent A Car Start -->
<div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
        <h1 class="display-1 text-primary text-center">03</h1>
        <h1 class="display-4 text-uppercase text-center mb-5">Find Your Car</h1>
        <div class="row">
            <?php
                foreach($resultCar as $car) {
                    $id = $car['id'];
                    $title = $car['title'];
                    $model = $car['model'];
                    $automatic = $car['automatic']?"Automatic":"Manual";
                    $consumption = $car['consumption'];
                    $price = $car['price'];
                    $image = $car['image'];
            ?>
            <div class="col-lg-4 col-md-6 mb-2">
                <div class="rent-item mb-4">
                    <img class="img-fluid mb-4" src="admin/assets/images/<?php echo $image?>" alt="<?php echo $title?>">
                    <h4 class="text-uppercase mb-4"><?php echo $title?></h4>
                    <div class="d-flex justify-content-center mb-4">
                        <div class="px-2">
                            <i class="fa fa-car text-primary mr-1"></i>
                            <span><?php echo $model?></span>
                        </div>
                        <div class="px-2 border-left border-right">
                            <i class="fa fa-cogs text-primary mr-1"></i>
                            <span><?php echo $automatic?></span>
                        </div>
                        <div class="px-2">
                            <i class="fa fa-road text-primary mr-1"></i>
                            <span><?php echo $consumption?>K</span>
                        </div>
                    </div>
                    <a class="btn btn-primary px-3" href="detail.php?id=<?php echo $id?>">$<?php echo $price?>/Day</a>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>
<!-- Rent A Car End -->