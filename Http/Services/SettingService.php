<?php

namespace Http\Services;

use Core\App;
use Http\Models\Logo;

class SettingService
{
    protected static function logoModel()
    {
        return App::resolve(Logo::class);
    }

    /**
     * Get current user details
     */
    public static function getLogo()
    {
        $logoModel = self::logoModel();

        $logo = $logoModel->fetchLogo();

        if (!$logo) {
            return ['id' => 1, 'image' => 'assets/guest/img/logo/black-logo.svg'];
        }

        return $logo;
    }
}
