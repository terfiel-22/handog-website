<?php

namespace Http\Forms;

use Core\Validator;

class FaqForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);


        if (!Validator::not_empty($question)) {
            $this->errors["question"] = "FAQ question is required.";
        }

        if (!Validator::not_empty($answer)) {
            $this->errors["answer"] = "FAQ answer is required.";
        }
    }
}
