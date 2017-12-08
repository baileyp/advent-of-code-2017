<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use \RuntimeException;
use \UnexpectedValueException;

class NewCommand extends Command
{
    private CONST SOLUTION_CLASS_TEMPLATE = <<<PHP
<?php

namespace App\Solution;

class %s extends AbstractSolution
{
    public function part1(): string
    {
        foreach (\$this->inputReader->readAll() as \$line) {
        }

        return parent::part1();
    }
    
    public function part2(): string
    {
        foreach (\$this->inputReader->readAll() as \$line) {
        }

        return parent::part2();
    }
}
PHP;

    private CONST UNIT_TEST_CLASS_TEMPLATE = <<<PHP
<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class %sTest extends SolutionTestCase
{
    const INPUT = '';

    public function test_part1(): string
    {
        \$this->expectReadAll();
        \$this->assertEquals('', \$this->solution->part1());
    }
    
    public function test_part2(): string
    {
        \$this->expectReadAll();
        \$this->assertEquals('', \$this->solution->part2());
    }
}
PHP;

    private const README_TEMPLATE = <<<MD
# Part 1

TBD

# Part 2

TBD

# Solutions

 - [PHP](../../php/src/Solution/%s.php)
MD;


    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('puzzle:new')
            ->setDescription('Create directories stub files for new day')
            ->setHelp(<<<HELP
The <info>%command.name%</info> command create directories and stud code/documentation files for new day's puzzle

Example creating stubs for day 17
    <info>%command.full_name% <comment>17</comment></info>

Don't forget you can always use shorthand
    <info>bin/advent p:n <comment>17</comment></info>
HELP
            )
            ->addArgument('day', InputArgument::REQUIRED, 'Which day\'s solution start')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $day = (int) $input->getArgument('day');

        if ($day < 1 || $day > 25) {
            throw new UnexpectedValueException('Day must be a number between 1 and 25');
        }

        $dir = sprintf("../common/day-%'02d", $day);

        $output->write("Creating directory <comment>$dir</comment>...");

        if (file_exists($dir)) {
            throw new RuntimeException("Solution for day $day already exists!");
        }

        if (!mkdir($dir, 0755)) {
            throw new \Exception("Could not create dir: $dir");
        }

        $output->writeln("<info>Done!</info>");

        $solutionClass = sprintf("Day%'02dSolution", $day);

        $this->createFile($dir . '/README.md', sprintf(self::README_TEMPLATE, $solutionClass), $output);
        $this->createFile($dir . '/input.txt', '', $output);
        $this->createFile("./src/Solution/$solutionClass.php", sprintf(self::SOLUTION_CLASS_TEMPLATE, $solutionClass), $output);
        $this->createFile("./tests/Solution/{$solutionClass}Test.php", sprintf(self::UNIT_TEST_CLASS_TEMPLATE, $solutionClass), $output);
    }

    protected function createFile(string $path, string $contents, OutputInterface $output)
    {
        $output->write("Creating file <comment>$path</comment> ... ");
        file_put_contents($path, $contents);
        $output->writeln("<info>Done!</info>");
    }
}