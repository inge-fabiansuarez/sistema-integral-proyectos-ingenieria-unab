<?php

namespace App\Enums;

enum StateEventEnum
{
    case OPEN;
    case CLOSE;

    public function getId(): int
    {
        return match ($this) {
            StateEventEnum::OPEN => 1,
            StateEventEnum::CLOSE => 2,
        };
    }

    public function getName(): string
    {
        return match ($this) {
            StateEventEnum::OPEN => 'ABIERTO',
            StateEventEnum::CLOSE => 'CERRADO',
        };
    }

    public static function from($id)
    {
        foreach (self::cases() as $caso) {
            if ($caso->getId() == $id) {
                return $caso;
            }
        }
    }

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $caso) {
            $array[$caso->getId()] = $caso->getName();
        }
        return $array;
    }
}
