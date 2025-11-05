<?php

namespace Http\Forms;

use Core\Validator;

class TestimonialForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);

        if (!Validator::not_empty($image)) {
            $this->errors["image"] = "Atleast one image is required.";
        }

        if (!Validator::not_empty($name)) {
            $this->errors["name"] = "Client name is required.";
        }

        if (!Validator::not_empty($work)) {
            $this->errors["work"] = "Client work is required.";
        }

        if (!Validator::quantity($rating, 1, 5)) {
            $this->errors["rating"] = "Choose rating between 1-5.";
        }

        if (!Validator::not_empty($feedback)) {
            $this->errors["feedback"] = "Client feedback is required.";
        }
    }
}
