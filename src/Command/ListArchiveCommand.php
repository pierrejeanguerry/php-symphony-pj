<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:list-archive',
)]
class ListArchiveCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
        ->setDescription('List archived items')
        ->setHelp('This command allows you to list archived items')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $result = $this->entityManager->createQuery('SELECT i FROM App\Entity\Item i WHERE i.isArchived = true')->getResult();
        $io = new SymfonyStyle($input, $output);
        $io->title('List of archives items');
        $tableHeaders = ['id','name','publication_date','creator_id','description'];
        $tableRows = [];
        foreach($result as $item) {
            $tableRows[] = [$item->getId(), $item->getName(), date_format($item->getPublicationDate(), "d/m/Y"), $item->getCreator()->getId(), $item->getDescription()];
        }
        $io->table($tableHeaders, $tableRows);

        return Command::SUCCESS;
    }
}
