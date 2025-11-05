<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Forms\TestimonialForm;
use Http\Models\Testimonial;

$_POST["image"] = $_FILES["images"]["name"][0];
$testimonialForm = TestimonialForm::validate($_POST);

$fileuploadResult = App::resolve(FileUploadHandler::class)->upload()->multipleFiles(
    $_FILES['images']
);
if (!$fileuploadResult['success']) {
    $testimonialForm->error(
        "image",
        "There's an error uploading image, try again."
    )->throw();
}

$_POST['image'] = $fileuploadResult['success'][0];

App::resolve(Testimonial::class)->createTestimonial($_POST);

redirect("/admin/testimonials");
