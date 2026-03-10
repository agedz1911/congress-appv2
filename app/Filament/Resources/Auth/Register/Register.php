<?php

namespace App\Filament\Resources\Auth;

use Filament\Auth\Pages\Register as PagesRegister;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class Register extends PagesRegister
{
    public function form(Schema $schema): Schema
    {
        $countries = countries();
        return $schema->schema([
            $this->getNameFormComponent(),
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),

            Select::make('country')
                ->options(collect($countries)->mapWithKeys(function ($country) {
                    return [$country['name'] => $country['name']];
                })->all())
                ->searchable()
                ->required(),
        ]);
    }
}
