<?php namespace MariuszAnuszkiewicz\classes;

class GetData
{
    private $filePathToView;

    public function getReadingProcess($file)
    {
        $results = file_get_contents($file, FILE_USE_INCLUDE_PATH);
        $json = json_decode($results,true);
        return $json['members'];
    }

    public function getFileToView()
    {
        return $this->filePathToView = $_SERVER['REQUEST_URI'] . "/../../web/uploads/data.json";
    }
}
