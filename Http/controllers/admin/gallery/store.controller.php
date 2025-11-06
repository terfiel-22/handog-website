<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Forms\FolderForm;
use Http\Models\Folder;
use Http\Models\GalleryImage;

$_POST["image"] = $_FILES["images"]["name"][0];
$folderForm = FolderForm::validate($_POST);
unset($_POST["image"]);

// Save Folder on Database
$folderId = App::resolve(Folder::class)->createFolder($_POST);

/** START Upload the files and save to database. */
$fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->multipleFiles($_FILES['images']);
if (!empty($fileuploadResult["success"])) {
    foreach ($fileuploadResult['success'] as $image) {
        $galleryImage = [
            "folder_id" => $folderId,
            "image" => $image
        ];

        App::resolve(GalleryImage::class)->createGalleryImage($galleryImage);
    }
} else {
    $folderForm->error(
        "image",
        "There's an error uploading image, try again."
    )->throw();
}
/** END Upload the files and save to database. */

redirect("/admin/gallery");
