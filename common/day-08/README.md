# Day 8

http://adventofcode.com/2017/day/8

## Part 1

I'm trying to understand if there's a fundamental CS principle on display here or not. Seems like just more hashtable
management.

I think the only thing to "solve" here is how to effectively convert the input into executable code - 
specifically the jumps and conditions. I opted to use lambda functions in a hashtable where the keys are the raw
instructions themselves.

Otherwise, the puzzle instructions themselves are a plain-language description of the algorithm needed so it's dead-simple
to implement.

Requires O(N) space, where `N` is the number of registers, and O(I) time where `I` is the number of instructions.

## Part 2

Trivial modification - just need one extra variable to track the max value along the way vs calculating the max from the
end state of the registers. No change in time/space complexity.

## Solutions

 - [PHP](../../php/src/Solution/Day08Solution.php)