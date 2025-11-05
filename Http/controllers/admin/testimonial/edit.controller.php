<?php

use Core\App;
use Core\Session;
use Http\Models\Testimonial;

$errors = Session::get('errors', []);

$id = $_GET["id"] ?? 0;
$testimonial = App::resolve(Testimonial::class)->fetchTestimonialById($id);
$readableImagePaths[] = handleFilePath($testimonial["image"]);

view(
    "admin/testimonial/edit.view.php",
    compact('testimonial', 'readableImagePaths', 'errors')
);
