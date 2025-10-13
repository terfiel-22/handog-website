<?php

use Core\App;
use Http\Forms\FaqForm;
use Http\Models\Faq;

FaqForm::validate($_POST);

App::resolve(Faq::class)->createFaq($_POST);

redirect("/admin/faqs");
