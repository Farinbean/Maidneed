<?php include 'config/database.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<header class="header">

    <div id="menu-btn" class="fas fa-bars"></div>

    <a href="#" class="logo"> <span>Maid</span>need </a>

    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#services">services</a>
        <a href="#contact">contact</a>
    </nav>


</header>


<section class="home" id="home">

    <h3 data-speed="-2" class="home-parallax">find a maid</h3>

    <img data-speed="5" class="home-parallax" src="https://blissmaidservices.com/wp-content/uploads/coweta-oklahoma-cleaning-services-01.jpg" alt="">


</section>

<section class="services" id="services">

    <h1 class="heading"> our <span>services</span> </h1>

    <div class="box-container">

        <div class="box">
          <i class="fa-solid fa-kitchen-set"></i>
            <h3>House Cleaning</h3>
            <p>We clean</p>
            <a href="#" class="btn"> read more</a>
        </div>

        <div class="box">
            <h3>Washing Dishes</h3>
            <p>WE clean dishes.</p>
            <a href="#" class="btn"> read more</a>
        </div>

        <div class="box">
            <h3>Washing cloaths</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis, nisi.</p>
            <a href="#" class="btn"> read more</a>
        </div>

        <div class="box">
            <h3>Cooking</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis, nisi.</p>
            <a href="#" class="btn"> read more</a>
        </div>

        <div class="box">
            <h3>Baby sitting</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis, nisi.</p>
            <a href="#" class="btn"> read more</a>
        </div>


    </div>

</section>
<?php
 $sql = 'SELECT * FROM maid';
 $result = mysqli_query($conn, $sql);
 $maid = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<h1 class="heading"> <span>Maid</span> profile </h1>
<section class="frame" id="featured">

 
 <?php foreach($maid as $item):?>
    <div class="card">
  
  <div class="container">
  <i class="fa-solid fa-kitchen-set"></i>
                   <h3><?php echo $item['id']; ?></h3> <br>
                    <h3> <label for="">Name: </label><?php echo $item['name']; ?></h3> <br>
                    <h3><label for="">Expertise: </label><?php echo $item['expertise']; ?></h3> <br>
                    <h3><label for="">Area: </label><?php echo $item['area']; ?></h3> <br>
                    <h3><label for="">Phone no: </label><?php echo $item['phoneno']; ?></h3> <br>
                    <h3><label for="">Gender: </label><?php echo $item['gender']; ?></h3> <br>

                    <a href="#lfc" class="btn" 
                        onclick="transferId(
                            <?php echo $item['id'] ?>)">book</a>
  </div>
</div>                  

    <?php endforeach; ?>               

                        

 
</section>
<div class="swiper featured-slider"> 
<!-- formmm -->
 <?php
     $maidid= $name = $email = $phoneno = $nid = $address='';
     $maididErr= $nameErr = $emailErr = $phonenoErr = $nidErr = $addressErr='' ;
     //form submit
     if(isset($_POST['submit'])){
        if(empty($_POST['maidid'])){
            $maidErr='maidid is required';
          }else{
              $maidid = filter_input(INPUT_POST,'maidid',FILTER_SANITIZE_NUMBER_INT);
          }
    
      if(empty($_POST['name'])){
        $nameErr='Name is required';
      }else{
          $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      }
      if(empty($_POST['email'])){
        $addressErr='email is required';
      }else{
          $address = filter_input(INPUT_POST,'email',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      }
      if(empty($_POST['phoneno'])){
        $phonenoErr='phoneno is required';
      }else{
          $phoneno = filter_input(INPUT_POST,'phoneno',FILTER_SANITIZE_NUMBER_INT);
         
      }
      if(empty($_POST['nid'])){
        $nidErr='nid is required';
      }else{
          $nid = filter_input(INPUT_POST,'nid',FILTER_SANITIZE_NUMBER_INT);

      }
      if(empty($_POST['address'])){
        $genderErr='address is required';
      }else{
          $gender = filter_input(INPUT_POST,'address',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      }
     
     if(empty($maididErr) && empty($nameErr) && empty($emailErr) && empty($phonenoErr) && empty($nidErr) && empty($addressErr)){  
         try {
            $sql = "INSERT INTO `user` (`maidid`,`name`, `email`, `phoneno`, `nid`, `address`) VALUES ('$maidid','$name', '$email', '$phoneno', '$nid', '$address');";
     


            if(mysqli_query($conn, $sql)){
      
            }
            else{
              
              echo 'Error: ' . mysqli_error($conn);
            }
         } catch (\Throwable $th) {
             echo '<script type="text/JavaScript">
             alert("This maid cannot be booked!");
             </script>';
         }
      
    }
    }
     
    ?>
    <div id="lfc"class="login-form-container">

        <!-- <span id="close-login-form" class="fas fa-times"></span> -->
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <input id="maidid" type="number" placeholder="maidid" class="box" name="maidid" value="" readonly><br>
            <input id="name" type="text" placeholder="name" class="box" name="name"> <br>
            <input id="email" type="text" placeholder="email" class="box" name="email"><br>
            <input id="phoneno" type="number" placeholder="phone no." class="box" name="phoneno"><br>
            <input id="nid" type="number" placeholder="nid" class="box" name="nid"><br>
            <input id="address" type="text" placeholder="address" class="box" name="address"><br>
            
            <input type="submit" value="submit" class="btn" name="submit">  

        </form>
</div>
        </div>
         
    </div> -->

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<script src="js/scripts.js"></script>
<script>
    function transferId(a){
    
    document.getElementById('maidid').value = a;
    
    }
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>