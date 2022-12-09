<?php
include_once("JsonDirectoryController.php");
include_once("JsonFileController.php");
include_once(__DIR__."/../model/ShoppingList.php");

class ShoppingListController
{
   /**
   * Constructor for this shopping list controller. This controller is responsible for all shopping lists
   * @param: Json directory controller to receive all json files with shopping lists
   */
   function __construct(JsonDirectoryController $jsonDirectoryController)
   {
      $this->JsonDirectoryController = $jsonDirectoryController;
      $allJsonFiles = $this->JsonDirectoryController->GetAllJsonFiles();
      $this->ShoppingLists = array();
      foreach($allJsonFiles as $fileName)
      {
         $fileIdentifer = basename($fileName,'.json');
         $jsonFileController = new JsonFileController($this->EntriesPath.$fileIdentifer);
         $jsonContent = $jsonFileController->ReadJsonFromFile();
         array_push($this->ShoppingLists,$this->CreateShoppingList($jsonContent));
      }
   }

   /**
    * Json directory controller
    */
   private JsonDirectoryController $JsonDirectoryController;

   /**
    * Array of all shopping lists found in entries directory
    */
   private array $ShoppingLists;

   /**
    * Path to json entries. Relative to directory where this file is located
    */
   private string $EntriesPath = __DIR__ . "/../entries/";

   /**
    * Create an instance of a shopping list from given json string
    * @param: Json string containing a shopping list
    * @return: One new instance of a shopping list
    */
   private function CreateShoppingList(string $jsonString) : ShoppingList
   {
      $decodedJson = json_decode($jsonString);
      return new ShoppingList($decodedJson->Identifier,$decodedJson->Description,$decodedJson->Articles);
   }

   /**
    * Write a given shopping list to its corresponding json file with its identifier
    */
   private function WriteShoppingListToFile(ShoppingList $shoppingListToWrite)
   {
      $jsonFileController = new JsonFileController($this->EntriesPath.$shoppingListToWrite->getIdentifier());
      $jsonFileController->WriteJsonToFile(json_encode($shoppingListToWrite));
   }

   /**
    * Get all shopping lists found in entries directory as json string
    * @return: Get all Json decoded shopping lists
    */
   public function GetAllShoppingListsAsJson() : string
   {
      return json_encode($this->ShoppingLists);
   }

   /**
    * Get all shopping lists as php objects array
    */
   public function GetAllShoppingLists() : array
   {
      return $this->ShoppingLists;
   }

   /**
    * Create a new shopping list with new created uuid and given JSON string describing a shopping list.
    * It will also write the new shopping list into a json file in entries directory
    */
   public function CreateNewShoppingList(string $jsonShoppingList) : ShoppingList
   {
      $decodedJson = json_decode($jsonShoppingList);
      $newIdentifier = uniqid();
      $newShoppingList = new ShoppingList($newIdentifier,$decodedJson->Description,$decodedJson->Articles);
      $jsonFileController = new JsonFileController($this->EntriesPath.$newIdentifier);
      $jsonFileController->WriteJsonToFile(json_encode($newShoppingList));
      return $newShoppingList;
   }

   /**
    * Remove a shopping list from directory
    * @param string $shoppingListIdentifier json shopping list to be removed from directory
    */
   public function RemoveShoppingList(string $shoppingListIdentifier)
   {
      $fileToBeRemoved = $this->EntriesPath.$this->ShoppingLists[$shoppingListIdentifier]->getIdentifier().".json";
      var_dump($fileToBeRemoved);
      $this->JsonDirectoryController->RemoveFile($fileToBeRemoved);
   }

   /**
    * Update the given shopping list
    */
   public function UpdateShoppingList(string $shoppingListToUpdateJson)
   {
      $newShoppingList = $this->CreateShoppingList($shoppingListToUpdateJson);
      $this->WriteShoppingListToFile($newShoppingList);
   }
}