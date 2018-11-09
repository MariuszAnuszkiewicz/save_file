<?php namespace MariuszAnuszkiewicz\classes;

class SendData
{
   public function sendProcess($data)
   {
	  $filePath = __DIR__ . "/../web/uploads/data.json";
      $save = file_put_contents($filePath, $data) ? true : false;
      if ($save == false) {
          throw new \Exception('Dane nie zostały zapisane');
      }
      return $save;
   }
}