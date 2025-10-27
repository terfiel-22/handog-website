<?php

use Core\App;
use Http\Models\Event;
use Http\Models\Faq;
use Http\Models\Promo;

$events = App::resolve(Event::class)->fetchUpcomingEvents();
$faqs = App::resolve(Faq::class)->fetchFaqs();
$promos = App::resolve(Promo::class)->fetchOngoingPromos();

view(
    "guest/index.view.php",
    compact('events', 'faqs', 'promos')
);
