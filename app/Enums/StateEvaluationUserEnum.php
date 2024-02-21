<?php

namespace App\Enums;

enum StateEvaluationUserEnum
{
    case ASSIGNED;
    case EVALUATED;

    public function getId(): int
    {
        return match ($this) {
            StateEvaluationUserEnum::ASSIGNED => 1,
            StateEvaluationUserEnum::EVALUATED => 2,
        };
    }

    public function getName(): string
    {
        return match ($this) {
            StateEvaluationUserEnum::ASSIGNED => 'ASIGNADO',
            StateEvaluationUserEnum::EVALUATED => 'EVALUADO',
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
