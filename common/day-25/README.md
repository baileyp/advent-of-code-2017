# Day 25

http://adventofcode.com/2017/day/25

## Part 1

I think the real challenge here is parsing the input and converting it into something that executes. The actual logic of
the Turing Machine is dead simple, especially given the practice with similar concepts across the previous 24 days.

For my PHP solution, I opted for regex and lambda's although, admittedly, there are probably a good half-dozen other ways
to do this - I hope to explore a few when I get to this puzzle in other languages.

Loading the states takes O(S) time and space where `S` is the number of states in the input. Running the machine
takes O(N) time and up-to O(N) space<sup>1</sup>, where `N` is the number of steps to execute. Calculating the checksum
also takes up-to O(N) time, so overall this solution requires O(S + N) time and space.

## Part 2

Have you tried turning off and back on again?

## Solutions

 - [PHP](../../php/src/Solution/Day25Solution.php)
 
## Footnotes

 1. Although it's not likely that someone's puzzle creates this scenario, it's possible that the cursor could always
    move in one direction so the tape would end up being `N` elements long.