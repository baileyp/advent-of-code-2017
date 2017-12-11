<?php

namespace App\Solution;

use App\Solution\Day09\SimpleStateMachine;

class Day09Solution extends AbstractSolution
{
    public function part1(): string
    {
        $input = $this->inputReader->readLine();

        $operations = [
            '!' => function(SimpleStateMachine $state, &$loop) {
                $loop++;
            },
            '{' => function(SimpleStateMachine $state) {
                if (!$state['inGarbage']) {
                    $state->enterGroup();
                }
            },
            '}' => function(SimpleStateMachine $state) {
                if (!$state['inGarbage']) {
                    $state->addGroupDepthToScore();
                    $state->exitGroup();
                }
            },
            '<' => function(SimpleStateMachine $state) {
                if (!$state['inGarbage']) {
                    $state['inGarbage'] = true;
                }
            },
            '>' => function(SimpleStateMachine $state) {
                if ($state['inGarbage']) {
                    $state['inGarbage'] = false;
                }
            },
        ];

        $machine = new class(
            ['score' => 0, 'groupDepth' => 0, 'inGarbage' => false],
            $operations,
            function() { /* nothing */ }
        ) extends SimpleStateMachine {
            public function enterGroup(): void
            {
                $this['groupDepth'] = $this['groupDepth'] + 1;
            }

            public function exitGroup(): void
            {
                $this['groupDepth'] = $this['groupDepth'] - 1;
            }

            public function addGroupDepthToScore(): void
            {
                $this['score'] += $this['groupDepth'];
            }
        };

        $machine->run($input);

        return (string) $machine['score'];
    }
    
    public function part2(): string
    {
        $input = $this->inputReader->readLine();

        $operations = [
            '!' => function(SimpleStateMachine $state, &$loop) {
                $loop++;
            },
            '{' => function(SimpleStateMachine $state) {
                if (!$state['inGarbage']) {
                    $state->enterGroup();
                } else {
                    $state->incrementGarbage();
                }
            },
            '}' => function(SimpleStateMachine $state) {
                if (!$state['inGarbage']) {
                    $state->exitGroup();
                } else {
                    $state->incrementGarbage();
                }
            },
            '<' => function(SimpleStateMachine $state) {
                if (!$state['inGarbage']) {
                    $state['inGarbage'] = true;
                } else {
                    $state->incrementGarbage();
                }
            },
            '>' => function(SimpleStateMachine $state) {
                if ($state['inGarbage']) {
                    $state['inGarbage'] = false;
                } else {
                    $state->incrementGarbage();
                }
            },
        ];

        $machine = new class(
            ['garbageCount' => 0, 'groupDepth' => 0, 'inGarbage' => false],
            $operations,
            function(SimpleStateMachine $state) {
                if ($state['inGarbage']) {
                    $state->incrementGarbage();
                }
            }
        ) extends SimpleStateMachine {
            public function enterGroup(): void
            {
                $this['groupDepth'] = $this['groupDepth'] + 1;
            }

            public function exitGroup(): void
            {
                $this['groupDepth'] = $this['groupDepth'] - 1;
            }

            public function incrementGarbage(): void
            {
                $this['garbageCount'] = $this['garbageCount'] + 1;
            }
        };

        $machine->run($input);

        return (string) $machine['garbageCount'];
    }
}