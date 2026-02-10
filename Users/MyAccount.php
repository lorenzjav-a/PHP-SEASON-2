<?php

session_start();

if(isset($_SESSION["email"])){
    $email = $_SESSION["email"];
}else{
    echo "<script>window.location.href='../';</script>";
}


include("../connections.php");

    $query_info = mysqli_query($connections, "SELECT * FROM tbl_user WHERE email='$email'");

    $my_info = mysqli_fetch_assoc($query_info);

    $account_type = $my_info["account_type"];

    $img = $my_info["img"];

include("nav.php");

?>

<script src="../Admin/js/jQuery.js"></script>

<style>
    img{ height:150px; }
</style>

<script type="application/javascript">

var _URL = window.URL || window.webkitURL;

function displayPreview(files) {

    var file = files[0];
    var img = new Image();
    var sizeKB = file.size / 1024;

    img.onload = function() {
        $('#preview').append(img);

    }

    img.src = _URL.createObjectURL(file);

}
</script>

<br>
<br>

<?php

$target_dir = "photo_folder/";
$uploadErr = "";

if(isset($_POST["btnUpload"])){

    $target_file = $target_dir . "/" . basename($_FILES["profile_pic"]["name"]);

    $uploadOk = 1;

    if (file_exists($target_file)){
        $target_file = $target_dir . rand(1,9) . rand(1,9) . rand(1,9) . rand(1,9) . "_" . basename($_FILES["profile_pic"]["name"]);

        $uploadOk = 1;

    }

    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    if ($_FILES["profile_pic"]["size"] > 500000000000000000000000000000) {

        $uploadErr = "Sorry, your file is too large. ";

        $uploadOk = 0;

    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){

        $uploadErr = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

        $uploadOk = 0;

    }

    if ($uploadOk == 1) {

        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)){

            mysqli_query($connections, "UPDATE tbl_user SET img='$target_file' WHERE email='$email'");

            $notify = "<font color=green> Your profile photo has been uploaded! </font>";

            echo "<script>window.location.href='MyAccount?notify$notify';</script>";

        }else{

            echo "Sorry, there was an error uploading your file.";

        }
    }
}

if (empty($_GET["notify"])){

    // do nothing

}else{

    echo "<center>" . $_GET["notify"] . "</center>";

}

if ($img == ""){

    echo "<center> No Photo </center>";

}else{

    echo "<center> <img src='$img' height '150px' width '200px'> </center>";

}


?>
<form method="POST" enctype="multipart/form-data">

    <table border="0" width="30%">

        <tr><td colspan="2"> <center> <span id="preview"></span> </center> </td></tr>

        <tr><td colspan="2"><hr></td></tr>

        <tr>
            <td width="50%"> <input type="file" id="profile_pic" name="profile_pic" onchange="displayPreview(this.files);"/></td>
            <td></td>
        </tr>

        <tr>
            <td colspan="2">
                <center>
                    <input type="submit" name="btnUpload" class="btn-update" value="Upload">
                </center>
            </td>
        </tr>

    </table>
</form>

<span class="error"><?php echo $uploadErr; ?></span>