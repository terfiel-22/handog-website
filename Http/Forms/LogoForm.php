<?php

namespace Http\Forms;

use Core\Validator;

class LogoForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);

        if (!Validator::not_empty($image)) {
            $this->errors["image"] = "An image is required.";
        }
    }
}
