<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TelegramBotController extends AbstractController
{
    /**
     * @Route("/telegram/bot", name="telegram_bot")
     */
    public function index()
    {
        return $this->render('telegram_bot/index.html.twig', [
            'controller_name' => 'TelegramBotController',
        ]);
    }
}
