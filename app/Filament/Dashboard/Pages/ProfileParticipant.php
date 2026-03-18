<?php

namespace App\Filament\Dashboard\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ProfileParticipant extends Page
{
    protected string $view = 'filament.dashboard.pages.profile-participant';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;

    protected static ?string $navigationLabel = 'Participants';

    protected static string | UnitEnum | null $navigationGroup = 'Settings';
}
