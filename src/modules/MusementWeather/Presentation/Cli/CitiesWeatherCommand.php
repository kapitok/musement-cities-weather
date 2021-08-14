<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Presentation\Cli;

use LogicException;
use Mlozynskyy\MusementWeather\Application\Service\CitiesWeatherService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function str_repeat;

class CitiesWeatherCommand extends Command
{

    protected static $defaultName = 'app:cities:list';

    private CitiesWeatherService $service;

    public function __construct(CitiesWeatherService $service)
    {
        $this->service = $service;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Cities Weather APP');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$output instanceof ConsoleOutputInterface) {
            throw new LogicException('This command accepts only an instance of "ConsoleOutputInterface".');
        }

        $readModels = $this->service->getCitiesWeather();

        $output->writeln(\str_repeat('=', 50));

        foreach ($readModels as $readModel) {
            $output->writeln(
                \sprintf(
                    'Processed city %s | %s - %s',
                    $readModel->getCityName(),
                    $readModel->getTodayCondition(),
                    $readModel->getTomorrowCondition(),
                ),
            );
        }

        $output->writeln(str_repeat('=', 50));

        return Command::SUCCESS;
    }
}
