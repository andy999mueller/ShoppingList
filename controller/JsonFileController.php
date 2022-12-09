<?php
class JsonFileController
{
   /**
    * Constructor for this JsonFileController that takes the file idenfier
    */
   function __construct(string $FileIdentifier)
   {
      $this->FileIdentifier = $FileIdentifier;
      $this->FileName = $this->FileIdentifier . ".json";
   }

   /**
    * File identifier string
    * @var string
    */
   private string $FileIdentifier;

   /**
    * File name composed of identifier string and *.json file extension
    * @var string
    */
   private string $FileName;

   /**
    * Write given Json to file
    * @param string $JsonContent
    * @return int
    */
   public function WriteJsonToFile(string $JsonContent) : int
   {
      if (file_put_contents($this->FileName, $JsonContent))
      {
         return 0;
      }
      else
         return 1;
   }

   /**
    * Read a Json content from file
    * @return bool|string
    */
   public function ReadJsonFromFile() : string
   {
      return file_get_contents($this->FileName);
   }
}