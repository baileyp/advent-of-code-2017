# Day 16

http://adventofcode.com/2017/day/16

## Part 1

This was pretty easy. Just list key/value manipulation. 

Time-complexity is easy to work out but worth discussing. The **spin**, **exchange**, and **partner** operations are
O(1), O(1), and O(P) (respectively), where `P` is the number of programs<sup>1</sup>. So worst-case the input contains
nothing but **partner** operations so we treat them all as O(P).

For the whole solution that means a time complexity of O(MP) requiring O(M + P) space, where `M` is the number of moves in the input,

## Part 2

Hoboy. I got stuck here. Really stuck. I tried quite a few shortcuts and either they didn't work, or were still too slow
themselves<sup>2</sup>.

This was the first puzzle where I had to [consult Reddit](https://www.reddit.com/r/adventofcode/comments/7k5mrq/spoilers_in_title2017_day_16_part_2_cycles/)
(spoilers in link). I tried to minimize my exposure to solutions and only ingest the concepts. Once I did that, I was
able to write something that worked.

Now to work out the time complexity:

 - Learning the dance moves: O(M)
 - Applying the dance moves: O(MP)
 - Learning a transform: O(P)
 - Applying a transform: O(P)
 - Finding the cycle size: O(CP) where `C` is the cycle size itself
 - Finding the answer: O(RP) where `R` is the remainder of 1e9 mod C
 
So overall we're looking at O(M + P + P(M + C + R)) time where `C` and `R` can vary<sup>3</sup> with input. Space
remains at O(M + P).


## Solutions

 - [PHP](../../php/src/Solution/Day16Solution.php)
 
## Footnotes

 1. In this puzzle `P` is constant, fixed at 16. Treating `P` as a constant, this algorithm needs O(M) time and space.
 2. If a solution runs longer than a minute then I assume it's not "correct" even if it ultimately yields the
    puzzle's answer.
 3. According to what I learned on Reddit due to something called [Landau's function](https://en.wikipedia.org/wiki/Landau%27s_function),
    `C` does have max value for a set of 16 items, which is 140<sup>2</sup> or 19,600. As like above, treating `P` as a
    constant means this would need O(M + C + R) time.