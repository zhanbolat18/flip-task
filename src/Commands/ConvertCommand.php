<?php
namespace App\Commands;


use App\Infrastructure\Implementation\Converter;
use App\Infrastructure\Implementation\CSVReader;
use App\Infrastructure\Implementation\Handler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConvertCommand extends Command
{
    const DESCRIPTION = 'Команда для конвертации CSV в XML';
    const HELP_DESCRIPTION = "
    Для выполнения команды вызовите 
    ./run.php convert \"имя/путь к CSV файлу\"";

    protected static $defaultName = 'convert';

    protected function configure()
    {
        $this->setDescription(self::DESCRIPTION);
        $this->setHelp(self::HELP_DESCRIPTION);
        $this->addArgument('file', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $converter = new Converter(
            new CSVReader(),
            new Handler()
        );

        $converter->convert($input->getArgument('file'))->save('php://output');
    }

}