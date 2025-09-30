<?php

namespace Http\Forms;

use Core\Validator;
use Http\Enums\PaymentStatus;
use Http\Enums\ReservationTimeRange;
use Http\Enums\TimeSlot;
use Http\Enums\YesNo;

class ReservationForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);

        if (!Validator::in_options($time_slot, TimeSlot::toArray())) {
            $this->errors["time_slot"] = "Please select a valid timeslot.";
        }
        if (!Validator::in_options($rent_videoke, YesNo::toArray())) {
            $this->errors["rent_videoke"] = "Please select a valid option.";
        }
        if (!Validator::in_options($time_range, ReservationTimeRange::toArray())) {
            $this->errors["time_range"] = "Please select a valid time range.";
        }

        if (!Validator::quantity($guest_count)) {
            $this->errors["guest_count"] = "Guest count is required.";
        }
        if (!Validator::not_empty($facility)) {
            $this->errors["facility"] = "Please select a valid facility.";
        }

        if (!Validator::not_empty($contact_person)) {
            $this->errors["contact_person"] = "Contact person is required.";
        }
        if (!Validator::not_empty($contact_no)) {
            $this->errors["contact_no"] = "Contact number is required.";
        }
        if (!Validator::not_empty($contact_email)) {
            $this->errors["contact_email"] = "Contact email is required.";
        }
        if (!Validator::not_empty($contact_address)) {
            $this->errors["contact_address"] = "Contact address is required.";
        }


        if (!Validator::not_empty_array($guests)) {
            $this->errors["guests"] = "Atleast one guest is required.";
        }


        if (!Validator::in_options($payment_status, PaymentStatus::toArray())) {
            $this->errors["payment_status"] = "Please select a valid payment status.";
        }
    }
}
