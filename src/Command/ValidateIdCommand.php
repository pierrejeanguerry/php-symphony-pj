<?php

namespace App\Command;

use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:validate-id',
)]
class ValidateIdCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager, private ItemRepository $repository)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
        ->setDescription('Validate item from its ID')
        ->setHelp('This command allows you to validate item from its ID')
        ->addArgument('id', InputArgument::OPTIONAL, 'Item ID')

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        if (!$id = $input->getArgument('id'))
        {
            $id = $io->ask("Entrer the item ID", 1, function(string $number): int{
                if (!is_numeric($number)) {
                    throw new \RuntimeException('You must type a number.');
                }
                return (int) $number;
            });
        }
        $result = $this->repository->findValidableItem($id);
        if (!$result){
            $io->error(sprintf("The with the ID %d, doesn't exist or can't be validated", $id));
            return Command::FAILURE;
        }
        $result[0]->setIsValidated(true);
        $this->entityManager->flush();
        $io->success('Item validated with success');

        return Command::SUCCESS;
    }
}
