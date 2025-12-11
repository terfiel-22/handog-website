<?php

namespace Http\Forms;

use Core\Validator;

class RatesForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);


        if (!Validator::quantity($adult_rate_day)) {
            $this->errors["adult_rate_day"] = "Please input a valid value.";
        }
        if (!Validator::quantity($adult_rate_night)) {
            $this->errors["adult_rate_night"] = "Please input a valid value.";
        }
        if (!Validator::quantity($kid_rate_day)) {
            $this->errors["kid_rate_day"] = "Please input a valid value.";
        }
        if (!Validator::quantity($kid_rate_night)) {
            $this->errors["kid_rate_night"] = "Please input a valid value.";
        }
        if (!Validator::quantity($senior_pwd_discount)) {
            $this->errors["senior_pwd_discount"] = "Please input a valid value.";
        }
        if (!Validator::quantity($videoke_rent)) {
            $this->errors["videoke_rent"] = "Please input a valid value.";
        }
        if (!Validator::quantity($additional_bed_rate)) {
            $this->errors["additional_bed_rate"] = "Please input a valid value.";
        }
        if (!Validator::quantity($pool_extension_rate_adult)) {
            $this->errors["pool_extension_rate_adult"] = "Please input a valid value.";
        }
        if (!Validator::quantity($pool_extension_rate_kid)) {
            $this->errors["pool_extension_rate_kid"] = "Please input a valid value.";
        }
        if (!Validator::quantity($cottage_extension_rate)) {
            $this->errors["cottage_extension_rate"] = "Please input a valid value.";
        }
    }
}
