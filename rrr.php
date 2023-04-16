<?php
$con = new mysqli("localhost","root","","data") or die(mysqli_error($con));
if(isset($_POST["submitrr"]))
{
    $name = $_POST["uname"];
    $emailrr = $_POST["emailrr"];
    $pswrr = $_POST["pswrr"];
    $psw_repeatrr = $_POST["psw_repeatrr"];
    $blood = $_POST["blood"];
    $sql = "SELECT * FROM receiverregistration WHERE email = '$emailrr'";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    if(mysqli_num_rows($result) > 0)
    {
        echo "<script> alert('Email address $emailhr is present in the database');</script>";
    }
    if($psw_repeatrr != $pswrr)
    {
        echo "<script> alert('Password miss match');</script>";
    }
    else
    {
        $query = "INSERT INTO receiverregistration VALUES('$name','$emailrr','$pswrr','$psw_repeatrr','$blood')";
        $result = mysqli_query($con,$query)or die(mysqli_error($con));  
        header('Location: login.php');
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
        <div id = "registration2">
            <form name = "myForm" method="post">
                <fieldset>
                    <legend>Donor Registration</legend>
                    <div class="container">            
                    <label for="name"><b>Name</b></label>
                    <input type="text" placeholder="Enter name" name="uname" id="name" required >

                    <label for="email"><b>Email</b></label>
                    <input type="email" placeholder="Enter Email" name="emailrr" id="email" required >
                
                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="pswrr" id="psw" required>
                    <div id="message">
                        <h3>Password must contain the following:</h3>
                        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                        <p id="number" class="invalid">A <b>number</b></p>
                        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                    </div>
                
                    <label for="psw-repeat"><b>Repeat Password</b></label>
                    <input type="password" placeholder="Repeat Password" name="psw_repeatrr" id="psw-repeat" required>

                    <br>
                    <label for="bloodG"><b>Choose Blood Group</b></label>
                        <select id="bloodgroup" name="blood">
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        </select>
                    <br>
                    <br>
                    <button type="submit" value="submit" name="submitrr" class="lb" id="btn">Register</button>
                    </div>
                    
                    <div class="container">
                        <button type="button" class="cancelbtn lb"><a href="registration.html">Cancel</button>
                    </div>
                </fieldset>
              </form>
        </div>
        <div class="footer">
            <p>&copy; 2023 Blood Bank</p>
        </div>
    </body>
    <script>
        const name = document.getElementById("name");
        const email = document.getElementById("email");
        const pass = document.getElementById("psw");
        const c_pass = document.getElementById("psw-repeat");
        const blood = document.getElementById("bloodgroup");
        const form = document.querySelector('form');
        const submitBtn = document.querySelector('#btn');
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");
        const inputs = [name,email, pass, c_pass,blood];
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