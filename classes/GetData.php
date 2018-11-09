<?php namespace MariuszAnuszkiewicz\classes;

class GetData
{
    private $filePathToView;

    public function getReadingProcess()
    {
        $results = file_get_contents($this->getFileToView("view"), FILE_USE_INCLUDE_PATH);
        $json = json_decode($results,true);
        return $json['members'];
    }

    public function getFileToView($location)
    {
        switch ($location) {
            case "view":
                return $this->filePathToView = __DIR__ . "/../web/uploads/data.json";
            break;

            case "link":
                return $this->filePathToView = $_SERVER['REQUEST_URI'] . "/../../web/uploads/data.json";
            break;
        }
    }
}
