<?php 

session_start();

$info = (Object)[];

//check if logged in
if (!isset($_SESSION['userid']))
{
    if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type != "login") {
        $info->logged_in = false;
        echo json_encode($info);
        die;        
    }

}

require_once("classes/initialise.php");
$DB = new Database();

$DATA_RAW = file_get_contents("php://input");
$DATA_OBJ = json_decode($DATA_RAW);

$Error = "";

//process the data
if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "signup")
{

    // signup
    include("includes/security.php");
} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "login")
{

    //login
    include("includes/login.php");

} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "user_info")
{

    //user info
    include("includes/user_info.php")

}