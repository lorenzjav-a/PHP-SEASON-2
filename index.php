<?php
include("nav.php");
include("connections.php");
require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$headers = 'MIME-Version: 1.0'.PHP_EOL; // importante to
$headers .= 'Content-type: text/html; charset=iso-8859-1'.PHP_EOL; // importante to
$headers .= 'From: kay sender<From: kay sender>'.PHP_EOL;
function random_password( $length = 5 ) {                            
		$str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890";
		$shuffled = substr( str_shuffle( $str ), 0, $length );
		return $shuffled;
	     }
	$new_password = random_password(8); 
	$message = $new_password;
?>

<?php
$first_name = $middle_name = $last_name = $gender = $preffix = $seven_digit = $email = $password = "";
$first_nameErr = $middle_nameErr = $last_nameErr = $genderErr = $preffixErr = $seven_digitErr = $emailErr = $passwordErr= "";
if(isset($_POST["btnRegister"])) {
    if(empty($_POST["first_name"])) {
        $first_nameErr = "Required!";
    } else {
        $first_name = $_POST["first_name"];
    }	
    if(empty($_POST["middle_name"])) {
        $middle_nameErr = "Required!";
    } else {
        $middle_name = $_POST["middle_name"];
    }  
    if(empty($_POST["last_name"])) {
        $last_nameErr = "Required!";
    } else {
        $last_name = $_POST["last_name"];
    }
    if(empty($_POST["gender"])) {
        $genderErr = "Required!";
    } else {
        $gender = $_POST["gender"];
    }
    if(empty($_POST["preffix"])) {
        $preffixErr = "Required!";
    } else {
        $preffix = $_POST["preffix"];
    }
    if(empty($_POST["seven_digit"])) {
        $seven_digitErr = "Required!";
    } else {
        $seven_digit = $_POST["seven_digit"];
    }
    if(empty($_POST["email"])) {
        $emailErr = "Required!";
    } else {
        $email = $_POST["email"];
    }
    if($first_name && $middle_name && $last_name && $gender && $preffix && $seven_digit && $email) {
        if(!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
            $first_nameErr = "Letra lang at space ang kailangan wag kang jejemon!";
        } else {
            $count_first_name_string = strlen($first_name);
            if($count_first_name_string < 2) {
                $first_nameErr = "Masyadong maiksi ang name mo kapatid.";
            } else {
                $count_middle_name_string = strlen($middle_name);
                if($count_middle_name_string < 2) {
                    $middle_nameErr = "Masyadong maiksi ang middle name mo kapatid.";
                } else {
                    $count_last_name_string = strlen($last_name);
                    if($count_last_name_string < 2) {
                        $last_nameErr = "Masyadong maiksi ang last name mo kapatid.";
                    } else {
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $emailErr = "Invalid email format";
                        } else {
                            $count_seven_digit_string = strlen($seven_digit);
                            if($count_seven_digit_string < 7) {
                                $seven_digitErr = "brad kulang ang seven digit number mo.";
                            } else {
                               $password = random_password(8);
                                }

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'lorenzjohndelizo@gmail.com';
    $mail->Password   = 'mczvprfwbfgjvhru'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
    $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
    // Recipients
    $mail->setFrom('lorenzjohndelizo@gmail.com', 'PHPMailer');
    $mail->addAddress($email); // Use the variable from your form!
    
    // Content
    $mail->isHTML(true);
    $mail->Subject  = 'Default Password';
    $mail->Priority = 1; // This replaces your manual Header X-Priority: 1
    $mail->Body     = "Your generated password is: <b>$password</b>";

    $mail->send();
    
    // Database Insertion
    mysqli_query($connections, "INSERT INTO tbl_user(first_name, middle_name, last_name, gender, preffix, seven_digit, email, password, account_type)
                 VALUES('$first_name','$middle_name','$last_name','$gender','$preffix','$seven_digit','$email','$password','2')");
                 
    echo "<script>window.location.href='success.php';</script>";

} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
						    }                       
                        }
                    }
                }
            }
        }
    }
?>

<style>
.error {
    color: red;
}
</style>

<script type="application/javascript">
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if(charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>

<form method="POST">
<center>
<table border="0" width="50%">
<tr>
<td>
<input type="text" name="first_name" placeholder="First name" value="<?php echo $first_name; ?>">
<span class="error"><?php echo $first_nameErr; ?></span>
</td>
</tr>
<tr>
<td>
<input type="text" name="middle_name" placeholder="Middle name" value="<?php echo $middle_name; ?>">
<span class="error"><?php echo $middle_nameErr; ?></span>
</td>
</tr>
<tr>
<td>
<input type="text" name="last_name" placeholder="Last name" value="<?php echo $last_name; ?>">
<span class="error"><?php echo $last_nameErr; ?></span>
</td>
</tr>
<tr>
<td>
<select name="gender">
<option value="">Select Gender</option>
<option value="Male" <?php if($gender=="Male"){ echo "selected"; } ?>>Male</option>
<option value="Female" <?php if($gender=="Female"){ echo "selected"; } ?>>Female</option>
</select>
<span class="error"><?php echo $genderErr; ?></span>
</td>
</tr>
<tr>
<td>
<select name="preffix">
<option value="">Network Provided (Globe,Smart,Sun,TNT, TM etc.)</option>
<option value="0963" <?php if($preffix=="0963"){ echo "selected"; } ?>>0963</option>
<option value="0938" <?php if($preffix=="0938"){ echo "selected"; } ?>>0938</option>
<option value="0948" <?php if($preffix=="0948"){ echo "selected"; } ?>>0948</option>
<option value="0920" <?php if($preffix=="0920"){ echo "selected"; } ?>>0920</option>
<option value="0921" <?php if($preffix=="0921"){ echo "selected"; } ?>>0921</option>
<option value="0912" <?php if($preffix=="0912"){ echo "selected"; } ?>>0912</option>
<option value="0968" <?php if($preffix=="0968"){ echo "selected"; } ?>>0968</option>
<option value="0954" <?php if($preffix=="0954"){ echo "selected"; } ?>>0954</option>
<option value="0956" <?php if($preffix=="0956"){ echo "selected"; } ?>>0956</option>
<option value="0966" <?php if($preffix=="0966"){ echo "selected"; } ?>>0966</option>
<option value="0939" <?php if($preffix=="0939"){ echo "selected"; } ?>>0939</option>
<option value="0936" <?php if($preffix=="0936"){ echo "selected"; } ?>>0936</option>
<option value="0907" <?php if($preffix=="0907"){ echo "selected"; } ?>>0907</option>
<option value="0996" <?php if($preffix=="0996"){ echo "selected"; } ?>>0996</option>
<option value="0977" <?php if($preffix=="0977"){ echo "selected"; } ?>>0977</option>
</select>
<span class="error"><?php echo $preffixErr; ?></span>
<input type="text" name="seven_digit" value="<?php echo $seven_digit; ?>" maxlength="7" placeholder="Other Seven Digit" onkeypress='return isNumberKey(event)'>
<span class="error"><?php echo $seven_digitErr; ?></span>
</td>
</tr>
<tr>
<td>
<input type="text" name="email" value="<?php echo $email; ?>" placeholder="Email">
<span class="error"><?php echo $emailErr; ?></span>
</td>
</tr>
<tr>
<td><hr></td>
</tr>
<tr>
<td><input type="submit" name="btnRegister" value="Register"></td>
</tr>
</table>
</center>
</form>