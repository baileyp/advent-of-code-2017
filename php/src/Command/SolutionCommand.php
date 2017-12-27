<?php

namespace App\Command;

use App\Solution\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use \UnexpectedValueException;

/**
 * Command runner for reading input, building solutions, and printing their results
 *
 * @codeCoverageIgnore
 */
class SolutionCommand extends Command
{
    private $solutionFactory;

    public function setSolutionFactory(Factory $factory) : SolutionCommand
    {
        $this->solutionFactory = $factory;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('puzzle:solution')
            ->setDescription('Run solution for any day that has been completed.')
            ->setHelp(<<<HELP
The <info>%command.name%</info> command runs a day's solutions for the 2017 Advent of Code.

Example of running Day 1, Part 1
    <info>%command.full_name% <comment>1 1</comment></info>
    
Example of running Day 1, Part 2
    <info>%command.full_name% <comment>1 2</comment></info>
    
To run and provide input directly
    <info>%command.full_name% <comment>1 1 'test input'</comment></info>
    
To run provide input from a file
    <info>%command.full_name% <comment>1 1 path/to/input/file</comment></info>
HELP
            )
            ->addArgument('day', InputArgument::REQUIRED, 'Which day\'s solution to run')
            ->addArgument('part', InputArgument::REQUIRED, 'Which part to run - 1 or 2')
            ->addArgument('input', InputArgument::OPTIONAL, 'Puzzle input. If ommitted, the common input file will be used.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $day = (int) $input->getArgument('day');
        $part = (int) $input->getArgument('part');

        if ($day < 1 || $day > 25) {
            throw new UnexpectedValueException('Day must be a number between 1 and 25');
        }

        if ($part !== 1 && $part !== 2) {
            throw new UnexpectedValueException('Part can only be 1 or 2');
        }

        $solution = $this->solutionFactory->createCallable($day, $part);

        $output->writeln("<info>Solving for Day <comment>$day</comment> Part <comment>$part</comment></info>");

        $start = microtime(true);
        $result = $solution($input->getArgument('input'));
        $elapsed = microtime(true) - $start;
        $memory = $this->formatMemory(memory_get_peak_usage());

        $output->writeln("<info>Result:</info> $result");
        $output->writeln("<info>Calculated in <comment>$elapsed</comment> seconds");
        $output->writeln("<info>Using <comment>$memory</comment> of memory");
    }

    /**
     * Format $bytes of memory to a Log1000 representation
     *
     * @param $bytes
     * @return string
     */
    private function formatMemory($bytes): string
    {
        $unit = ['B','KB','MB','GB','TB','PB'];
        if ($bytes==0) return '0 ' . $unit[0];
        return round($bytes/pow(1000,($i=floor(log($bytes,1000)))),2) .' '. (isset($unit[$i]) ? $unit[$i] : 'B');
    }
}

