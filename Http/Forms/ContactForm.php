<?php

namespace Http\Forms;

use Core\Validator;
use Http\Enums\ConcernType;
use Http\Enums\ReservationTimeRange;
use Http\Enums\TimeSlot;

class ContactForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);


        if (!Validator::not_empty($name)) {
            $this->errors["name"] = "Your name is required.";
        }
        if (!Validator::not_empty($email)) {
            $this->errors["email"] = "Your email is required.";
        }
        if (!Validator::in_options($concern, ConcernType::toArray())) {
            $this->errors["concern"] = "Please select a valid concern.";
        }
        if (!Validator::not_empty($message)) {
            $this->errors["message"] = "Your message is required.";
        }
    }
}
