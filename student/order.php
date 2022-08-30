<?php include('part/menu.php')?>

<?php
if (isset($_GET['food_id'])) {
    # code...
    $food_id = $_GET['food_id'];

    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count==1) {
        # code...
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    }
    else
    {
        header('location:'.SITEURL.'student/index.php');
    }
}
else
{
    header('location:'.SITEURL.'student/index.php');
}
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST"class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                        <?php
                                if($image_name=="")
                                {
                                    echo "<div class='fail'>Image Not added</div>";


                                }
                                else
                                {
                                   ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                   <?php
                                }
                                ?>  </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <p class="food-price"><?php echo $price; ?>Tk</p>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                <?php
        $sql = " SELECT * FROM tbl_student ";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //check whetherthe Query is Executed of Not
        if($res==TRUE)
        {
           //Count Rows to check whether we have data in database or not
           $count = mysqli_num_rows($res); // function to get all rows in database
            
           $sn=1;//create a variable and asign the value
           //Check the num of rows
           if($count!=0)
           {
               //we have data in database
               while($rows = mysqli_fetch_assoc($res))
               {
                   //using while loop to get all the data from database
                   //And while loop will run as long as we have data in database
                   //Get individual data
                   $id=$rows['id'];
                   $full_name=$rows['full_name'];
                   $email=$rows['Email'];
        
           }
          
        }
    }
   ?>
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div >Full Name: <?php echo $full_name; ?></div>

                    <div >Email: <?php echo $email; ?></div>

                    <div class="order-label">Description</div>
                    <textarea name="description" rows="5" placeholder="E.g. What you like " class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
<?php
if (isset($_POST['submit'])) {

    # code...
    $food = $_POST['food'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $price * $qty;
    $order_date = date("Y-m-d h:i:sa");
    $status = "Ordered";
    $description = $_POST['description'];

    $sql2 = "INSERT INTO tbl_order SET
     food = '$food',
     price = $price,
     qty = $qty,
     total = $total,
     order_date = '$order_date',
     status = '$status',
    description = '$description'

    ";
//echo $sql2; die();
    $res2 = mysqli_query($conn, $sql2);

    if($res2==true)
    {
            $_SESSION['order'] = "<div class='success text-center'> Food ordered Successfully.</div>";   
            header('location:'.SITEURL.'student/index.php');
        }

        else
    {
            
        $_SESSION['order'] = "<div class='success text-center'> Failed  to order Food.</div>";   
        header('location:'.SITEURL.'student/index.php');
    }



}


?>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('part/footer.php')?>
