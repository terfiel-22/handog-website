<?php

namespace Http\Forms;

use Core\Validator;
use Http\Enums\FacilityType;

class FacilityForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);

        if (!Validator::not_empty($name)) {
            $this->errors["name"] = "Facility name is required.";
        }
        if (!Validator::in_options($type, FacilityType::toArray())) {
            $this->errors["type"] = "Please select a valid facility type.";
        }
        if (!Validator::quantity($available_unit, 1)) {
            $this->errors["available_unit"] = "Atleast 1 available unit is required.";
        }
        if (!Validator::not_empty($description)) {
            $this->errors["description"] = "Facility description is required.";
        }
        if (!Validator::quantity($capacity)) {
            $this->errors["capacity"] = "Please put a valid capacity.";
        }

        if (!Validator::not_empty($image)) {
            $this->errors["image"] = "Atleast one image is required.";
        }
    }
}
