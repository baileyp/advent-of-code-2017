# Day 23

http://adventofcode.com/2017/day/23

## Part 1

Not much to say here - this is basically identical to [Day 18](../day-18/README.md) which the puzzle itself even sets up.

## Part 2

I had to look this up on Reddit. For one, I didn't realize these instructions were [assembly](https://en.wikipedia.org/wiki/Assembly_language).
For two, even if I had, I have zero practice in translating assembly and honestly, after working on this problem, I don't
find the process to be terribly fun or rewarding.

I loaded all the instructions so I could at least dynamically pull the key instruction values, although many solutions I
saw on Reddit just hard-coded these values.

Once the min, max, and increment values for register b have been loaded, the algorithm is O(B√B) where `B` is the
range of register b values from the input.

## Solutions

 - [PHP](../../php/src/Solution/Day23Solution.php)