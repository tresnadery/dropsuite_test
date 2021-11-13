<?php

class FileReader{
    private $results = [], $countedContent, $maxCountedValue, $folderOrFiles, $path;

    public function read($path_folder){
        return $this->itterateFolderOrFile($path_folder)->getCountedValues()->maxContentValue()->maxContent();
    }

    private function itterateFolderOrFile($path_folder){
        $folderOrFiles = array_diff(preg_grep('/^([^.])/',scandir($path_folder)), array('.', '..'));
        foreach ($folderOrFiles as $key => $value) {
            $this->setPath($path_folder, $value); 
            if (is_dir($this->path)){
                $this->read($this->path);
                continue;
            }
            $this->getContent();
        }
        
        return $this;
    }

    private function setPath($path_folder, $value){
        $this->path = realpath($path_folder."/".$value);
        return $this;
    }

    private function getContent(){
        $handle = fopen($this->path, "r");
        
        while(!feof($handle)) {
            $content = fgets($handle);
        }

        fclose($handle);
        
        array_push($this->results, $content);
        return $this;
    }

    private function getCountedValues(){
        $this->countedContent = array_count_values($this->results);
        return $this;
    }

    private function maxContentValue(){
        if(count($this->results) == 0){
            return $this;
        }

        $this->maxCountedValue = max(array_count_values($this->results));
        return $this;
    }

    private function maxContent(){
        if(count($this->results) == 0){
            return "There is no file\n";
        }
        $maxContent = implode("",array_keys($this->countedContent, $this->maxCountedValue));
        return $maxContent ." ". $this->maxCountedValue."\n";
    }
}

