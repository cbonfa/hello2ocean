<?php

declare(strict_types=1);

use App\Enums\GenderType;
use App\Enums\RevealableField;

return [

    GenderType::class => [
        GenderType::Male => 'Masculino',
        GenderType::Female => 'Feminino',
    ],

    RevealableField::class => [
        RevealableField::Country => 'País',
        RevealableField::Language => 'Idioma',
        RevealableField::Uf => 'Estado (UF)',
        RevealableField::City => 'Cidade',
        RevealableField::Gender => 'Gênero',
        RevealableField::Birthdate => 'Data de nascimento',
        RevealableField::ProfileImage => 'Foto de perfil',
        RevealableField::Name => 'Nome real',
        RevealableField::Neighborhood => 'Bairro',
        RevealableField::Email => 'E-mail',
        RevealableField::Cep => 'CEP',
        RevealableField::Zipcode => 'Código postal',
        RevealableField::Address => 'Endereço',
        RevealableField::Number => 'Número',
        RevealableField::Complement => 'Complemento',
        RevealableField::InternationalAddress => 'Endereço internacional',
        RevealableField::Lat => 'Latitude',
        RevealableField::Long => 'Longitude',
    ],

];
