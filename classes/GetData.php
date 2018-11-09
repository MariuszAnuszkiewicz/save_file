<?php namespace MariuszAnuszkiewicz\classes;

use MariuszAnuszkiewicz\Config\Config;

class GetData
{
    public function getReadingProcess()
    {
        $results = file_get_contents(Config::get('save_file'), FILE_USE_INCLUDE_PATH);
        $json = json_decode($results,true);
        return $json['members'];
    }
}
