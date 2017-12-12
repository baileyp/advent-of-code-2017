# Part 1

Honestly, this one was dead-simple to implement. Where I struggled was trying to figure out if there were other
solutions other than the only one that occurred to me: load everything into an array, create a pointer/cursor to keep
track of the current instruction, and just manipulate offset values until the cursor is out of bounds.

Anyhow, that's what I implemented and it takes O(n) space where `n` is the number of offsets, and what I think I can only
describe as 0(j) time where `j` is the number of jumps required aka the answer to the puzzle. Curious, no?

# Part 2

Exact same algorithm with just slightly different manipulation of offset values. Although with my test data, the number
of jumps required was quite high - over 27 million - which took almost a couple seconds to calculate on my laptop so it
did get me back to thinking if there are other algorithms here, faster or not.

# Solutions

 - [PHP](../../php/src/Solution/Day05Solution.php)
 - [JavaScript](../../javascript/lib/solution/day05.js)