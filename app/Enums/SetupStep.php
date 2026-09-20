<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * A screen the game can return to, named in the route segment that carries it.
 */
enum SetupStep: string
{
    /** The player list. */
    case User = 'user';

    /** Resume or restart an unfinished game. */
    case Continue = 'continue';

    /** Board selection. */
    case Board = 'board';

    /** Single, or against the computer. */
    case Mode = 'mode';

    /** Pawn selection. */
    case Pawn = 'pawn';

    /** Pawn selection for the opponent. */
    case PawnTwo = 'pawn-two';

    /** Tutorial, or straight to play. */
    case Option = 'option';

    /**
     * The step a route belongs to, or null for a route outside the flow.
     */
    public static function forRoute(?string $routeName): ?self
    {
        return array_find(
            self::cases(),
            static fn (self $step): bool => $step->routeName() === $routeName,
        );
    }

    /**
     * The route this step names.
     */
    public function routeName(): string
    {
        return match ($this) {
            self::User => 'select.player',
            self::Continue => 'select.continue',
            self::Board => 'select.board',
            self::Mode => 'select.mode',
            self::Pawn => 'select.pawn',
            self::PawnTwo => 'select.pawnTwo',
            self::Option => 'select.options',
        };
    }
}
