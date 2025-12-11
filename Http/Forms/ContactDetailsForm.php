<?php

namespace Http\Forms;

use Core\Validator;

class ContactDetailsForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);

        if (!Validator::link($facebook)) {
            $this->errors["facebook"] = "Please enter a valid Facebook link.";
        }
        if (!Validator::link($instagram)) {
            $this->errors["instagram"] = "Please enter a valid Instagram link.";
        }
        if (!Validator::not_empty($email)) {
            $this->errors["email"] = "Website email is required.";
        }
        if (!Validator::phone($contact_no)) {
            $this->errors["contact_no"] = "Please enter a valid contact number.";
        }
        if (!Validator::link($instagram)) {
            $this->errors["instagram"] = "Please enter a valid Instagram link.";
        }
        if (!Validator::not_empty($address)) {
            $this->errors["address"] = "Address is required.";
        }
    }
}
