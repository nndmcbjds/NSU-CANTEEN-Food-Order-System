
<?php include('part/menu.php')?>

<section class="categories">
        <div class="container">
            <h2 class="text-center"> Notification</h2>

    
    <br>
   <table class="tbl-full text-center">

    <tr>
        <th>S.N </th>
        <th>Food </th>
        <th>QTY  </th>
        <th>Price </th>
        <th>Total</th>
        <th>Date-Time</th>
        <th>Name</th>
        <th>Email</th>
        <th>Description</th>
        <th>Status</th>
    
    </tr>
    <?php
 $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
 $res = mysqli_query($conn, $sql);
 $count = mysqli_num_rows($res);
 $sn=1;
 if($count>0)
 {
    while ($row=mysqli_fetch_assoc($res)) {
        # code...
        $id = $row['id'];
          $food=$row['food'];
         $price =$row['price'];
         $total =$row['total'];
        $qty  =$row['qty'];
         $order_date =$row['order_date'];
         $status =$row['status'];
        $description=$row['description'];

?>
        <tr>
        <td> <?php echo $sn++; ?></td>
        <td><?php echo $food; ?></td>
        <td><?php echo $qty; ?></td>
        <td><?php echo $price; ?></td>
        <td><?php echo $total; ?></td>
        <td><?php echo $order_date; ?></td>
        
        <?php
        $sql = " SELECT * FROM tbl_student LIMIT 1";
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
                   $email=$rows['Email'];

                   //Dispaly the Values in our table
                   ?>
                   
                
        
                          <td><?php echo $full_name; ?></td>
                          <td><?php echo $email; ?></td>
        

                   <?php
               }
           }
           else
           {
               //we do not have data in database
           }
        }
   ?>
        <td><?php echo $description; ?></td>
        <td><?php 
        if($status=="Ordered"){
            echo "<label> $status</label>";
        }
        elseif($status=="ON Deleivery")
        {
            echo "<lable style ='color: orange;'>Order ON Deleivery</lable>";
        }
        elseif($status=="Deleivered")
        {
            echo "<lable style ='color: green;'>Order Deleivered</lable>";
        }
        elseif($status=="Canclled")
        {
            echo "<lable style ='color: red;'>Order Canclled</lable>";
        }

        
        
        ?></td>
        
        
    </tr>

    <?php
    }
 }
 
 else {
     # code...
    echo "<tr><td><div class='fail'> Orders Not avaiable</div> </td> </tr>";
 }

?>
    
    
    
    </table>
    
</div>
</div>
<br>
<br>
<br><br><br>
<?php include('part/footer.php')?>