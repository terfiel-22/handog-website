<?php

use Core\App;
use Http\Models\Folder;

$folders = App::resolve(Folder::class)->fetchFoldersWithImages();

view(
    "admin/gallery/index.view.php",
    compact('folders')
);
