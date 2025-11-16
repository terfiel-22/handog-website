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
     * Get current logo
     */
    public static function getLogo($default = "assets/guest/img/logo/black-logo.svg")
    {
        $logoModel = self::logoModel();

        $logo = $logoModel->fetchLogo();

        if (!$logo) {
            return ['id' => 1, 'logo' => $default, 'icon' => 'assets/admin/images/logo-icon.png'];
        }

        return $logo;
    }
}
