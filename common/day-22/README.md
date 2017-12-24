# Day 22

http://adventofcode.com/2017/day/22

## Part 1

This wasn't that hard, I don't think. And in some ways, related to Day 19 as it requires the generation of 2D grid and
moving a cursor within the grid<sup>1</sup>. The significant difference here is that the grid is not a fixed size, and
needs to be dynamically allocated as the virus moves around.

Creating the initial state of the grid requires O(N) time and space where `N` is the number of nodes in the input. A
single burst of the virus occurs in O(1) time so `B` bursts takes O(B) time. Space grows unpredictably (afaik) but can
never be larger than O(N + B).

## Part 2

Part 1 with different decision-making and additional values for grid state. No change to time/space complexity. That
said, since `B` is fixed at 1e7, this takes a while to compute. My PHP solution takes around 22 seconds (compared to
around 0.02 seconds for Part 1).

## Solutions

 - [PHP](../../php/src/Solution/Day22Solution.php)
 
## Footnotes

 1. It was so similar, in fact, that my PHP solution was able to re-use some of the Day 19 code with no modifications.