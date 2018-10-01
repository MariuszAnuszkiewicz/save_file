<?php namespace MariuszAnuszkiewicz\classes\SendData;

class SendData
{
   const FILE = "../web/uploads/data.json";

   public function sendProcess($data)
   {
      $save = file_put_contents(self::FILE, $data) ? true : false;
      if ($save == false) {
          throw new \Exception('Dane nie zostały zapisane');
      }
      return $save;
   }
}