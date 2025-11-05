<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Forms\TestimonialForm;
use Http\Models\Testimonial;

$origTestimonial = App::resolve(Testimonial::class)->fetchTestimonialById($_POST["id"]);

$existingImage = json_decode($_POST['existing_images'], true);
$_POST["image"] = $existingImage[0] ?? $_FILES["images"]["name"][0];

TestimonialForm::validate($_POST);

if (reset($existingImage) != $_POST["image"]) {
    $fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->multipleFiles($_FILES['images'])["success"];
    $_POST["image"] = reset($fileuploadResult);

    // Delete old image
    App::resolve(FileUploadHandler::class)->deleteFile($origTestimonial["image"]);
} else {
    $_POST["image"] = $origTestimonial["image"];
}

/** START Update Testimonial Data on Database **/
unset($_POST["_method"]);
unset($_POST["existing_images"]);
App::resolve(Testimonial::class)->updateTestimonial($origTestimonial["id"], $_POST);
/** END Update Testimonial Data on Database **/

redirect("/admin/testimonials");
