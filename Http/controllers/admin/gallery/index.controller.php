<?php

use Core\App;
use Http\Models\GalleryImage;

$images = App::resolve(GalleryImage::class)->fetchGalleryImages();

view(
    "admin/gallery/index.view.php",
    compact('images')
);
