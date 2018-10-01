<?php namespace MariuszAnuszkiewicz\classes\GetData;

class GetData
{
    const FILE = "../web/uploads/data.json";

    public function getReadingProcess()
    {
        $results = file_get_contents(self::FILE, FILE_USE_INCLUDE_PATH);
        $json = json_decode($results,true);
        return $json['members'];
    }

    public function getUrlFile()
    {
        return self::FILE;
    }
}
