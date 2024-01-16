<?php

namespace App\Command;

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
    public function __construct(private EntityManagerInterface $entityManager)
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
        $toArchive = $this->entityManager->createQuery('SELECT i FROM App\Entity\Item i WHERE i.isArchived = false AND i.isValidated = false')->getResult();
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
