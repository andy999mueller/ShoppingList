<?php
include_once("Article.php");

//This class descibes a ShoppingList with array of articles
class ShoppingList implements JsonSerializable
{
   /**
    * Constructor for one ShoppingList with identifier, description and its articles
    * @param $Identifier string
    * @param $Description string
    * @param $Articles array
    */
   function __construct(string $Identifier ,string $Description, array $Articles)
   {
      $this->Identifier = $Identifier;
      $this->Description = $Description;
      $this->Articles = $Articles;
   }

   /**
    * Identifier string for this ShoppingList
    * @var string
    */
   private string $Identifier;

   /**
    * Description string for this ShoppingList
    * @var string
    */
   private string $Description;

   /**
    * Array of articles in this ShoppingList
    * @var array
    */
   private array $Articles;

   /**
    * Add one single Article
    * @param $ArticleToAdd Article
    */
   public function addArticle(Article $ArticleToAdd)
   {
      array_push($this->Articles,$ArticleToAdd);
   }

   /**
    * Remove one single article
    * @param $ArticleToRemove Article
    */
   public function removeArticle(Article $ArticleToRemove)
   {
      $key = array_search($ArticleToRemove,$this->Articles);
      unset($this->Articles[$key]);
   }

   /**
    * Get the identifier string for this shopping list
    */
   public function getIdentifier() : string
   {
      return $this->Identifier;
   }

   /**
    * Specify data which should be serialized to JSON
    * Serializes the object to a value that can be serialized natively by json_encode().
    *
    * @return mixed Returns data which can be serialized by json_encode(), which is a value of any type other than a resource .
    */
   function jsonSerialize()
   {
      $vars = get_object_vars($this);
      return $vars;
   }
}