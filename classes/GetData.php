<?php namespace MariuszAnuszkiewicz\classes;

class GetData
{
    private $filePathToSave;

    public function getReadingProcess()
    {
        $results = file_get_contents($this->getFileToSave("view"), FILE_USE_INCLUDE_PATH);
        $json = json_decode($results,true);
        return $json['members'];
    }

    public function getFileToSave($location)
    {
        switch ($location) {
            case "view":
                return $this->filePathToSave = __DIR__ . "/../web/uploads/data.json";
            break;

            case "link":
                return $this->filePathToSave = $_SERVER['REQUEST_URI'] . "/../../web/uploads/data.json";
            break;
        }
    }
}
