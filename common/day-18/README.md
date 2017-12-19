# Day 18

http://adventofcode.com/2017/day/18

## Part 1

This was simple but partly because it was [familiar](http://adventofcode.com/2015/day/23) - more list key/value
manipulation with the added complexity of triggering an exit from the loop. For my first implementation (PHP) I used an
exception for this, but it could be done other ways.

Loading the instructions takes O(I) time and space, where `I` is the number of instructions in the input. Each of the
individual instructions have an O(1) time cost so following the instructions takes O(N) time where `N` is the number of
instructions before the exit/halt condition is reached. 

Overall, then, time complexity is O(I + N) requiring O(I) space.

## Part 2

Fun! I imagine this is really targeted at languages where threads are available, but since I'm doing my solutions in PHP
first, that was not an option fo me<sup>1</sup>, although I do really look forward to doing this one in a thread-supported
language.

I had a few missteps on the way to a good solution but I'm pleased that I was able to extend my part 1 solution to do
this with minimally more code. For me one of the key insights was in the puzzle description - stating how it really
didn't matter how fast or in what order the two programs executed their instructions - that really helped me understand
the true run/wait conditions.

No change to time/space complexity.

## Solutions

 - [PHP](../../php/src/Solution/Day18Solution.php)
 
## Footnotes

 1. Yes, I know about [pthreads](http://php.net/manual/en/book.pthreads.php), but I'm sticking with language core for
    these solutions so PECL packages and the like are out.