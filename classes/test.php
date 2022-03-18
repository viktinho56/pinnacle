<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$variables = array();
$variables['email'] = "Robert";
$variables['password'] = "30";

$template = file_get_contents("../helpers/emails/staffemail.html");

foreach($variables as $key => $value)
{
    echo $key;
    $template = str_replace('{{ '.$key.' }}', $value, $template);
}

echo $template;

?>