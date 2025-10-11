<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Models\GalleryImage;

$galleryImage = App::resolve(GalleryImage::class)->fetchGalleryImageById($_POST["item_id"]);

// Delete Image Files 
App::resolve(FileUploadHandler::class)->deleteFile($galleryImage["image"]);

App::resolve(GalleryImage::class)->deleteGalleryImage($galleryImage["id"]);

redirect("/admin/gallery");
