<?php
include 'helper/koneksi.php'; 
$register_message = "";
//mengambil nilai post
if(isset($_POST["sign_up"])){
    $username=$_POST['username'];
    $password=$_POST['password'];


//query
    $sql= "INSERT INTO account (username, password) 
                    VALUES ('$username', '$password')";

//cek
    if ($db->query($sql)) {
      $register_message = "Akun Berhasil Terdaftar, Silahkan Login";
    }
    else{
      $register_message= "Pendaftaran Akun Gagal";
    }
}

?>

 

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    
    <link rel="stylesheet" href="./assets/styles/styles.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"
    />
  </head>
  <body>
    <div class="login-container">
      <div class="login-wrapper">
        <!-- profile or logo kahit ano -->
        <div class="profile">
          <img src="./assets/img/profile.png" alt="" width="100" />
        </div>
       
        <form action="register.php" method="POST">
        <div class="form-wrapper">
        <?= $register_message ?>
          <label for="username">Username</label>
          <input type="text" placeholder="Type your username" name="username" id="username" required/>
        </div>
        <div class="form-wrapper">
          <label for="password">Password</label>
          <input type="password" placeholder="Type your Password" name="password" id="password" required/>        
        </div>
        <div class="login-btn">     
            <button type="submit" name="sign_up" id="sign_up" >Sign Up</button> 
        </div>
        </form>
        <div class="third-party-signup">
          <p>Or Sign Up Using:</p>
          <div class="platforms">
            <div class="icon">
              <img
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/2048px-Google_%22G%22_Logo.svg.png"
                alt=""
                width="30"
              />
            </div>
            <div class="icon">
              <img
                src="https://seeklogo.com/images/F/facebook-icon-circle-logo-09F32F61FF-seeklogo.com.png"
                alt=""
                width="30"
              />
            </div>
            <div class="icon">
              <img
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Instagram_icon.png/2048px-Instagram_icon.png"
                alt=""
                width="30"
              />
            </div>
          </div>
        </div>
        <div class="p-signup">
          Jika Telah Memiliki Akun Silahkan
        </div>
        <div class="signup">
          <a href="login.php">Login</a>
        </div>
      </div>
    </div>
  </body>
  <style>
    .p-signup{
      display: flex;
      margin-top: auto;
      height: 80px;
      text-align: center;
      justify-content: center;
      flex-direction: column;
      align-items: center;
      color: #656565;
    }
     .signup {
      
      height: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .signup a {
      text-decoration: none;
      color: #d885dc;
      cursor: pointer;
      font-weight: 400;
    }
  </style>
</html>
