<?php include('part-front/menu.php')?>

<?php
 if(isset($_SESSION['order']))//checking the session work or not
 {
     echo $_SESSION['order']; //Display session message
     unset($_SESSION['order']); //Removing session message
 }
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
 $sql= "SELECT * FROM tbl_category  WHERE active='Yes' AND featured='Yes' LIMIT 3";
 $res = mysqli_query($conn, $sql);

     $count = mysqli_num_rows($res);  
                 $sn=1;
     if($count>0)
     {
             while ($row=mysqli_fetch_assoc($res)) {
                 # code...
                 $id = $row['id'];
                 $title = $row['title'];
                 $image_name = $row['image_name'];
                 ?>
                 
                 <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                 <div class ="box-3 float-container">
                     <?php
                     if ($image_name=="") {
                         echo "<div class='fail'>Image Not Available </div>";
                         # code...
                     }
                     else
                     {
                         ?>
                          <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                         <?php
                     }

                     ?>
                <h3 class="float-text text-white"> <?php echo $title; ?></h3>
                 

                 </div>
                 </a>
                 <?php

             }
            }

             else
             {
                 echo "<div class='fail'>  Category not Added Yet.</div>";
             }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <br>

            <?php
$sql2="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 2";
 $res2=mysqli_query($conn ,$sql2);

 $count2=mysqli_num_rows($res2);

 if ($count2>0) {
     # code...
     while($row=mysqli_fetch_assoc($res2))
     {
         $id=$row['id'];
         $title=$row['title'];
         $price=$row['price'];
         $description=$row['description'];
         $image_name2=$row['image_name'];
         ?>


            <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                if($image_name=="")
                                {
                                    echo "<div class='fail'>Image Not added</div>";


                                }
                                else
                                {
                                   ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name2; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                   <?php
                                }
                                ?>
                               
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="food-price"><?php echo $price; ?>Tk</p>
                                <p class="food-detail">
                                   <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>student/user_login.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
         <?php
     }
 }
 else {
     # code...
     echo "<div class='fail'> Food Is not availbe.</div>";
 }

?>
           

           

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <?php include('part-front/footer.php')?>

