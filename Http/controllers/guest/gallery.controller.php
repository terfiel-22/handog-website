<?php

use Core\App;
use Http\Models\Folder;

$folders = App::resolve(Folder::class)->fetchFoldersWithImages();

view(
    "guest/gallery.view.php",
    compact('folders')
);
