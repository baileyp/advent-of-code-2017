# Day 15

http://adventofcode.com/2017/day/15

## Part 1

I think the only concept really being tested here is to make sure you know bit manipulation, specifically the application
of bitmasks. Given the large number of iterations required, I imagine, this forces your hand on this to get a solution
that computes in a reasonable amount of time. I suspect that non-bitmask implementations take quite a bit more time.
<sup>1</sup>
I suppose this also makes sure you have some kind of concept of encapsulation - with the independent generators and all.

Not much to about time/space complexity since the algorithm is not bound by the input. Everything is O(1).

## Part 2

Fairly trivial modification that I think further tests your understanding of encapsulation.

## Solutions

 - [PHP](../../php/src/Solution/Day15Solution.php)
 
## End Notes

<sup>1</sup> Confirmed. I did a quick test of using decimal-to-binary conversion and substring operations to compare
the lowest 16 bits. While it still yielded a correct answer, it took 5x longer to compute. Not quite as large of a
difference as I suspected, but non-trivial all the same.