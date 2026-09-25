<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * Fisher fields that are hidden from other fishers until the affinity
 * between them reaches the threshold configured in the hydrosphere.
 */
final class RevealableField extends Enum implements LocalizedEnum
{
    const Country = 'country_id';

    const Language = 'language_id';

    const Uf = 'uf';

    const City = 'city';

    const Gender = 'gender';

    const Birthdate = 'birthdate';

    const ProfileImage = 'profile_image';

    const Name = 'name';

    const Neighborhood = 'neighborhood';

    const Email = 'email';

    const Cep = 'cep';

    const Zipcode = 'zipcode';

    const Address = 'address';

    const Number = 'number';

    const Complement = 'complement';

    const InternationalAddress = 'international_address';

    const Lat = 'lat';

    const Long = 'long';
}
