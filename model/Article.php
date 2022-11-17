<?php
//This class descibes an easy article inside a ShoppingList
class Article implements JsonSerializable
{
   /**
    * Constructor for one Article that is composed of identifier, name and whether this article is checked
    * @param $Identifier string
    * @param $Name string
    * @param $IsChecked string
    */
   function __construct(string $Identifier, string $Name, bool $IsChecked)
   {
      $this->Identifier = $Identifier;
      $this->Name = $Name;
      $this->IsChecked = $IsChecked;
   }

   /**
    * Identifier string for one article
    * @var string
    */
   private string $Identifier;

   /**
    * Name of one article
    * @var string
    */
   private string $Name;

   /**
    * Whehter this article is checked
    * @var bool
    */
   private bool $IsChecked;

   /**
    * Get the identifier string
    * @return string
    */
   function getIdentifier(): string
   {
      return $this->Identifier;
   }

   /**
    * Set the identifier string
    * @param string $Identifier
    * @return Article
    */
   function setIdentifier(string $Identifier): self
   {
      $this->Identifier = $Identifier;
      return $this;
   }

   /**
    * Get the name of this article
    * @return string
    */
   function getName(): string
   {
      return $this->Name;
   }

   /**
    * Set the name of this article
    * @param string $Name
    * @return Article
    */
   function setName(string $Name): self
   {
      $this->Name = $Name;
      return $this;
   }

   /**
    * Get whether this article is already checked
    * @return bool
    */
   function getIsChecked(): bool
   {
      return $this->IsChecked;
   }

   /**
    * Set whether this article is already checked
    * @param bool $IsChecked
    * @return Article
    */
   function setIsChecked(bool $IsChecked): self
   {
      $this->IsChecked = $IsChecked;
      return $this;
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