<?php include('partials/menu.php');?>



        <!--Main  Content Section Starts-->
        <div class="main-content">
          <div class= "wrapper">
               <h1>Manage Admin</h1>
               <br>

               <?php
               if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//dispalay session message
                unset($_SESSION['add']);//removing session message 
               }

               if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];//dispalay session message
                unset($_SESSION['delete']);//removing session message 
               }

               if(isset($_SESSION['update'])){
                echo $_SESSION['update'];//dispalay session message
                unset($_SESSION['update']);//removing session message 
               }

               if(isset($_SESSION['User not found'])){
                echo $_SESSION['User not found']; //Display session message
                unset($_SESSION['User not found']); //Removing session message
               }

               if(isset($_SESSION['Password Not Match'])){
                echo $_SESSION['Password Not Match']; //Display session message
                unset($_SESSION['Password Not Match']); //Removing session message
               }

               if(isset($_SESSION['Password Change'])){
                echo $_SESSION['Password Change']; //Display session message
                unset($_SESSION['Password Change']); //Removing session message
               }



               ?>

               <br>
               <br>
               <!--Button to Add Admin-->
               <a href="add-admin.php" class="btn-primary">Add Admin</a>
            
               <br>
    
                <table class="tbl-full">
                <tr>
                         <th>S.N </th>
                         <th>FullName </th>
                         <th>UserName </th>
                         <th>Action </th>
                </tr>

                <?php
                     
                     //Query to Get all Admin
                     $sql = " SELECT * FROM tbl_admin";
                     //Execute the Query
                     $res = mysqli_query($conn, $sql);

                     //check whetherthe Query is Executed of Not
                     if($res==TRUE)
                     {
                        //Count Rows to check whether we have data in database or not
                        $count = mysqli_num_rows($res); // function to get all rows in database
                         
                        $sn=1;//create a variable and asign the value
                        //Check the num of rows
                        if($count>0)
                        {
                            //we have data in database
                            while($rows = mysqli_fetch_assoc($res))
                            {
                                //using while loop to get all the data from database
                                //And while loop will run as long as we have data in database
                                //Get individual data
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username'];

                                //Dispaly the Values in our table
                                ?>
                                
                                <tr>
                                       <td><?php echo $sn++;?>.</td>
                                       <td><?php echo $full_name; ?></td>
                                       <td><?php echo $username; ?></td>
                                     <td> 
                                     <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>  
                                       <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-sec">Update Admin</a>
                                       <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                    </td>
                               </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //we do not have data in database
                        }
                     }
                ?>


                
                </table>

       
         </div>

               
        </div>
        <!--Main Content Section Ends-->

<?php include('partials/footer.php');?>