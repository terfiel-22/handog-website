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
        if (!Validator::quantity($available_unit)) {
            $this->errors["available_unit"] = "Atleast 1 available unit is required.";
        }
        if (!Validator::not_empty($description)) {
            $this->errors["description"] = "Facility description is required.";
        }
        if (!Validator::quantity($capacity)) {
            $this->errors["capacity"] = "Atleast 1 capacity is required.";
        }
        if (!Validator::not_empty($image)) {
            $this->errors["image"] = "Atleast one image is required.";
        }

        // Rates  
        if (!Validator::is_less_than($rate_hourly, $rate_8hrs)) {
            $this->errors["rate_hourly"] = "Hourly rate must be less than 8-hour rate.";
        }
        if (!Validator::is_less_than($rate_8hrs, $rate_12hrs)) {
            $this->errors["rate_8hrs"] = "8-hour rate must be less than 12-hour rate.";
        }
        if (!Validator::is_less_than($rate_12hrs, $rate_1day)) {
            $this->errors["rate_12hrs"] = "12-hour rate must be less than 1-day rate.";
        }
        if (!Validator::quantity($rate_hourly)) {
            $this->errors["rate_hourly"] = "Hourly rate is required.";
        }
        if (!Validator::quantity($rate_8hrs)) {
            $this->errors["rate_8hrs"] = "8-hour rate is required.";
        }
        if (!Validator::quantity($rate_12hrs)) {
            $this->errors["rate_12hrs"] = "12-hour rate is required.";
        }
        if (!Validator::quantity($rate_1day)) {
            $this->errors["rate_1day"] = "1-day rate is required.";
        }
    }
}
