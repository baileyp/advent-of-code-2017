# Day 16

http://adventofcode.com/2017/day/16

## Part 1

This was pretty easy. Just list key/value manipulation. 

Time-complexity is easy to work out but worth discussing. The **spin**, **exchange**, and **partner** operations all work on data
of a fixed size (16, the letters a through p) so for the solution as a whole, they're all O(1). However, as implemented,
I have them as O(1), O(1), and O(P) (respectively), where `P` is the number of programs.

However, that still means overall the solution requires O(M) time and space where `M` is the number of moves in
the input.

## Part 2

Hoboy. I got stuck here. Really stuck. I tried quite a few shortcuts and either they didn't work, or were still too slow
themselves<sup>1</sup>.

This was the first puzzle where I had to [consult Reddit](https://www.reddit.com/r/adventofcode/comments/7k5mrq/spoilers_in_title2017_day_16_part_2_cycles/)
(spoilers in link). I tried to minimize my exposure to solutions and only ingest the concepts. Once I did that, I was
able to write something that worked.

Now to work out the time complexity:

 - Applying the dance moves: O(M)
 - Learning a transform: O(M)
 - Applying a transform: O(1)
 - Finding the cycle size: O(C) where `C` is the cycle size itself
 - Finding the answer: O(R) where `R` is the remainder of 1e6 mod C
 
So overall we're looking at O(M + C + R) where `C` and `R` can vary<sup>2</sup> with input.

## Solutions

 - [PHP](../../php/src/Solution/Day16Solution.php)
 
## Footnotes

 1. If a solution runs longer than a minute then I assume it's not "correct" even if it ultimately yeilds the
puzzle's answer.
 2. According to what I learned on Reddit due to something called [Landau's function](https://en.wikipedia.org/wiki/Landau%27s_function),
`C` does have max value for a set of 16 items, which is 140<sup>2</sup> or 19,600;