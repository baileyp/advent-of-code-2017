# Day 1

http://adventofcode.com/2017/day/1

## Part 1

Not complicated but that is to be expected for the first puzzle. Key CS concepts seem to just be loops and pointer
manipulation. Should be solvable in O(N) time and O(N) space where `n` is the character length of the input.

## Part 2

Very small variation on Part 1. Key insight is that there is no real distinction between the "next" value or the
"halfway" value as far as the loop is concerned. Only the starting conditions need to vary.

## Solutions

 - [PHP](../../php/src/Solution/Day01Solution.php)
 - [JavaScript](../../javascript/lib/solution/day01.js)
