<?php
class JsonDirectoryController
{
   /**
    * Constructor for this JsonDirectoryController that takes the file idenfier
    */
   function __construct(string $JsonDirectory)
   {
      $this->AllJsonFiles = scandir($JsonDirectory);
   }

   /**
    * File identifier string
    * @var array
    */
    private array $AllJsonFiles;

    /**
    * Read all Json files from given directory
    * @return array
    */
    public function GetAllJsonFiles() : array
    {
      return $this->AllJsonFiles;
    }
}
