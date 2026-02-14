<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Pages\Dashboard;

class EditProfile extends BaseEditProfile
{
    protected function getRedirectUrl(): ?string
    {
        return Dashboard::getUrl();
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Profile updated successfully';
    }
}
