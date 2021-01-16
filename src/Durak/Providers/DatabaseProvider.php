<?php


namespace App\Durak\Providers;


use App\Durak\Durak;
use App\Durak\ProviderInterface;

class DatabaseProvider implements ProviderInterface
{
    public function loadGame(string $tgChatExtId): ?Durak
    {
        // TODO: Implement loadGame() method.
    }

    public function storeGame(Durak $game): bool
    {
        // TODO: Implement storeGame() method.
    }
}