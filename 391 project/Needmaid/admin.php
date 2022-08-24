<?php include 'config/database.php';?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>
   <h1 style="font-size: 5rem;text-align:center;margin-top:50px;">ADMIN PANEL</h1>
    <?php
     $name = $address = $phoneno = $area = $gender = $expertise = $age='';
     $nameErr = $addressErr = $phonenoErr = $areaErr = $genderErr = $expertiseErr = $ageErr='' ;
     //form submit
     if(isset($_POST['submit'])){
      if(empty($_POST['name'])){
        $nameErr='Name is required';
      }else{
          $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      }
      if(empty($_POST['address'])){
        $addressErr='address is required';
      }else{
          $address = filter_input(INPUT_POST,'address',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      }
      if(empty($_POST['phoneno'])){
        $phonenoErr='phoneno is required';
      }else{
          $phoneno = filter_input(INPUT_POST,'phoneno',FILTER_SANITIZE_NUMBER_INT);
         
      }
      if(empty($_POST['area'])){
        $areaErr='area is required';
      }else{
          $area = filter_input(INPUT_POST,'area',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      }
      if(empty($_POST['gender'])){
        $genderErr='gender is required';
      }else{
          $gender = filter_input(INPUT_POST,'gender',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      }
      if(empty($_POST['expertise'])){
        $expertiseErr='expertise is required';
      }else{
          $expertise = filter_input(INPUT_POST,'expertise',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      }
      if(empty($_POST['age'])){
        $ageErr='age is required';
      }else{
          $age = filter_input(INPUT_POST,'age',FILTER_SANITIZE_NUMBER_INT);
         
      }
     if(empty($nameErr) && empty($addressErr) && empty($phonenoErr) && empty($areaErr) && empty($genderErr) && empty($expertiseErr)){
      $sql = "INSERT INTO `maid` (`name`, `address`, `phoneno`, `area`, `gender`, `expertise`, `age`) VALUES ('$name', '$address', '$phoneno', '$area', '$gender', '$expertise', '$age');";
     


      if(mysqli_query($conn, $sql)){

      }
      else{
        
        echo 'Error: ' . mysqli_error($conn);
      }
    }
    }
     
    ?>
    <div class="form-container">

        <!-- <span id="close-login-form" class="fas fa-times"></span> -->

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

            <input type="text" placeholder="name" class="box" name="name"> <br>
            <input type="text" placeholder="address" class="box" name="address"><br>
            <label for="area">Choose a area:</label>
              <select id="area" name="area">
               <option value="newmakrket">newmakrket</option>
               <option value="dhanmondi">dhanmondi</option>
               <option value="lalmatia">lalmatia</option>
               <option value="azimpur">azimpur</option>
              </select>
            <label for="gender">Choose:</label>
                <select id="gender" name="gender">
                 <option value="female">female</option>
                 <option value="male">male</option>
                 <option value="3rd gender">3rd gender</option>
                </select><br>
            <input type="number" placeholder="phone no." class="box" name="phoneno"><br>
            <input type="text" placeholder="work" class="box" name="expertise"><br>
            <input type="number" placeholder="age" class="box" name="age"><br>
            <input type="submit" value="submit" class="btn" name="submit">


            

        </form>

        </div>
        <h1 style="font-size: 3rem; text-align:center;margin:30px;">PENDING LIST</h1>
    <div class="table">
    <?php
 $sql = 'SELECT * FROM user WHERE status="pending"';
 $result = mysqli_query($conn, $sql);
 $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
 

   <table>
    <tr>
    <th>user_name</th>
    <th>maid_ID</th>
    <th>nid</th>
    <th>user_phoneno</th>
    <th>status</th>
    </tr>
    <?php foreach($user as $item):?>
   <tr>
  
                 <td><?php echo $item['name']; ?></td>
                 <td><?php echo $item['maidid']; ?></td>
                 <td><?php echo $item['nid']; ?></td>
                 <td><?php echo $item['phoneno']; ?></td>
                 <td><form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  method="POST">
                    <input type="hidden" name="hidden_id"value="<?php echo $item['id'] ?>" >
                    <button name="pu_submit" class="work-button" type="submit" onclick="location.reload();">Confirm</button><button name="pd_submit"class="work-button" type="submit" onclick="location.reload();">Delete</button></form></td>
                </tr>
                 
  
  <?php endforeach; ?>     
   </table>
  </div>

  <?php 
    

    if(isset($_POST['pu_submit'])){
        
        $sql= "UPDATE user SET status = 'confirmed' WHERE id = ".$_POST["hidden_id"].";";
        $result = mysqli_query($conn, $sql);
        

    }
    if(isset($_POST['pd_submit'])){
        
        $sql= "DELETE FROM `user` WHERE `user`.`id` = ".$_POST["hidden_id"].";";
        $result = mysqli_query($conn, $sql);
    }

  ?>


  <h1 style="font-size: 3rem; text-align:center;margin:30px;">ACTIVE LIST</h1>
    <div class="table">
    <?php
 $sql = 'SELECT * FROM user_has_maid';
 $result = mysqli_query($conn, $sql);
 $user_has_maid = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
 

   <table>
    <tr>
    <th>user_ID</th>
    <th>maid_ID</th>
    <th>Active Status</th>
    </tr>
    <?php foreach($user_has_maid as $item):?>
   <tr>
  
                 <td><?php echo $item['user_id']; ?></td>
                 <td><?php echo $item['maid_id']; ?></td>
                 <td><?php echo $item['active']; ?></td>
                 
                 
  </tr>
  <?php endforeach; ?>     
   </table>
  </div>



  
  <script type="text/javascript">
    // querySelector('.Submitbtn').addEventListener("click",function(){
    //     document.getElementById("myForm").reset();
    // })

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

</script>
  </body>
</html>
