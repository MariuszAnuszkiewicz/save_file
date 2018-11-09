<?php namespace MariuszAnuszkiewicz\classes;

class SendData
{
   public function sendProcess($file, $data)
   {
      $save = file_put_contents($file, $data) ? true : false;
      if ($save == false) {
          throw new \Exception('Dane nie zostały zapisane');
      }
      return $save;
   }
}
