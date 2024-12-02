<?php

declare(strict_types=1);

namespace App\Client\Domain\ValueObject;

enum ClientState: string
{
    case CA = 'CA';
    case NY = 'NY';
    case NV = 'NV';
    case WY = 'WY';

    /**
     * @return list<string>
     */
    public static function getValues(): array
    {
        $states = [];
        foreach (ClientState::cases() as $case) {
            $states[] = $case->value;
        }

        return $states;
    }
}
