<Br>
<br>
<br>
<br>

<center>
    <table border="0" width="80%">
        <tr>
            <td width="16%"><b>Name</td>
            <td width="10%"><b>Gender</td>
            <td width="16%"><b>Contact</td>
            <td width="16%"><b>Email</td>
            <td width="16%"><b>Password</td>
            <td width="16%"><center><b>Action</td>
        </tr>
    
        <tr>

            <td colspan='6'> <hr> </td>
    
        </tr>


<?php


include("../connections.php");



$retrieve_query = mysqli_query($connections,"SELECT * FROM tbl_user WHERE account_type='2' ");

while($row_users = mysqli_fetch_assoc($retrieve_query)){

    $id_user = $row_users["id_user"];

    $db_first_name = $row_users["first_name"];
    $db_middle_name = $row_users["middle_name"];
    $db_last_name = $row_users["last_name"];

    $db_gender = ucfirst ($row_users["gender"]);

    $db_preffix = $row_users["preffix"];
    $db_seven_digit = $row_users["seven_digit"];
    $db_email = $row_users["email"];
    $db_password = $row_users["password"];

    $full_name = ucfirst($db_first_name)." ".ucfirst($db_middle_name[0]).". ".ucfirst($db_last_name); 
    
    $contact = $db_preffix.$db_seven_digit;

    $jScript = md5(rand(1,9));

    $newScript = md5(rand(1,9));

    $getUpdate = md5(rand(1,9));

    $getDelete = md5(rand(1,9));

    echo "
    
    <tr> 
            
            <td>$full_name</td>
            <td>$db_gender</td>
            <td>$contact</td>
            <td>$db_email</td>
            <td>$db_password</td>
            
            <td> 
                <center>

                    <br>
                    <br>

                    <a href='?jScript=$jScript && newScript=$newScript && getUpdate=$getUpdate && id_user=$id_user' class='btn-update'>Update</a>

                    &nbsp;

                    <a href='?jScript=$jScript && newScript=$newScript && getDelete=$getDelete && id_user=$id_user' class='btn-delete'>Delete</a>

                    <br>
                    <br>

                </center>
            
            </td>
    
    </tr>";

    echo "
    
        <tr>

            <td colspan='6'> <hr> </td>
    
        </tr>

    ";
}


?>
</table>