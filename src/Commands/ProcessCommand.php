<?php

namespace Mustachio\Commands;

use InvalidArgumentException;
use Mustachio\Service;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class ProcessCommand extends Command
{
    protected function configure()
    {
        $this->setName('process')
            ->setDescription('Process specific template conversion')
            ->addArgument('template', InputArgument::REQUIRED, 'Pass the template stub name.')
            ->addArgument('destination', InputArgument::REQUIRED, 'Pass the template destination full path.')
            ->addArgument('params', InputArgument::REQUIRED, 'Parameters.');
    }
  
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $template = $input->getArgument('template');
        $destination = $input->getArgument('destination');

        // param1:value1;param2:value2
        $params = $input->getArgument('params');
        $params = explode(';', $params);
        $params = array_map(function ($param) {
            return explode(':', $param);
        }, $params);
        $templateParams = [];
        foreach ($params as $param) {
            $templateParams[$param[0]] = $param[1];
        }

        try {
            file_put_contents($destination, Service::parse(file_get_contents($template), $templateParams));
        } catch (InvalidArgumentException $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        }

        $output->writeln('<info>Stub parsed successfully: ' . $destination . '</info>');
        
        return Command::SUCCESS;
    }
}