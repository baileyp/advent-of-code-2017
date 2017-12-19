# Day 17

http://adventofcode.com/2017/day/17

## Part 1

Bless my stars, a linked list problem!

The reason this is a linked list problem is because of the requirement for data insertion at an arbitrary index, which
for linked lists is O(1). Reading indexes from an linked list is also O(1).

The solution has a time complexity of O(S) needing O(S) space where `S` is the number of steps<sup>1</sup>.

## Part 2

This one really tested the ol' brain pan. I almost consulted Reddit again but I hate doing that so I sat and thought
some more. The key insight is that the value `0` is always at the 0<sup>th</sup> position in the list. That's because
insertion requests at the 0<sup>th</sup> index don't occur - items are always inserted at the end, increasing the size
of the list - they never loop around to insert a value at the very beginning.

With this knowledge in hand, all that was needed was to keep track of values inserted a the 1<sup>st</sup> position. This
still requires doing all 50 million iterations, but doesn't require actually building a list of 50 million integers.

The solution to part 2 does not generate a list, so while it still requires O(S) time, space requirements drop to O(1).

## Solutions

 - [PHP](../../php/src/Solution/Day17Solution.php)
 
## Footnotes

 1. As with the previous two days, the solution space `S` is fixed - in this case the range of 0 to 2,017. Advancing the
    current position is what requires the puzzle input, and that is solvable in O(1) time. So if we treat `S` as a
    constant, this solution requires O(1) time and O(1) space.