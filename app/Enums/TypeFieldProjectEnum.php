<?php

namespace App\Enums;

enum TypeFieldProjectEnum
{
    case TEXT;
    case FILE;

    public function getId(): int
    {
        return match ($this) {
            TypeFieldProjectEnum::TEXT => 1,
            TypeFieldProjectEnum::FILE => 2,
        };
    }

    public function getName(): string
    {
        return match ($this) {
            TypeFieldProjectEnum::TEXT => 'TEXTO',
            TypeFieldProjectEnum::FILE => 'ARCHIVO',
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
