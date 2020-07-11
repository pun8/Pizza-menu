<!DOCTYPE html>
    <?php include('templates/header.php')?>
    <H4 class="center">Signup</H4>
    <?php
    if(isset($_GET['error'])){
        if($_GET['error']=="invalid" || $_GET['error']=="invalidemail" || $_GET['error']=="invalidusername"){
            echo '<h6 class="red-text center">Invalid email or password.</h6>';
        } elseif($_GET['error']=="emptyfields"){
            echo '<h6 class="red-text center">Please fill all fields.</h6>';
        }elseif($_GET['error']=="passwrdcheck"){
            echo '<h6 class="red-text center">Passwords dont match.</h6>';
        }elseif($_GET['error']=="sqlerror"){
            echo '<h6 class="red-text center">Internal error.</h6>';
        }elseif($_GET['error']=="usernametaken"){
            echo '<h6 class="red-text center">User name is already taken.</h6>';
        }
    }
    ?>
    <form action="includes/signup.inc.php" method="post">
        <input type="text" name="uname" placeholder="Username">
        <input type="email" name="emailid" placeholder="Email">
        <input type="password" name="pwd" placeholder="Password">
        <input type="password" name="pwd2" placeholder="Confirm Password">
    <button type="submit" name="signup-sub" class="btn brand z-depth-0">Signup</button>
    <a href="login.php"class="right" style="padding:10px">Have an account?</a>
</form>

<?php include('templates/footer.php')?>

</html>