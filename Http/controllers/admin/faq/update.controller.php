<?php

use Core\App;
use Http\Forms\FaqForm;
use Http\Models\Faq;

// Check if gallery image exists
$origFaq = App::resolve(Faq::class)->fetchFaqById($_POST["id"]);

// Validate Form
FaqForm::validate($_POST);

/** START Update Faq Data on Database **/
unset($_POST["_method"]);
App::resolve(Faq::class)->updateFaq($origFaq["id"], $_POST);
/** END Update Faq Data on Database **/

redirect("/admin/faqs");
