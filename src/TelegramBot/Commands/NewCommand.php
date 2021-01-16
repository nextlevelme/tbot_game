<?php

namespace App\TelegramBot\Commands\UserCommands;

use App\Entity\TgChat;
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
        $doctrine = $container->get('doctrine');
        $chat = $this->getUpdate()->getMessage()->getChat();
        $tgChatExtId = $chat->getId();
        if (empty($tgChatExtId)) {
            throw new \Exception('Empty chat ext ID');
        }

        $tgChat = $doctrine->getRepository(TgChat::class)->findOneBy(['ext_id' => $tgChatExtId]);
        if (is_null($tgChat)) {
            $tgChat = new TgChat();
            $tgChat->setAllMembersAreAdministrators($chat->getAllMembersAreAdministrators());
            $tgChat->setExtId($tgChatExtId);
            $tgChat->setFirstName($chat->getFirstName());
            $tgChat->setLastName($chat->getLastName());
            $tgChat->setTitle($chat->getTitle());
            $tgChat->setType($chat->getType());
            $tgChat->setUsername($chat->getUsername());

            $em = $doctrine->getManager();
            $em->persist($tgChat);
            $em->flush();
        } else {
            $o = 0;
        }

        return $this->replyToChat(
            'Новая игра создана!'
        );
    }
}
