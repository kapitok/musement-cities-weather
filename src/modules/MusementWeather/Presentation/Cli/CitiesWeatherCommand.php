<?php

declare(strict_types=1);

namespace Mlozynskyy\MusementWeather\Presentation\Cli;

use LogicException;
use Mlozynskyy\MusementWeather\Application\Service\CitiesWeatherService;
use Mlozynskyy\MusementWeather\Infrastructure\Rest\ApiException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

class CitiesWeatherCommand extends Command
{

    /** @var string */
    protected static $defaultName = 'app:cities:list';

    /** @var CitiesWeatherService */
    private CitiesWeatherService $service;

    /**
     * CitiesWeatherCommand constructor.
     *
     * @param CitiesWeatherService $service
     */
    public function __construct(CitiesWeatherService $service)
    {
        $this->service = $service;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Cities Weather APP');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @SuppressWarnings("unused")
     */
    // @codingStandardsIgnoreLine
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$output instanceof ConsoleOutputInterface) {
            throw new LogicException('This command accepts only an instance of "ConsoleOutputInterface".');
        }

        try {
            $output->writeln(str_repeat('=', 50));

            $readModels = $this->service->getCitiesWeather();

            foreach ($readModels as $readModel) {
                $output->writeln(
                    sprintf(
                        'Processed city %s | %s - %s',
                        $readModel->getCityName(),
                        $readModel->getTodayCondition(),
                        $readModel->getTomorrowCondition()
                    )
                );
            }
        } catch (ApiException $exception) {
            $output->writeln('Api problem please try again later');
        } catch (Throwable $exception) {
            $output->writeln('Something went wrong');
        } finally {
            $output->writeln(str_repeat('=', 50));
        }

        return Command::SUCCESS;
    }

}
