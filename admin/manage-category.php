<?php include('partials/menu.php');?>
<div class ="main-content">
<div class= "wrapper">
    <h1>Manage Category</h1>

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

    if(isset($_SESSION['no-cat-found']))//checking the session work or not
    {
        echo $_SESSION['no-cat-found']; //Display session message
        unset($_SESSION['no-cat-found']); //Removing session message
    }
    if(isset($_SESSION['update']))//checking the session work or not
    {
        echo $_SESSION['update']; //Display session message
        unset($_SESSION['update']); //Removing session message
    }

    if(isset($_SESSION['upload']))//checking the session work or not
    {
        echo $_SESSION['upload']; //Display session message
        unset($_SESSION['upload']); //Removing session message
    }

    if(isset($_SESSION['faile-remov']))//checking the session work or not
    {
        echo $_SESSION['faile-remov']; //Display session message
        unset($_SESSION['faile-remov']); //Removing session message
    }
    
    

    ?>
    <br>
               <!--Button to Add Admin-->
               <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

               <br>
   <br>
   <br>
   <table class="tbl-full">

    <tr>
        <th>S.N </th>
        <th>Title </th>
        <th>Image </th>
        <th>Featured</th>
        <th>Active</th>
        <th>Action </th>
    </tr>
    <?php
///query for get data

    $sql= "SELECT * FROM tbl_category";
        $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
                        $sn=1;
            if($count>0)
            {
                    while ($row=mysqli_fetch_assoc($res)) {
                        //get data and display
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>
              <tr>
                         <td><?php echo $sn++; ?></td>
                         <td><?php echo $title; ?></td>


                        <td> 
                            <?php 
                        
                            if($image_name!="")
                            {
                                //display the img 
                                ?>
                                <img src=" <?php echo SITEURL;?>images/category/<?php echo $image_name; ?> "width ="100px" >
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
                        <td><a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-sec">Update Category</a>
                         <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?> &image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a> 
                        </td>

                </tr>


                        <?php


                    }
            }
            else{

               ?>
               <tr>
                   <td colspan = "6"><div class = "fail"> No Category Added</div></td>
               </tr>
               <?php
            }

    ?>
    
    
    </table>
    
</div>
</div>
  <?php include('partials/footer.php');?>


