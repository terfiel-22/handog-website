<?php

use Core\Session;
use Http\Services\ContactDetailService;

$contact = ContactDetailService::getContactDetails();
$errors = Session::get('errors', []);

view(
    "admin/settings/contact_details/show.view.php",
    compact('contact', 'errors')
);
