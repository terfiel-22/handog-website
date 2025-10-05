<?php

namespace Http\Forms;

use Core\Validator;
use Http\Constants\PaymongoPayment;
use Http\Enums\PaymentMethod;
use Http\Enums\ReservationTimeRange;
use Http\Enums\TimeSlot;

class BookingForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);

        if (!Validator::in_options($time_slot, TimeSlot::toArray())) {
            $this->errors["time_slot"] = "Please select a valid timeslot.";
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

        if (!Validator::in_options($payment_method, array_keys(PaymongoPayment::METHODS))) {
            $this->errors["time_range"] = "Please select a valid time range.";
        }
        if ($payment_method == PaymentMethod::CARD) {
            if (!Validator::not_empty($card_number)) {
                $this->errors["card_number"] = "Card number is required.";
            }
            if (!Validator::validCardNumber($card_number)) {
                $this->errors["card_number"] = "Card number must be 13–19 digits.";
            }

            if (!Validator::not_empty($exp_month)) {
                $this->errors["exp_month"] = "Expiration month is required.";
            }
            if (!Validator::validExpMonth($exp_month)) {
                $this->errors["exp_month"] = "Expiration month must be between 01 and 12";
            }

            if (!Validator::not_empty($exp_year)) {
                $this->errors["exp_year"] = "Expiration year is required.";
            }
            if (!Validator::validExpYear($exp_year)) {
                $this->errors["exp_year"] = "Expiration year cannot be in the past";
            }

            if (!Validator::not_empty($cvc)) {
                $this->errors["cvc"] = "CVC is required.";
            }
            if (!Validator::validCvc($cvc)) {
                $this->errors["cvc"] = "CVC must be 3 or 4 digits";
            }
        }
    }
}
