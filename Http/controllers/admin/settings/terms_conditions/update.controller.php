<?php

use Core\App;
use Core\FileUploadHandler;
use Http\Enums\FileType;
use Http\Forms\TermsConditionsForm;
use Http\Models\TermsConditions;

$filepath = $_FILES['filepath'];
$filedata = [
    "name" => $filepath['name'],
    "type" => $filepath['type'],
];

$termsForm = TermsConditionsForm::validate($filedata);

$fileuploadResult = App::resolve(FileUploadHandler::class)->upload('files', [FileType::PDF])->singleFile($_FILES['filepath']);

if (!$fileuploadResult['success']) {
    $termsForm->error(
        "filepath",
        "There's an error uploading the file, try again."
    )->throw();
}

$attributes = [
    'filepath' => $fileuploadResult['path']
];

$origTerms = App::resolve(TermsConditions::class)->fetchTermsConditionsById($_POST["id"]);

if (!$origTerms) {
    App::resolve(TermsConditions::class)->createTermsConditions($attributes);
    redirect('/admin/settings/terms-conditions');
    die();
}

$attributes['id'] = $origTerms['id'];
App::resolve(TermsConditions::class)->updateTermsConditions($attributes);
App::resolve(FileUploadHandler::class)->deleteFile($origTerms["filepath"]);
redirect('/admin/settings/terms_conditions');
