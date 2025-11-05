<?php

use Core\App;
use Http\Models\Testimonial;

$testimonials = App::resolve(Testimonial::class)->fetchTestimonials();

view(
    "admin/testimonial/index.view.php",
    compact('testimonials')
);
