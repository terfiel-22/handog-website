<?php

use Core\App;
use Http\Models\Event;
use Http\Models\Faq;

$events = App::resolve(Event::class)->fetchUpcomingEvents();
$faqs = App::resolve(Faq::class)->fetchFaqs();

view(
    "guest/index.view.php",
    compact('events', 'faqs')
);
