<?php 
    include 'header.php';
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<body>

    


    <section id="bodysection">


        <div class="bodyDiv leftDiv">

            <?php 
                $sql1 = "SELECT * FROM category WHERE category_id = {$cat_id}";
                $result1 = mysqli_query($conn,$sql1) or die("Suery failed");
            
                $totp_row = mysqli_fetch_assoc($result1);
            
            ?>

            <div id="category_name">
                <h2><?php echo $totp_row['category_name'];?></h2>
                <div></div>

            </div>

        <?php 
            include 'config.php';

            if(isset($_GET['cid'])){
                $cat_id =$_GET['cid'];
            }
    



            $limit = 5;

            if(isset($_GET['page'])){

                $page = $_GET['page'];
            }else{
                $page  =1;
            }

            $offset = ($page - 1) * $limit;

            $sql = "SELECT * FROM post  
            LEFT JOIN category ON post.category = category.category_id
            LEFT JOIN users ON post.author = users.user_id
            WHERE post.category = {$cat_id}
            ORDER BY post.post_id DESC
            LIMIT {$offset},{$limit}";

            $result = mysqli_query($conn,$sql) or die("Connection Failed");

            if(mysqli_num_rows($result) > 0 ){
                while($row = mysqli_fetch_array($result)){
            
        ?>

           <section>
           <div class="prent_div">
                <div class="chaild_div  chaild_div_left" >

                    <a href="single.php?id=<?php echo $row['post_id'];?>"><img src="<?php echo "admin/upload/".$row['post_img']?>" alt=""></a>
                </div>
                <div class="chaild_div  chaild_div_right" >
                    <a href="single.php?id=<?php echo $row['post_id'];?>"><h4><?php echo substr($row['title'],0,70)."...."?></h4></a>
                        <div>
                        <section class="activity_section"><a href="categoty.php"><img src="admin/image/type.png "><?php echo $row['category_name']?> </a></section>
                        <section class="activity_section"><a href=""><img src="admin/image/admin.png "><?php echo $row['username']?></a></section>
                        <section class="activity_section"><a href=""><img src="admin/image/date.png "><?php echo $row['post_date']?> </a></section>
                        </div>
                    <a href=""> <p class="description_p_tag"> <?php echo substr($row['description'],0,120)."..."?></p></a>
                    <a class="read_more" href="single.php?id=<?php echo $row['post_id'];?>">Read More</a>
                
                </div>

            </div>

            <?php 
                }
            }else{
                echo"not record found";
            }
            ?>
           </section>
           
            <section id="paginations_user_Section">
                <?php 




                        if($page > 1){
                            echo '<a href="category.php?cid=' .$cat_id. '&page='.($page - 1).'">prev</a>';
                        }
                        
                        if(mysqli_num_rows($result1) > 0){

                            $total_records = $totp_row['post'];
                            $total_pages = ceil($total_records / $limit);

                        for ($i = 1; $i <= $total_pages; $i++ ){
                                
                            if($i == $page){
                                $active = "activedddd";
                            }else{
                                $active = "";
                                }
                                echo " <a class='{$active}' href='category.php?cid=' .$cat_id. '&page={$i}'>$i</a> " ;
                            }
                        if($total_pages > $page){
                             echo '<a  href="category.php?cid=' .$cat_id. '&page='.($page + 1).'">Next</a>';
                            }
                        }
                    ?>
             </section>


        </div>


        <div class="bodyDiv rightDiv">
             <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis minima in vitae unde aliquam, voluptate accusamus sed ratione illum molestias ex nulla perspiciatis voluptatem libero totam et. Beatae, blanditiis deserunt.</p>

        </div>

   


   

</body>
</html>
</section>

    
<?php include "futer.php";?> 