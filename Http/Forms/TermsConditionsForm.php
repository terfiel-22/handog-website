<?php

namespace Http\Forms;

use Core\Validator;
use Http\Enums\FileType;

class TermsConditionsForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);

        if ($type != FileType::PDF) {
            $this->errors["filepath"] = "An uploaded file should be a PDF.";
        }

        if (!Validator::not_empty($name)) {
            $this->errors["filepath"] = "An uploaded file is required.";
        }
    }
}
