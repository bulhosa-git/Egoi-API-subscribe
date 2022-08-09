<?php
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Origin: https://www.domain.com');

/*
***************
** POST DATA **
***************
*/

//Using dummy data for documentation purposes, otherwise would use file_get_contents() to get POST data

$email = "test.".rand(1000,9999)."@domain.com";
$fullname = "artur filipe bulhosa dos santos";
$birthdate = "31/12/1999";
$phone = "910000000";
$region = "Porto";
$country = "Portugal";

//Egoi
$list = 0; //Egoi List (number)
$apiKey = "000000"; //Egoi API key (string)

/*
***************************
** VALIDATION / ENCODING **
***************************
*/

include 'include/validation.php';

/*
********************
** SUBSCRIBE USER **
********************
*/

//Make cURL request
$apiURL = "https://api.egoiapp.com/lists/".$list."/contacts";
$apiQuery = "{\"base\":{\"status\":\"active\", \"first_name\":\"".$fname."\", \"last_name\":\"".$lname."\", \"email\":\"".$email."\", \"cellphone\":\"".$phone."\", \"birth_date\":\"".$birthdate."\"}, \"extra\":[{\"field_id\": 286, \"value\": \"".$region."\"}, {\"field_id\": 287, \"value\": \"".$country."\"}]}";
$apiMethod = "POST";
$requestID = 1;
include 'include/cURL.php';

$output = json_decode($output, true);

if(isset($output['contact_id'])) {
    exit("XX009");
    //XX009 Success
}

if(isset($output['errors']['unique_field_in_use'])) {
    exit("XX004");
    //XX004 E-mail exists
}

exit("XX000");

//XX000 Error
//XX001 Invalid email
//XX002 Invalid date
//XX003 Invalid phone
//XX004 E-mail exists
//XX008 (N) cURL error
//XX009 Success
?>