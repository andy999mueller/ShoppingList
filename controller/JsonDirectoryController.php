<?php
class JsonDirectoryController
{
   /**
    * Constructor for this JsonDirectoryController that takes the file idenfier
    */
   function __construct(string $JsonDirectory)
   {
      $this->AllJsonFiles = scandir($JsonDirectory);
      $this->AllJsonFiles = array_diff($this->AllJsonFiles, array('.', '..'));
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
   public function GetAllJsonFiles(): array
   {
      return $this->AllJsonFiles;
   }

   /**
    * Removes the given JsonFilePathAndFileName
    * @param string $JsonFilePathAndFileName file to be removed from directory
    */
   public function RemoveFile(string $JsonFilePathAndFileName)
   {
      unlink($JsonFilePathAndFileName);
   }
}
