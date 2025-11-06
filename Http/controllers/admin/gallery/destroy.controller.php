<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Models\Folder;

$folder = App::resolve(Folder::class)->fetchFolderById($_POST["item_id"]);

// Delete Image Files
$images = explode(',', $folder["images"]);
foreach ($images as $image) {
    App::resolve(FileUploadHandler::class)->deleteFile($image);
}

App::resolve(Folder::class)->deleteFolder($folder["id"]);

redirect("/admin/gallery");
