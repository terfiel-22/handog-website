<?php

namespace Http\Forms;

use Core\Validator;
use Http\Enums\AmenityType;

class AmenityForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);

        if (!Validator::not_empty($name)) {
            $this->errors["name"] = "Amenity name is required.";
        }

        if (!Validator::in_options($type, AmenityType::toArray())) {
            $this->errors["type"] = "Please select a valid amenity type.";
        }

        if (!Validator::not_empty($description)) {
            $this->errors["description"] = "Amenity description is required.";
        }

        if (!Validator::not_empty($image)) {
            $this->errors["image"] = "Atleast one image is required.";
        }
    }
}
