<?php

namespace Http\Forms;

use Core\Validator;

class EventForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);


        if (!Validator::not_empty($name)) {
            $this->errors["name"] = "Event name is required.";
        }

        if (!Validator::not_empty($description)) {
            $this->errors["description"] = "Event description is required.";
        }

        if (!Validator::not_empty($date)) {
            $this->errors["date"] = "Event date is required.";
        }

        if (!Validator::not_empty($image)) {
            $this->errors["image"] = "An image is required.";
        }
    }
}
