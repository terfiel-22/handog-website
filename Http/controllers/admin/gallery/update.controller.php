<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Forms\FolderForm;
use Http\Models\Folder;
use Http\Models\GalleryImage;

// Check if facility exists
$origFolder = App::resolve(Folder::class)->fetchFolderById($_POST["id"]);
$origFolderImages = explode(',', $origFolder["images"]);

// Add image
$existingImage = json_decode($_POST['existing_images'], true);
$_POST["image"] = $existingImage[0] ?? $_FILES["images"]["name"][0];

// Validate Form
FolderForm::validate($_POST);

/** START Update Folder Data on Database **/
unset($_POST["_method"]);
unset($_POST["existing_images"]);
unset($_POST["image"]);
App::resolve(Folder::class)->updateFolder($origFolder["id"], $_POST);
/** END Update Folder Data on Database **/

/** START Handle Uploaded New Images */
$isAddedNewImage = !empty($_FILES['images']['name'][0]);

if ($isAddedNewImage && empty($existingImage)) {
    // Add new uploaded images
    $fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->multipleFiles($_FILES['images']);
    if (!empty($fileuploadResult["success"])) {
        foreach ($fileuploadResult["success"] as $image) {
            $galleryImage = [
                "folder_id" => $origFolder["id"],
                "image" => $image
            ];

            App::resolve(GalleryImage::class)->createGalleryImage($galleryImage);
        }

        // Remove old images
        foreach ($origFolderImages as $oldImage) {
            App::resolve(FileUploadHandler::class)->deleteFile($oldImage);
            App::resolve(GalleryImage::class)->deleteGalleryImageByPath($oldImage);
        }
    }
}
/** END Handle Uploaded New Images */


redirect("/admin/gallery");
