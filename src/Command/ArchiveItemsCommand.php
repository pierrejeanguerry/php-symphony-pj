<?php

namespace App\Command;

use App\Controller\ItemController;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:archive-items',
)]
class ArchiveItemsCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager, private ItemRepository $repository)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
        ->setDescription('Archive non published items')
        ->setHelp('This command allows you to archive non published items')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $toArchive = $this->repository->getNonValidatedItems($this->entityManager);
        $nbToArchive = count($toArchive);
        $progressBar = new ProgressBar($output, $nbToArchive);
        foreach($toArchive as $item)
        {
            $item->setIsArchived(true);
            $this->entityManager->flush();
            $progressBar->advance();
        }
        $progressBar->finish();

        return Command::SUCCESS;
    }
}
