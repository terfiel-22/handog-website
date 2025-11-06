<?php

namespace Http\Forms;

use Core\Validator;

class LogoForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);

        if (!Validator::not_empty($logo)) {
            $this->errors["logo"] = "A logo is required.";
        }

        if (!Validator::not_empty($icon)) {
            $this->errors["icon"] = "An icon is required.";
        }
    }
}
