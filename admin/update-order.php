<?php include('partials/menu.php');?>

<div class ="main-content">
<div class= "wrapper">
    <h1>Update Order</h1>
    <br>
   <br>
    <form action="" method="POST">
        <table class="tbl-30">
        <?php
        if(isset($_GET['id'])){
        //get id of seleted admin
        $id=$_GET['id'];
        //sql query
        $sql= "SELECT * FROM tbl_order WHERE id=$id";
        //excutew query 
        $res=mysqli_query($conn,$sql);
        // check 
        if($res==TRUE)
        {
            $count=mysqli_num_rows($res);
            if($count==1)
            {
              //  echo"Admin Available";
              $row=mysqli_fetch_assoc($res);
              $food=$row['food'];
         $price =$row['price'];
         $total =$row['total'];
        $qty  =$row['qty'];
        $status=$row['status'];
         $order_date =$row['order_date'];
            }
            else{
                header('location'.SITEURL.'admin/manage-order.php');
            }
        }
    }else{
        header('location'.SITEURL.'admin/manage-order.php');
    }

    ?>
        <tr>
            <td>Food Name:</td>
            <td><b><?php echo $food; ?></b></td>
        </tr>

        <tr>
            <td>Total:</td>
            <td><b><?php echo $total; ?>TK</b></td>
        </tr>
        <tr>

        <td>Quantity:</td>
        <td><b><?php echo $qty; ?></b></td>
        </tr>
        <tr>
            <td>Status:</td>
            <td>
            <select name="status" >
                <option <?php if($status=="Ordered") {echo "selected";}?> value="Ordered">Ordered</option>
                <option <?php if($status=="ON Deleivery") {echo "selected";}?> value="ON Deleivery">ON Delivery
</option>
                <option <?php if($status=="Deleivered") {echo "selected";}?> value="Deleivered">Deleivered</option>
                <option <?php if($status=="Canclled") {echo "selected";}?> value="Canclled">Canclled</option>
            </select>
            </td>
        </tr>
        <tr>
            <td>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">
            <input type="submit" name="submit"value="Update Admin" class="btn-sec">
            </td>
        </tr>
        </table>
    </form>
   <?php
if (isset($_POST['submit'])) {
    # code...
    $id = $_POST['id'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    $sql2 = "UPDATE tbl_order SET
    
    status = '$status'
    WHERE id=$id

    ";
    $res2 = mysqli_query($conn, $sql2);
    if($res2==true)
    {
        $_SESSION['update'] = "<div class='sucess'> Food Update Sucessfully.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }
    else
    {
        $_SESSION['update'] = "<div class='fail'> Food Updated Failed.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
}  
   ?>
</div>
</div>
<?php include('partials/footer.php');?>