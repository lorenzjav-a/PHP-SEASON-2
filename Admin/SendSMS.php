<?php
session_start();
include("../connections.php");

if(isset($_SESSION["email"])){
    $email = $_SESSION["email"];
    $authention = mysqli_query($connections, "SELECT * FROM tbl_user WHERE email='$email'");
    $fetch = mysqli_fetch_assoc($authention);
    $account_type = $fetch["account_type"];

    if($account_type != 1){
        echo "<script>window.location.href='../Forbidden';</script>";
        exit();
    }
}

include("nav.php");

$contact = $contactErr = $smsResponse = "";

function sendSMS($phone, $message) {
    $apiKey = "sk_o2TyOyeYpuHgDIedUnQnEsDXH2DBGyZm";
    $url = "https://skysms.skyio.site/api/v1/sms/send";

    $data = [
        "phone_number" => $phone,
        "message" => $message,
        "use_subscription" => true
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "X-API-Key: $apiKey"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    if(curl_errno($ch)){
        $response = "Curl error: " . curl_error($ch);
    }
    curl_close($ch);

    return $response;
}

if(isset($_POST["btnSMS"])){ 

    if(empty($_POST["contact"])){ 
        $contactErr = "Required"; 
    } else { 
        $contact = trim($_POST["contact"]);
    }

    if($contact){

        $check_digits = strlen($contact); 
        
        if($check_digits < 11){ 
            $contactErr = "Mobile number must be 11 characters."; 
        } else { 
            if(substr($contact, 0, 2) === "09"){
                $contact = "+639" . substr($contact, 2);
            } elseif(substr($contact, 0, 3) === "+63"){
                // Already in correct format
            } else {
                $contactErr = "Invalid phone number format.";
            }
        }

        if(empty($contactErr)){
            $message = "Sir Ten I 4 mo na po kami!";

            $smsResponse = sendSMS($contact, $message);

            if(strpos($smsResponse, "error") !== false){
                $smsResponse = "Failed to send SMS: " . $smsResponse;
            } else {
                $smsResponse = "SMS sent successfully to $contact!";
            }
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Send SMS</title>
    <style>
        .error { color: red; }
        .success { color: blue; }
        input[type="text"] { padding: 5px; width: 200px; }
        input[type="submit"] { padding: 5px 10px; }
    </style>
</head>
<body>

<form method="POST">
    <input type="text" name="contact" value="<?php echo htmlspecialchars($contact); ?>" placeholder="09XXXXXXXXX">
    <input type="submit" name="btnSMS" value="Send SMS">
    <span class="error"><?php echo $contactErr; ?></span>
</form>

<?php if(!empty($smsResponse)): ?>
    <p class="<?php echo strpos($smsResponse, 'successfully') !== false ? 'success' : 'error'; ?>">
        <?php echo htmlspecialchars($smsResponse); ?>
    </p>
<?php endif; ?>

</body>
</html>