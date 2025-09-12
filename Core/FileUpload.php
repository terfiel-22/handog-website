<?php

namespace Core;

class FileUpload
{
    private $uploadedFile;
    private $fileType;
    private $fileName;

    public function upload($file, $fieldName)
    {
        if (isset($file[$fieldName])) {
            $this->uploadedFile = $file[$fieldName];
            $this->fileName = time() . "_" . basename($file[$fieldName]["name"]);
            $this->fileType = strtolower(pathinfo($this->fileName, PATHINFO_EXTENSION));
        }

        return $this;
    }

    public function image()
    {
        if (!(isset($this->uploadedFile) && $this->uploadedFile["error"] === UPLOAD_ERR_OK)) return;
        if (!getimagesize($this->uploadedFile['tmp_name'])) return;
        if ($this->uploadedFile['size'] > 800000) return;

        $allowedExtension = [
            "jpg",
            "png",
            "jpeg",
            "gif",
            "svg"
        ];
        if (!in_array($this->fileType, $allowedExtension)) return;

        $newFilePath = "uploads/images/" . $this->fileName;
        if (move_uploaded_file($this->uploadedFile["tmp_name"], $newFilePath)) {
            return $newFilePath;
        }
    }

    public function removeFile($filename)
    {
        try {
            if (file_exists($filename)) {
                unlink($filename);
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }
}
