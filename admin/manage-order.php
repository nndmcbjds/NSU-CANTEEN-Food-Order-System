<?php include('partials/menu.php');?>
<div class ="main-content">
<div class= "wrapper">
    <h1>Manage Order</h1>
    <?php
    if(isset($_SESSION['update']))//checking the session work or not
    {
        echo $_SESSION['update']; //Display session message
        unset($_SESSION['update']); //Removing session message
    }
    ?>
    
   <br>
   <table class="tbl-full">

    <tr>
        <th>S.N </th>
        <th>Food </th>
        <th>QTY  </th>
        <th>Price </th>
        <th>Total</th>
        <th>Date-Time</th>
        <th>Status</th>
        <th>Name</th>
        <th>Email</th>
        <th>Description</th>
        <th>Action </th>
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
          $qty  =$row['qty'];
         $price =$row['price'];
         $total =$row['total'];
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
        <td><?php 
        if($status=="Ordered"){
            echo "<label> $status</label>";
        }
        elseif($status=="ON Deleivery")
        {
            echo "<lable style ='color: orange;'>$status</lable>";
        }
        elseif($status=="Deleivered")
        {
            echo "<lable style ='color: green;'>$status</lable>";
        }
        elseif($status=="Canclled")
        {
            echo "<lable style ='color: red;'>$status</lable>";
        }

        ?></td>

<?php
        $sql = " SELECT * FROM tbl_student";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //check whetherthe Query is Executed of Not
        if($res==TRUE)
        {
           //Count Rows to check whether we have data in database or not
           $count = mysqli_num_rows($res); // function to get all rows in database
            //create a variable and asign the value
           //Check the num of rows
           if($count!=0)
           {
               //we have data in database
               while($rows = mysqli_fetch_assoc($res))
               {
                   //using while loop to get all the data from database
                   //And while loop will run as long as we have data in database
                   //Get individual data
                   $full_name=$rows['full_name'];
                   $email=$rows['Email'];

                   //Dispaly the Values in our table
                   if($count==1){
                   ?>
        <td><?php echo $full_name; ?></td>
        <td><?php echo $email; ?></td>
        <?php
        }
               }
           }
           else
           {
               //we do not have data in database
           }
        }
   ?>
        <td><?php echo $description; ?></td>
        <td><a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-sec">Update Order</a> </td>

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
      <!------footer------->
      <?php include('partials/footer.php');?>