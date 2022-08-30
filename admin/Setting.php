<?php include('partials/menu.php');?>



        <!--Main  Content Section Starts-->
        <div class="main-content">
          <div class= "wrapper">
               <h1> USER Detail list</h1>
               <br>


            
               <br>
    
                <table class="tbl-full">
                <tr>
                         <th>S.N </th>
                         <th>FullName </th>
                         <th>UserName </th>
                         <th>Email </th>
                </tr>

                <?php
                     
                     //Query to Get all Admin
                     $sql = " SELECT * FROM tbl_student";
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
                                $username=$rows['username'];
                                $email=$rows['Email'];

                                //Dispaly the Values in our table
                                ?>
                                
                                <tr>
                                       <td><?php echo $sn++;?>.</td>
                                       <td><?php echo $full_name; ?></td>
                                       <td><?php echo $username; ?></td>
                                       <td><?php echo $email; ?></td>
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