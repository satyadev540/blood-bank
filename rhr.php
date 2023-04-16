<?php
$con = new mysqli("localhost","root","","data") or die(mysqli_error($con));
global $emailhr;
if(isset($_POST["submithr"]))
{
    $emailhr = $_POST["emailhr"];
    $pswhr = $_POST["pswhr"];
    $psw_repeathr = $_POST["psw_repeathr"];
    $sql = "SELECT * FROM hospitaregistration WHERE email = '$emailhr'";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    if (mysqli_num_rows($result) > 0) 
    {
        echo "<script> alert('Email address $emailhr is present in the database');</script>";
    }
    if($psw_repeathr != $pswhr)
    {
        echo "<script> alert('Password miss match');</script>";
    }
    else
    {
        $query = "INSERT INTO hospitaregistration VALUES('$emailhr','$pswhr','$psw_repeathr')";
        $result = mysqli_query($con,$query)or die(mysqli_error($con));  
        header('Location: login.php');
        exit();
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
        <nav>
            <ul>
                <li style = "float:left" class="center">Blood Bank</li>
                <li style = "float:left"><a href="index.php">Home</a></li>
                <li class="active"><a href="registration.php">Registration</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
        <br><br><br>
        <div id = "registration">
            <form name = "myForm"  method="post">
                <fieldset>
                    <legend>Registration</legend>
                    <div class="container">            
                    <label for="email"><b>Email</b></label>
                    <input type="email" placeholder="Enter Email" name="emailhr" id="email" required >
                
                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="pswhr" id="psw" minlength = "8" required>
                    <div id="message">
                        <h3>Password must contain the following:</h3>
                        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                        <p id="number" class="invalid">A <b>number</b></p>
                        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                    </div>
                
                    <label for="psw-repeat"><b>Repeat Password</b></label>
                    <input type="password" placeholder="Repeat Password" name="psw_repeathr" id="psw-repeat" minlength = "8" required>
                    
                
                    <button name="submithr" type="submit" class="lb" id="btn" >Register</button>
                    </div>
                    
                    <div class="container">
                        <button  type="button" class="cancelbtn lb"><a href="registration.php">Cancel</button>
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
        const pass = document.getElementById("psw");
        const c_pass = document.getElementById("psw-repeat");
        const form = document.querySelector('form');
        const submitBtn = document.querySelector('#btn');
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");
        const inputs = [email, pass, c_pass];
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
        pass.onkeyup = function() 
        {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if(pass.value.match(lowerCaseLetters)) 
            {  
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            }
            else 
            {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }
        
            var upperCaseLetters = /[A-Z]/g;
            if(pass.value.match(upperCaseLetters))
            {  
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            }
            else 
            {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            var numbers = /[0-9]/g;
            if(pass.value.match(numbers)) 
            {  
                number.classList.remove("invalid");
                number.classList.add("valid");
            } 
            else
            {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }
            if(pass.value.length >= 8)
            {
                length.classList.remove("invalid");
                length.classList.add("valid");
            }
            else
            {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        }

    </script>
    
</html>


