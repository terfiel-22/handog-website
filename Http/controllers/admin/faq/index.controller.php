<?php

use Core\App;
use Http\Models\Faq;

$faqs = App::resolve(Faq::class)->fetchFaqs();

view(
    "admin/faq/index.view.php",
    compact('faqs')
);
