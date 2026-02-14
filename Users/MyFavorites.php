<?php

session_start();

if(isset($_SESSION["email"])){
    $email = $_SESSION["email"];
}else{
    echo "<script>window.location.href='../';</script>";
}

include("../connections.php");

include("nav.php");

$check = $checkErr = "";

if (isset($_POST["btnSubmit"])){

    if(empty($_POST["check"])){
        $checkErr = "Select at least one ( 1 )";
    }else{
        $check = $_POST["check"];
    }

    if($check){

        echo "<br><br>";

        foreach($check as $new_check){

            echo $new_check . "<br>";

        }
    }
}


?>

<hr>

<form method="POST">

<span class="error"><?php echo $checkErr; ?></span> <br> <br>

<input type="checkbox" name="check[]" value="Beer"> Beer <Br>

<input type="checkbox" name="check[]" value="San Miglight Apple"> San Miglight Apple <Br>

<input type="checkbox" name="check[]" value="Alfonso Lights"> Alfonso Lights <Br>

<input type="checkbox" name="check[]" value="Great Taste White Choco"> Great Taste White Choco <Br>

<input type="submit" name="btnSubmit" value="Submit"> 

</form>

<hr>

<script type="text/javascript">

var Category = {

    "Car": ["Honda","BMW","Mustang"],
    "Food": ["Burger","Maling","Hotdog"],
    "Beer": ["Red Horse","Colt 45","San Miglight Apple"],
    "Beverages": ["Coke","Sarsi","Royal"],

}

function category(value){

        if (value.length == 0) document.getElementById("choice").innerHTML = "<option></option>";

        else {

            var category_options = "";

            for (category_name in Category[value]){

                category_options += "<option name='choice' value='" + Category[value][category_name] + "'>" + Category[value][category_name] + "</option>";

            }

            document.getElementById("choice").innerHTML = category_options;

        }
}

</script>

<select name="category" id="category" onChange="category(this.value);">

    <option name="category" value="">Select Category by Clicking Here</option>

    <option name="category" value="Car">Car</option>
    <option name="category" value="Food">Food</option>
    <option name="category" value="Beer">Beer</option>
    <option name="category" value="Beverages">Beverages</option>

</select>

<select name="choice" id="choice">

    <option name="choice" value="">Select Category First</option>

</select>