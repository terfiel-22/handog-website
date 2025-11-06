<?php

use Core\App;
use Core\Session;
use Http\Models\Folder;

$errors = Session::get('errors', []);

$id = $_GET["id"] ?? 0;
$folder = App::resolve(Folder::class)->fetchFolderById($id);

$images = explode(',', $folder["images"]);
$readableImagePaths = [];
foreach ($images as $image) {
    $readableImagePaths[] = handleFilePath($image);
}

view(
    "admin/gallery/edit.view.php",
    compact('folder', 'readableImagePaths', 'errors')
);
