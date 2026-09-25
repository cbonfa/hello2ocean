<?php

declare(strict_types=1);

use App\Enums\GenderType;
use App\Enums\RevealableField;

return [

    GenderType::class => [
        GenderType::Male => 'Male',
        GenderType::Female => 'Female',
    ],

    RevealableField::class => [
        RevealableField::Country => 'Country',
        RevealableField::Language => 'Language',
        RevealableField::Uf => 'State',
        RevealableField::City => 'City',
        RevealableField::Gender => 'Gender',
        RevealableField::Birthdate => 'Birthdate',
        RevealableField::ProfileImage => 'Profile photo',
        RevealableField::Name => 'Real name',
        RevealableField::Neighborhood => 'Neighborhood',
        RevealableField::Email => 'E-mail',
        RevealableField::Cep => 'CEP',
        RevealableField::Zipcode => 'Zip code',
        RevealableField::Address => 'Address',
        RevealableField::Number => 'Address number',
        RevealableField::Complement => 'Address complement',
        RevealableField::InternationalAddress => 'International address',
        RevealableField::Lat => 'Latitude',
        RevealableField::Long => 'Longitude',
    ],

];
