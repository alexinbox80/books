<?php

namespace App\Controller\Cli;

use App\Domain\Model\CreateAuthorModel;
use App\Domain\Model\CreateBookModel;
use App\Domain\Service\AuthorService;
use App\Domain\Service\BookService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Faker\Factory as Faker;

final class EntityInitCommand extends Command
{
    public function __construct(
        private readonly AuthorService $authorService,
        private readonly BookService $bookService
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('data:add')
            ->setDescription('Adds data to author and book')
            ->addArgument('authors', InputArgument::REQUIRED, 'count of authors')
            ->addArgument('count', InputArgument::REQUIRED, 'How many books should be added');
    }

    private function generateData(int $authorId, int $count, $faker): \Generator
    {
        for ($i = 1; $i <= $count; $i++) {
            yield [
                'authorId' => $authorId + 1,
                'title' => $faker->words(rand(2, 5), true),
                'description' => $faker->text(rand(100, 200))
            ];
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $authors = (int)$input->getArgument('authors');
        $count = (int)$input->getArgument('count');

        $faker = Faker::create();

        for ($i = 0; $i < $authors; $i++) {
            $authorModel = new CreateAuthorModel(
                $faker->firstName,
                $faker->lastName,
                $faker->text(rand(100, 200))
            );

            $result = $this->authorService->create($authorModel);

            $books = $this->generateData($i, $count, $faker);

            foreach ($books as $book) {
                $bookModel = new CreateBookModel(
                    $book['authorId'],
                    $book['title'],
                    $book['description'],
                );
                $this->bookService->create($bookModel);
            }

//            for ($j = 0; $j < $count; $j++) {
//                $bookModel = new CreateBookModel(
//                    $i + 1,
//                    $faker->words(rand(2, 5), true),
//                    $faker->text(rand(100, 200))
//                );
//                $this->bookService->create($bookModel);
//            }
        }

        $output->write("<info> " . $authors * $count . " records were created</info>\n");

        return self::SUCCESS;
    }
}
