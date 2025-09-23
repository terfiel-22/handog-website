<?php

namespace Core;

class FileUploadHandler
{
    private string $uploadDir;
    private array $allowedTypes;
    private int $maxSize;

    public function upload(
        string $folderName = "images",
        array $allowedTypes = ["image/jpeg", "image/png", "image/gif"],
        int $maxSize = 5242880 // 5MB
    ) {

        $this->uploadDir = rtrim("uploads/$folderName", "/") . "/";
        $this->allowedTypes = $allowedTypes;
        $this->maxSize = $maxSize;

        // Create upload directory if it doesn't exist
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }

        return $this;
    }

    /**
     * Upload multiple files
     */
    public function multipleFiles(array $files): array
    {
        $uploadedFiles = [];
        $errors = [];

        foreach ($files["name"] as $index => $_) {
            $fileData = [
                "name"     => $files['name'][$index],
                "type"     => $files['type'][$index],
                "tmp_name" => $files['tmp_name'][$index],
                "error"    => $files['error'][$index],
                "size"     => $files['size'][$index],
            ];

            $result = $this->singleFile($fileData);

            if ($result['success']) {
                $uploadedFiles[] = $result['path'];
            } else {
                $errors[] = $result['error'];
            }
        }

        return [
            "success" => $uploadedFiles,
            "errors"  => $errors,
        ];
    }

    /**
     * Upload a single file
     */
    public function singleFile(array $file): array
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ["success" => false, "error" => "Upload error: {$file['name']}"];
        }

        if (!in_array($file['type'], $this->allowedTypes)) {
            return ["success" => false, "error" => "Invalid file type: {$file['name']}"];
        }

        if ($file['size'] > $this->maxSize) {
            return ["success" => false, "error" => "File too large: {$file['name']}"];
        }

        $safeName = uniqid() . "_" . basename($file['name']);
        $destination = $this->uploadDir . $safeName;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return ["success" => true, "path" => $destination];
        }

        return ["success" => false, "error" => "Failed to move file: {$file['name']}"];
    }

    /**
     * Delete file by path
     */
    public function deleteFile(string $filePath): bool
    {
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        return false;
    }
}
