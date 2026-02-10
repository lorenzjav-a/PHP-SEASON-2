<?php
$connections = mysqli_connect("localhost", "root", "", "my_database");

if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_errno();
     

}

?>
<style>

.btn-primary{
    
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0px;
    font-family: Georgia;
    color: #ffffff;
    font-size: 16px;
    background: #34d9bd;
    padding: 10px 20px 10px 20px;;
    text-decoration: none;

}

.btn-primary{


    background: #4ccfb3;
    text-decoration: none;

}

.btn-update{
    font-family: Arial;
    color: #ffffff;
    font-size: 15px;
    background: #005eff;
    padding: 10px 20px 10px 20px;
    text-decoration: none;
}


.btn-update:hover{
    background: #076dad;
    text-decoration: none;

}

.error{
    color:red;
}


.btn-delete{
    font-family: Georgia;
    color: #ffffff;
    font-size: 15px;
    background: #d93434;
    padding: 10px 20px 10px 20px;
    text-decoration: none;
}


.btn-delete:hover{
    background: #fc3c3c;
    text-decoration: none;

}


</style>