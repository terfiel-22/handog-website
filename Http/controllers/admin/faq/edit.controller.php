<?php

use Core\App;
use Core\Session;
use Http\Models\Faq;

$errors = Session::get('errors', []);

$id = $_GET["id"] ?? 0;
$faq = App::resolve(Faq::class)->fetchFaqById($id);

view(
    "admin/faq/edit.view.php",
    compact('faq', 'errors')
);
