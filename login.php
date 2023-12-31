<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php

if(isset($_SESSION['username'])){

	header("location: " .APPURL. "");
}



if(isset($_POST['submit'])) {
  if(empty($_POST['email']) || empty($_POST['password'])) {
    echo "<script>alert('One or more inputs are empty');</script>";
  } else {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $login->bindParam(":email", $email);
    $login->execute();

    $fetch = $login->fetch(PDO::FETCH_ASSOC);

    if($login->rowCount() > 0) {
      if(password_verify($password, $fetch['password'])) {
        $_SESSION['username'] = $fetch['username'];
        $_SESSION['name'] = $fetch['name'];
        $_SESSION['user_id'] = $fetch['id'];
        $_SESSION['email'] = $fetch['email'];
        $_SESSION['user_image'] = $fetch['image'];

        header("location: " . APPURL."");
        echo "<script>alert('Logged in');</script>";
      } else {
        echo "<script>alert('Email or password is wrong');</script>";
      }
    }
  }
}
?>

<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="main-col">
        <div class="block">
          <h1 class="pull-left">LOGIN</h1>
          <div class="clearfix"></div>
          <hr>
          <form role="form" method="post" action="login.php">
            <div class="form-group">
              <label>Email Address*</label>
              <input type="email" class="form-control" name="email" placeholder="Enter Your Email Address">
            </div>
            <div class="form-group">
              <label>Password*</label>
              <input type="password" class="form-control" name="password" placeholder="Enter A Password">
            </div>
            <input name="submit" type="submit" class="color btn btn-default" value="Login" />
          </form>
        </div>
      </div>
    </div>

<?php require "../includes/footer.php"; ?>
