<?php

use Http\Forms\TermsConditionsForm;

$filepath = $_FILES['filepath'];
$filedata = [
    "name" => $filepath['name'],
    "type" => $filepath['type'],
];

TermsConditionsForm::validate($filedata);

dd($filedata);
