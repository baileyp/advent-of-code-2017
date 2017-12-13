# Day 11

http://adventofcode.com/2017/day/11

## Part 1

I have never before worked with a hex grid and have no shame in admitting that when it came to working with them, I
[looked it up](https://www.redblobgames.com/grids/hexagons/).

Once I understood the math, an implementation was simple. I decided on using **offset coordinates** for my solution since
it was the most straight-forward and didn't require conversion to/from another coordinate system.

Since each step needs to be applied and calculating the distance is O(1), overall time-complexity is O(N) where `N` is
the number of steps in the input. Space-complexity is also O(N).

## Part 2

Trivial modification - just need to calculate the distance after every step to track the furthest it goes.

## Solutions

 - [PHP](../../php/src/Solution/Day11Solution.php)