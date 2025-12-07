<?php

namespace Http\Services;

use Core\App;
use Http\Models\SocialDetails;

class SocialService
{
    protected static function socialDetailsModel()
    {
        return App::resolve(SocialDetails::class);
    }

    /**
     * Get current socialDetails
     */
    public static function getSocialDetails()
    {
        $socialDetailsModel = self::socialDetailsModel();

        $socialDetails = $socialDetailsModel->fetchSocialDetail();

        if (!$socialDetails) {
            return [
                'id' => '',
                'facebook' => '',
                'instagram' => '',
                'email' => WEBSITE_EMAIL,
                'contact_no' => WEBSITE_NUMBER,
                'address' => WEBSITE_ADDRESS
            ];
        }

        return $socialDetails;
    }
}
