<?php
$purchaseString = "purchase";
$requestType = htmlspecialchars($_SERVER["REQUEST_METHOD"]);
$request = htmlspecialchars($_REQUEST["query"]);
//separate /purchase/123
list($requestUrl, $number) = explode("/", $request);
//if purchase is not set or the requested url is not set we exit here
if(!isset($requestUrl) || !strcasecmp($requestUrl, "purchase") == 0)
{
   exit;
}
//if purchase is part of the urls and the second part is not a number we will exit here, too
if(filter_var($number, FILTER_VALIDATE_INT) === false && !empty($number))
{
   exit;
}
//Check now the REST request type (post, get, put, delete)
switch($requestType)
{
   case "POST":
      break;
   case "GET":
      break;
   case "PUT":
      break;
   case "DELETE":
      break;
   default:
      break;
}
