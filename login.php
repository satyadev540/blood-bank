<?php
$con = new mysqli("localhost","root","","data") or die(mysqli_error($con));
global $emailhr;
if(isset($_POST["submit"]))
{
    $email = $_POST["email"];
    $psw = $_POST["psw"];
    $sql1 = "SELECT * FROM hospitaregistration WHERE email = '$email'";
    $sql2 = "SELECT * FROM receiverregistration WHERE email = '$email'";
    $result1 = mysqli_query($con, $sql1) or die(mysqli_error($con));
    $result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
    if(mysqli_num_rows($result1) > 0)
    {
        $sql3 = "SELECT password from hospitaregistration WHERE email = '$email'";
        $result3 = mysqli_query($con, $sql3) or die(mysqli_error($con));
        $res1 = mysqli_fetch_assoc($result3);
        if($res1['password'] != $psw)
        {
            echo "<script> alert('wrong password');</script>";
        }
        else
        {
            echo "<script> alert('password');</script>";

        }
    }
    if(mysqli_num_rows($result2) > 0)
    {
        $sql4 = "SELECT password from receiverregistration WHERE email = '$email'";
        $result4 = mysqli_query($con, $sql4) or die(mysqli_error($con));
        $res2 = mysqli_fetch_assoc($result4);
        if($res2['password'] != $psw)
        {
            echo "<script> alert('wrong password');</script>";
        }
        else
        {
            echo "<script> alert('password');</script>";

        }
    }
    if(mysqli_num_rows($result1) == 0 && mysqli_num_rows($result2) == 0 )
    {
        echo "<script> alert('Email not registered');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Blood Bank</title>
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li style = "float:left" class="center">Blood Bank</li>
                    <li style = "float:left"><a href="index.php">Home</a></li>
                    <li><a href="registration.php">Registration</a></li>
                    <li class="active"><a href="login.php">Login</a></li>
                </ul>
            </nav>
        </header>
        <br><br><br>
        <div id="login">
            <form method="post">
                <fieldset>
                    <legend>Login</legend>
                    <div class="container">
                        <label for="email"><b>Email</b></label>
                        <input type="email" placeholder="Enter Email" name="email" id="email" required>
                
                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" id="password" required>
                        
                        <button class="lb" name = "submit" type="submit" id="btn">Login</button>
                    </div>
                    <div class="container">
                    <button type="button" class="cancelbtn lb"><a href="index1.php">Cancel</button>
                    </div>
                </fieldset>
              </form>
        </div>
        <div class="footer">
            <p>&copy; 2023 Blood Bank</p>
        </div>
    </body>
    <script>
        const email = document.getElementById("email");
        const password = document.getElementById("password");
        const form = document.querySelector('form');
        const submitBtn = document.querySelector('#btn');
        const inputs = [email, password]; 
        inputs.forEach(input => {
        input.addEventListener('input', () => {
            const allInputsFilled = inputs.every(input => input.value.trim() !== '');
            if (allInputsFilled) 
            {
                submitBtn.style.backgroundColor = 'green';
            } 
            else 
            {
                submitBtn.style.backgroundColor = '#b32134';
            }
        });
        });
    </script>
</html>