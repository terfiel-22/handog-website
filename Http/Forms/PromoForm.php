<?php

namespace Http\Forms;

use Core\Validator;
use Http\Enums\YesNo;

class PromoForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);

        if (!Validator::not_empty($title)) {
            $this->errors["title"] = "Promo title is required.";
        }
        if (!Validator::not_empty($discount_value)) {
            $this->errors["discount_value"] = "Promo discount is required.";
        }
        if (!Validator::not_empty($description)) {
            $this->errors["description"] = "Promo description is required.";
        }
        if (!Validator::not_empty($start_date)) {
            $this->errors["start_date"] = "Promo start date is required.";
        }
        if (!Validator::not_empty($end_date)) {
            $this->errors["end_date"] = "Promo end date is required.";
        }
        if (!isset($facilities) || !Validator::not_empty_array($facilities)) {
            $this->errors["facilities"] = "Atleast one facility is required.";
        }
        if (!Validator::in_options($is_active, YesNo::toArray())) {
            $this->errors["is_active"] = "Please select a valid option.";
        }
    }
}
