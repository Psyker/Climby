<?php

declare(strict_types=1);

namespace App\GraphQL\Type;

use GraphQL\Language\AST\StringValueNode;

class DateTimeType
{
    public static function serialize(\DateTimeInterface $value): string
    {
        return $value->format(\DateTimeImmutable::ATOM);
    }

    public static function parseValue(string $value = null): ?\DateTimeInterface
    {
        if (!$value) {
            return null;
        }

        $date = \DateTimeImmutable::createFromFormat(
            \DateTimeImmutable::ATOM,
            $value
        );

        if (!$date) {
            $date = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $value);
        }

        return $date !== false ? $date : null;
    }

    public static function parseLiteral(
        StringValueNode $node
    ): ?\DateTimeInterface {
        if ($node->value === null || $node->value === '') {
            return null;
        }

        $date = \DateTimeImmutable::createFromFormat(
            \DateTimeImmutable::ATOM,
            $node->value
        );

        if (!$date) {
            $date = \DateTimeImmutable::createFromFormat(
                'Y-m-d H:i:s',
                $node->value
            );
        }

        return $date !== false ? $date : null;
    }
}
