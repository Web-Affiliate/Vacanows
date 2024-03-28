<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use App\Service\Mailer;
use App\Entity\Todo;
use App\Entity\Articles;
use App\Repository\TodoRepository;
use App\Repository\ArticlesRepository;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class AlertCurrentCommand extends Command
{
    protected static $defaultName = 'app:alert-current';
    protected static $defaultDescription = 'Send current alert emails';

    private $mailer;
    private $todoRepository;
    private $articlesRepository;
    private $parameters;

    public function __construct(Mailer $mailer, TodoRepository $todoRepository, ArticlesRepository $articlesRepository, ParameterBagInterface $parameterBag)
    {
        $this->mailer = $mailer;
        $this->todoRepository = $todoRepository;
        $this->articlesRepository = $articlesRepository;
        $this->parameters = $parameterBag;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName(self::$defaultName);
        $this->setDescription(self::$defaultDescription);
        $this->setHelp('This command allows you to send current alert emails');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $todos = $this->todoRepository->findAll();
        foreach ($todos as $todo) {
            $email = $todo->getMail();
            $token = $todo->getToken();
            $articles = $this->articlesRepository->findArticlesModifiedOneDayAgo();
            if (!empty($articles)) {
                $data = ['token' => $token, 'articles' => $articles];
                $this->mailer->sendCurrentAlert($email, $data);
            }
        }

        return Command::SUCCESS;
    }
}

//php bin/console app:alert-current

