<?php

namespace App\Filament\Resources\Auth\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        $countries = countries();
        return $schema
            ->components([
                TextInput::make('name')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('password')
                    ->password(fn(Page $livewire) => ($livewire instanceof CreateRecord))
                    ->required(fn(Page $livewire) => ($livewire instanceof CreateRecord))
                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                    ->dehydrated(fn($state) => filled($state))
                    ->maxLength(255),
                Select::make('country')
                    ->options(collect($countries)->mapWithKeys(function ($country) {
                        return [$country['name'] => $country['name']];
                    })->all())
                    ->searchable(),
                Select::make('role')
                    ->multiple()
                    ->relationship('roles', 'name', function ($query) {
                        if (!auth()->user()->hasRole('super_admin')) {
                            $query->where('name', '!=', 'super_admin');
                        }
                        return $query;
                    })
                    ->preload()
            ]);
    }
}
