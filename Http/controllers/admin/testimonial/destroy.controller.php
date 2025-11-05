<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Models\Testimonial;

$testimonial = App::resolve(Testimonial::class)->fetchTestimonialById($_POST["item_id"]);

App::resolve(FileUploadHandler::class)->deleteFile($testimonial["image"]);
App::resolve(Testimonial::class)->deleteTestimonial($testimonial["id"]);

redirect("/admin/testimonials");
