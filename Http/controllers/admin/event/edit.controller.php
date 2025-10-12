<?php

use Core\App;
use Core\Session;
use Http\Models\GalleryImage;

$errors = Session::get('errors', []);

$id = $_GET["id"] ?? 0;
$galleryImage = App::resolve(GalleryImage::class)->fetchGalleryImageById($id);
$readableImagePaths[] = handleImage($galleryImage["image"]);

view(
    "admin/gallery/edit.view.php",
    compact('galleryImage', 'readableImagePaths', 'errors')
);
