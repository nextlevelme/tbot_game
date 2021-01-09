<?php

namespace App\TelegramBot\Commands\UserCommands;

use Doctrine\ORM\EntityManagerInterface;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Psr\Log\LoggerInterface;

/**
 * Start command
 */
class NewCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'new';

    /**
     * @var string
     */
    protected $description = 'New command';

    /**
     * @var string
     */
    protected $usage = '/new';

    /**
     * @var string
     */
    protected $version = '1.2.0';


    /**
     * Command execute method
     *
     * @return ServerResponse
     * @throws TelegramException
     */
    public function execute()
    {
        global $kernel;
        $container = $kernel->getContainer();
        $em = $container->get('doctrine.orm.entity_manager');

        return $this->replyToChat(
            'Новая игра создана!'
        );
    }
}
