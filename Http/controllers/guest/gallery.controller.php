<?php

use Core\App;
use Http\Models\GalleryImage;

$images = App::resolve(GalleryImage::class)->fetchGalleryImages();

view(
    "guest/gallery.view.php",
    compact('images')
);
