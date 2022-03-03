<?php
include '../dbconnection.php';
session_start();

if(!isset($_SESSION['login_id']))
{
    header("location: index");
}
$b_id=$_GET['b_id'];
$book_query=mysqli_query($con,"SELECT * from book_details_tb where book_id='$b_id'");

if(isset($_POST['add_book']))
{



    $book_id   = mysqli_real_escape_string($con, $_POST['book_id']);
    $student_id = mysqli_real_escape_string($con, $_POST['student_id'] );
    $collection_count=mysqli_query($con,"SELECT * from collection_tb where login_id='$student_id' and status='1'");
    $no_of=mysqli_num_rows($collection_count);
    $collection_query=mysqli_query($con,"SELECT * from collection_tb where login_id='$student_id' and book_id='$book_id' and status='1'");
    $count=mysqli_num_rows($collection_query);
    if($no_of=='3')
    {
    echo"<script>alert('You reach the limit..');</script>";
    echo"<script><script>window.history.back();</script>";
    }
    else
    {
    if($count>0)
    {
    echo"<script>alert('You already collect this book..');</script>";
    echo"<script>window.location='dashboard';</script>";
    }
    else
    {
    $current_date=date("y-m-d");
    //$update_reservation_query=mysqli_query($con,"UPDATE reservation_tb SET status='2' WHERE reservation_id='$r_id'");
    mysqli_query($con, "INSERT INTO `collection_tb`(`book_id`, `login_id`, `date_of_collection`, `status`)
     VALUES('$book_id', '$student_id','$current_date',1)");

   echo "<script>alert('New book added successfully!');</script>";
   echo"<script>window.location='add_to_entry_book';</script>";
    }
    }
}


$categ_query = mysqli_query($con, "SELECT * FROM category_tb ORDER BY category_name ASC");


?>
<!doctype html>
<html class="no-js" lang="">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
 
<?php include ('includes/header.php'); ?>

<style type="text/css">
    span{color: red;}
</style>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
       <!-- Header Menu Area Start Here -->

       <?php include 'includes/navbar.php'; ?>
        
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            
            <?php include 'includes/leftbar.php'; ?>

            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Book Details</h3>
                    <ul>
                        <li>
                            <a href="dashboard">Home</a>
                        </li>
                        <li>Library</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->

                <div class="col-md-12 col-lg-12">
                <!-- Dashboard summery Start Here -->
                <div class="card height-auto">
                    
                        
                    <div class="card-body">                        
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Add To Entry Book</h3>
                            </div>
                            
                        </div>
                        <form class="new-added-form" autocomplete="off" method="post">
                            <div class="row">  

                               

                                <div class="col-md-6 col-lg-6 form-group">
                                    <label>Book Id <span id="bookErr">*</span></label> 
                                    <input type="text" placeholder="Enter book id" id="book_id" name="book_id" onkeyup="clearErr('bookErr');" value="<?php echo $b_id;?>" class="form-control">
                                </div>  

                                <div class="col-md-6 col-lg-6 form-group">
                                    <label>User Id <span id="authErr">*</span></label> 
                                    <input type="text" placeholder="Enter User id" id="student_id" name="student_id" onkeyup="clearErr('authErr');" class="form-control">
                                </div>   

                                <div class="col-12 form-group mg-t-8">
                                    <input type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark" value="Save" name="add_book" style="float: right;"> 
                                     
                                </div>
                            </div>
                        </form>
                    </div>
                
                <footer class="footer-wrap-layout1">
                    <div class="copyright"><a href="#">CET Library Management System</a></div>
                </footer>
                <!-- Footer Area End Here -->
            </div></div>


        </div>
        <!-- Page Area End Here -->
    </div></div>
    
    <?php include 'includes/scripts.php'; ?>

    

</body>

</html>
