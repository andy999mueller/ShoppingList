<?php
include_once("../../controller/ShoppingListController.php");
include_once("../../controller/JsonDirectoryController.php");
include_once("./RestHandler.php");

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
$restHandler = new RestHandler();
//if purchase is part of the urls and the second part is not a number we will exit here, too
if(filter_var($number, FILTER_VALIDATE_INT) === false && !empty($number))
{
   $restHandler->CreateRestResponse(400,array());
   exit;
}
$shoppingListController = new ShoppingListController(new JsonDirectoryController(__DIR__."/../../entries"));
$jsonInput = file_get_contents('php://input');
//Check now the REST request type (post, get, put, delete)
switch($requestType)
{
   case "POST":
      $newShoppingList = $shoppingListController->CreateNewShoppingList($jsonInput);
      $restHandler->CreateRestResponse(201,$newShoppingList);
      break;
   case "GET":
      {
         $shoppingLists = $shoppingListController->GetAllShoppingLists();
         if(empty($shoppingLists))
         {
            $restHandler->CreateRestResponse(200,array());
            return;
         }
         if($number == '0')
         {
            $restHandler->CreateRestResponse(200,$shoppingLists[0]);
            return;
         }
         if(empty($number))
         {
            $restHandler->CreateRestResponse(200,$shoppingLists);
            return;
         }
         if(intval($number) > count($shoppingLists)-1)
         {
            $restHandler->CreateRestResponse(200,$shoppingLists[array_key_last($shoppingLists)]);
            return;
         }
         if(intval($number) < 0)
         {
            $restHandler->CreateRestResponse(200,$shoppingLists[array_key_first($shoppingLists)]);
            return;
         }
         $restHandler->CreateRestResponse(200,$shoppingLists[$number]);
      }
      break;
   case "PUT":
      $shoppingListController->UpdateShoppingList($jsonInput);
      $restHandler->CreateRestResponse(202,json_decode($jsonInput));
      break;
   case "DELETE":
      $shoppingListController->RemoveShoppingList($number);
      $restHandler->CreateRestResponse(200,"");
      break;
   default:
      {
         $restHandler->CreateRestResponse(405,array());
      }
      break;
}
