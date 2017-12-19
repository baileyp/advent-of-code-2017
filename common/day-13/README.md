# Day 13

http://adventofcode.com/2017/day/13

## Part 1

I thought about this one for a while before writing any code. It paid off becuase I think your first instinct (well, at
least mine was) is to write some objects to simulate a firewall, layers, and packets. While no-doubt that would get you
to a correct answer, its not actually necessary and would be quite time-costly to boot.

No, turns out you just need a bit of [maths](https://en.wiktionary.org/wiki/maths). Building the firewall requires O(L)
time and O(L) space, where `L` is the number of layers in the input. As-is common with algorithms that rely on math,
calculating if a packet is caught at a layer after a certain amount of time, is not in any way bound by the input which
means constant-time or O(1). So the time-complexity for calculating the severity of a packet's journey across the
firewall is O(L) and needs O(1) space.

Therefore, overall time-complexity is O(L) and space-complexity is also O(L).

## Part 2

Nearly identical to part1 except introducing the concept of a delay which is just another variable in the math problem.

However, when it came to finding a delay that allowed a packet to cross the firewall uncaught, I couldn't figure out how
to do this (if there's a way at all) without simulating *all* packet journeys with delays of `0` through to  `D` where 
`D` represents the smallest amount of delay required for a packet to cross the firewall uncaught. I think this means the
time-complexity should be recorded as O(DL). Space-complexity does not change.

## Solutions

 - [PHP](../../php/src/Solution/Day13Solution.php)