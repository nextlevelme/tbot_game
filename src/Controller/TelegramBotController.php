<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Exception\TelegramLogException;
use Longman\TelegramBot\TelegramLog;

/**
 * Class TelegramBotController
 * @package App\Controller
 */
class TelegramBotController extends AbstractController
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/telegram/bot", name="telegram_bot")
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $input = file_get_contents('php://input');
            $this->logger->debug($input);

            $telegramToken = $this->getParameter('app.telegram_api_token');
            $telegramName = $this->getParameter('app.telegram_api_name');
            // Create Telegram API object
            $telegram = new Telegram($telegramToken, $telegramName);


            // Requests Limiter (tries to prevent reaching Telegram API limits)
            $telegram->enableLimiter([
                'enabled' => true,
            ]);
            $telegram->addCommandsPaths([__DIR__ . '/../TelegramBot/Commands']);

            // Handle telegram webhook request
            $telegram->handle();

        } catch (TelegramException $e) {
            // Log telegram errors
            TelegramLog::error($e);
            $this->logger->debug($e->getMessage());
        } catch (TelegramLogException $e) {
            $this->logger->debug($e->getMessage());
        }

        return $this->json([]);
    }

    /**
     * @Route("/telegram/bot/set-webhook", name="telegram_bot__set_webhook")
     */
    public function setWebhook()
    {
        $telegramToken = $this->getParameter('app.telegram_api_token');
        $telegramName = $this->getParameter('app.telegram_api_name');
        $telegramWebhookUrl = $this->getParameter('app.telegram_api_webhook_url');
        $telegramCertPath = $this->getParameter('app.cert_path');

        try {
            // Create Telegram API object
            $telegram = new Telegram($telegramToken, $telegramName);

            // Set the webhook
            $result = $telegram->setWebhook($telegramWebhookUrl, ['certificate' => $telegramCertPath]);

            return $this->json(['response' => $result->getDescription()]);
        } catch (TelegramException $e) {
            return $this->json(['response' => $e->getMessage()]);
        }
    }

    /**
     * @Route("/telegram/bot/unset-webhook", name="telegram_bot__unset_webhook")
     */
    public function unsetWebhook()
    {
        $telegramToken = $this->getParameter('app.telegram_api_token');
        $telegramName = $this->getParameter('app.telegram_api_name');

        try {
            // Create Telegram API object
            $telegram = new Telegram($telegramToken, $telegramName);

            // Unset / delete the webhook
            $result = $telegram->deleteWebhook();

            return $this->json(['response' => $result->getDescription()]);
        } catch (TelegramException $e) {
            return $this->json(['response' => $e->getMessage()]);
        }
    }
}
