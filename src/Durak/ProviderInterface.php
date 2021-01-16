<?php


namespace App\Durak;


interface ProviderInterface
{
    public function loadGame(string $tgChatExtId) : ?Durak;

    public function storeGame(Durak $game) : bool;
}