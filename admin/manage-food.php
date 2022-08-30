<?php include('partials/menu.php');?>
<div class ="main-content">
<div class= "wrapper">
    <h1>Manage Food</h1><br>
    <br>
    <br>
    <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
   <br> 
   <br>
   <br>
   <?php
        if(isset($_SESSION['add']))//checking the session work or not
        {
            echo $_SESSION['add']; //Display session message
            unset($_SESSION['add']); //Removing session message
        }
        if(isset($_SESSION['remove']))//checking the session work or not
        {
            echo $_SESSION['remove']; //Display session message
            unset($_SESSION['remove']); //Removing session message
        }
        if(isset($_SESSION['delete']))//checking the session work or not
        {
            echo $_SESSION['delete']; //Display session message
            unset($_SESSION['delete']); //Removing session message
        }
        if(isset($_SESSION['upload']))//checking the session work or not
        {
            echo $_SESSION['upload']; //Display session message
            unset($_SESSION['upload']); //Removing session message
        }
        if(isset($_SESSION['update']))//checking the session work or not
        {
            echo $_SESSION['update']; //Display session message
            unset($_SESSION['update']); //Removing session message
        }
   ?>
   <table class="tbl-full">

    <tr>
        <th>S.N </th>
        <th>Title </th>
        <th>Price </th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Action </th>
    </tr>

    <?php
            $sql="SELECT * FROM tbl_food";

            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn=1;
            if($count>0)
            {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['id'];
                            $title=$row['title'];
                            $price=$row['price'];
                            $image_name=$row['image_name'];
                            $featured=$row['featured'];
                            $active=$row['active'];
                                        ?>
                                        <tr>
        <td><?php echo $sn++; ?></td>
        <td> <?php echo $title; ?></td>
        <td> <?php echo $price; ?></td>
        <td>
        <?php 
                        
                        if($image_name!="")
                        {
                            ?>
                            <img src=" <?php echo SITEURL;?>images/food/<?php echo $image_name; ?> "width ="100px" >
                            <?php

                        }
                        else
                        {
                          echo "<div class ='fail'>  Image Not Added</div>";
                        }
                    ?>
        </td>
        <td><?php echo $featured; ?></td>
        <td><?php echo $active; ?></td>
        <td>
        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?> &image_name=<?php echo $image_name; ?>" class="btn-sec">Update-Food</a>
        <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?> &image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
        
    </td>

    </tr>


    <?php
                        }
            }
            else
            {
                echo "<tr><td colspan='7' class ='fail'> Food not Added Yet.</td></tr>";
            }
    ?>
    
    
    
    </table>
   
    
</div>
</div>
      <!------footer------->
      <?php include('partials/footer.php');?>