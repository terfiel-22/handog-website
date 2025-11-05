<?php

use Core\App;
use Core\Session;
use Http\Models\Testimonial;

$errors = Session::get('errors', []);
$testimonials = App::resolve(Testimonial::class)->fetchTestimonials();

view(
    "guest/about.view.php",
    compact("testimonials", "errors")
);
