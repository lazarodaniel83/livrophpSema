<?php # Script 8.3 -register.php

    $page_title = 'Register';
    include('includes/header.html');
    
    if(isset($_POST['submited']))
    {
        $errors = array();
        
        if(empty($_POST['first_name']))
        {
            $error[]='You forgot to enter your name.';
        }else
        {
            $fn = trim($_POST['first_name']);
        }
        if(empty($_POST['last_name']))
        {
            $errors[] = 'You forgor to enter your last name.';
        }else
        {
            $ln = trim($_POST['last_name']);
        }
        if(empty($_POST['email']))
        {
            $errors[] = 'You forgot to enter your email address.';
        }else
        {
            $e = trim($_POST['email']);
        }
        if(!empty($_POST['pass1']))
        {
            if($_POST['pass1'] != $_POST['pass2'])
            {
                $errors[] = 'You password did not match the confirmed password.';
            }else
            {
                $p = trim($_POST['pass1']);
            }
        }else
        {
            $errors[] = 'You forgot to enter your password.';
        }
        if(empty($errors))
        {
            require_once('../mysqli_connect.php');
            $q = "INSERT INTO users (first_name,last_name,email,pass,registration_date)values ('$fn','$ln','$e',SHA1('$p'),NOW())";
            $r = @mysqli_query($dbc,$q);
            
            if($r)
            {
                echo '<h1>Thank you!</h1><p>You are now registred. No cap 11 vc ser capaz de efetuar o login!</p><p><br/></p>';
            }else
            {
                echo '<h1>System Error</h1><p class="error">You could not be registred due to a system error. We apologize for any inconvenience.</p>';
                echo '<p>' . mysqli_error($dbc) . '<br/><br/>Query: '.$q.'</p>';
            }
            
            mysqli_connect();
            require('../footer.html');
            exit();
        }else
        {
            echo '<h1>Error!</h1><p class="erro">The following >> error(s) occurred:<br/>';
            foreach($errors as $msg)
            {
                echo" - $msg<br />\n";
            }
            echo '</p><p>Please try again.</p><p><br/></p>';
            
        }
    }
    ?>
<h1>Register</h1>
<form action="register.php" method="post">
    <p>
        First Name: <input type="text" name="first_name" size="15" maxlength="20" value="<?php if(isset($_POST['first_name'])) 
            echo $_POST['first_name'];?>"/>
    </p>
    <p>
        Last Name: <input type="text" name="last_name" size="15" maxlength="20" value="<?php if(isset($_POST['last_name']))
            echo $_POST['last_name'];?>"/>
    </p>
    <p>
        Email: <input type="text" name="email" size="15" maxlength="80" value="<?php if(isset($_POST['email']))
            echo $_POST['email'];?>"/>
    </p>
    <p>
        Confirm Password: <input type="password" name="pass1" size="10" maxlength="20"/>
    </p>
    <p>
        <input type="hidden" name="submited" value="TRUE"/>
    </p>
</form>
<?php
include('includes/footer.php');
?>


