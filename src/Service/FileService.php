<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileService {

    private $stringService;
    private $fileName;

    public function __construct(StringService $stringService){
        $this->stringService = $stringService;
    }

    public function getFileName():string{
        return $this->fileName;
    }

    public function upload(UploadedFile $uploadedFile, string $directory):void{
        $this->fileName = "{$this->stringService->getToken()}.{$uploadedFile-> guessClientExtension()}";
        $uploadedFile->move($directory, $this->fileName);
    }

    public function remove(string $directory, string $filename):void{
        unlink("$directory/$filename");
    }
}