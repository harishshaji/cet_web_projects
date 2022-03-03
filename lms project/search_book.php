<?php
include '../dbconnection.php';
session_start();

if(!isset($_SESSION['login_id']))
{
    header("location: index");
}

$books_query = mysqli_query($con, "SELECT `book_id`,`book_name`, `author`, `shelf_no`, `price`, `book_edition`,`category_name` FROM book_details_tb JOIN category_tb ON category_tb.category_id = book_details_tb.category_id 
     ORDER BY book_id ASC");


?>

<!doctype html>
<html class="no-js" lang="">



 
<?php include ('includes/header.php'); ?>


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
                    <h3>Books Details</h3>
                    <ul>
                        <li>
                            <a href="dashboard">Home</a>
                        </li>
                        <li>View Book Details</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->
                
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>All Books</h3>
                            </div>
                             
                        </div>
                        <form class="mg-b-20">
                            <div class="row gutters-8">

                                <div class="col-4-xxxl col-xl-4 col-lg-3 col-12 form-group">
                                <input type="text" placeholder="Search ..." onkeyup="get_detail(this.value)" class="form-control">
                                </div>

                                <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                </div>
                                
                                <div class="col-4-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                </div>

                                <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                                
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <span id="get_num">
                        <div class="row">  
                    <?php 
                    $i = 0; 

                    while($row_data = mysqli_fetch_assoc($books_query))
                    { 
                    $i++;
                    $b_id=$row_data['book_id'];
                    $reserved_query=mysqli_query($con,"SELECT * FROM reservation_tb where 
                        book_id='$b_id' and status='1'");
                    
                    $collected_query=mysqli_query($con,"SELECT * FROM collection_tb where 
                        book_id='$b_id' and status='1'");
                    $reserve_count=mysqli_num_rows($reserved_query);
                    $collected_count=mysqli_num_rows($collected_query);
                    // $current_quantity=1-$reserve_count-$collected_count;
                
                    ?>

                                    
                    <div class="col-xl-5 col-sm-6 col-12">
                    
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                
                                <div class="col-10">
                                    <div class="item-content" >

                                        <div class="item-number">Name : <?php echo $row_data['book_name']; ?></div>
                                        <div class="item-title">Author : <?php echo $row_data['author']; ?></div>
                                        <div class="item-title">Category : <?php echo $row_data['category_name']; ?>
                                        </div>
                                       
                                        <div class="item-title">Edition : <?php echo $row_data['book_edition'] ?></div>
                                         <div class="item-title">Shelf No : <?php echo $row_data['shelf_no']; ?>
                                        </div>
                                        <!-- <div class="item-title">Quantity : <?php $current_quantity ?></div> -->
                                        <div class="col-12 form-group mg-t-8">
                                            <?php
                                            if(!$_SESSION['role'] =='0')
                                            {
                                            ?>
                                        <input type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark" value="Reserve" onclick="get_name(<?php echo $row_data['book_id']; ?>)"
                                         name="add_reserve" style="float: right;"> 
                                         <?php
                                            }
                                            ?>
                                     
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     
                    </div>
                    <?php 
                    } 
                    ?>
                </div>
                     </span>               
                                
                        </div>

                       

                    </div>
                </div>

                <footer class="footer-wrap-layout1">
                    <div class="copyright"><a href="#">CET Library Management System</a></div>
                </footer>
                <!-- Footer Area End Here -->
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    
    <?php include 'includes/scripts.php'; ?>
    <script type="text/javascript">
        function get_name(name)
        {
            jQuery.ajax(
            {
                type:"POST",
                url:"add_reserve_book_ajax.php",
                datatype:'html',
                data:{reserve_details:name},
                success:function(data)
                {
                    jQuery("#get_num").html(data);
                },
                error:function(data)
                {
                    jQuery("#get_num").html("failed");
                }

            });
        };
    </script>
    <script type="text/javascript">
        function get_detail(name)
        {
            jQuery.ajax(
            {
                type:"POST",
                url:"book_search_ajax.php",
                datatype:'html',
                data:{book_detail:name},
                success:function(data)
                {
                    jQuery("#get_num").html(data);
                },
                error:function(data)
                {
                    jQuery("#get_num").html("failed");
                }

            });
        };
    </script>

</body>

</html>
