<?php

namespace Http\Services;

use Core\App;
use Http\Models\ContactDetails;

class ContactDetailService
{
    protected static function contactDetailModel()
    {
        return App::resolve(ContactDetails::class);
    }

    /**
     * Get current contact details
     */
    public static function getContactDetails()
    {
        $contactDetailModel = self::contactDetailModel();

        $contactDetails = $contactDetailModel->fetchContactDetail();

        if (!$contactDetails) {
            return [
                'id' => '',
                'facebook' => '',
                'instagram' => '',
                'email' => WEBSITE_EMAIL,
                'contact_no' => WEBSITE_NUMBER,
                'address' => WEBSITE_ADDRESS
            ];
        }

        return $contactDetails;
    }
}
