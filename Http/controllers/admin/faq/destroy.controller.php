<?php

use Core\App;
use Http\Models\Faq;

$faq = App::resolve(Faq::class)->fetchFaqById($_POST["item_id"]);

App::resolve(Faq::class)->deleteFaq($faq["id"]);

redirect("/admin/faqs");
