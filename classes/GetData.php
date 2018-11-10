<?php namespace MariuszAnuszkiewicz\classes;

use MariuszAnuszkiewicz\Config\Files;

class GetData
{
    public function getReadingProcess()
    {
        $results = file_get_contents(Files::get('save_file'), FILE_USE_INCLUDE_PATH);
        $json = json_decode($results,true);
        return $json['members'];
    }
}
