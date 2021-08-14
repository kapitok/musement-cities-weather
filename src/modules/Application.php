<?php

declare(strict_types=1);

namespace Mlozynskyy;

use Dotenv\Dotenv;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

/**
 * Class Application
 *
 * @package Mlozynskyy
 */
class Application
{

    /** @var ConsoleApplication */
    private ConsoleApplication $application;

    public function __construct()
    {
        $this->application = new ConsoleApplication();
    }

    /**
     * @throws \Exception
     */
    public function run(): void
    {
        $this->application->run();
    }

    /**
     * @return $this
     */
    public function init(): self
    {
        $this->loadEnvFiles();
        $this->loadContainer();

        return $this;
    }

    /**
     * @SuppressWarnings("static")
     */
    protected function loadEnvFiles(): void
    {
        $dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../../');
        $dotenv->load();
    }

    /**
     * @SuppressWarnings("unused")
     */
    protected function loadContainer(): void
    {
        $container = new ContainerBuilder();
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__));
        $loader->load(__DIR__ . '/../services.php');
        $container->compile();

        // @codingStandardsIgnoreLine
        foreach ($container->findTaggedServiceIds('consoleCommand') as $commandServiceName => $services) {
            /** @var Command $commandInstance */
            $commandInstance = $container->get($commandServiceName);

            if (!$commandInstance instanceof Command) {
                continue;
            }

            $this->application->add($commandInstance);
        }
    }

}
