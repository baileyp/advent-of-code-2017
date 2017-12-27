# Day 24

http://adventofcode.com/2017/day/24

## Part 1

I ended up implementing this twice. The first time around I build a graph of all the bridges and then used DFS to find
bridge sums. Here's how the sample input would look as a graph:

```
                  *
           ┌──────┴─────┐
          0/1          0/2
       ┌───┘      ┌─────┴────┐
      1/10       2/2        2/3
   ┌───┘      ┌───┘      ┌───┴───┐
  9/10       2/3        3/4     3/5
          ┌───┴───┐  
         3/4     3/5
```

There's a node for every possible bridge but the leaf nodes will always represent "full" bridges so DFS was perfect for
calculating sums.

It worked but building the full graph took quite a bit of RAM (about 300MB), and upon reflection, should have. The space
needed to store all valid bridges in a graph is best-case O(Z + R) and worst-case O(ZR!) where `Z` is the number of
ports with a zero, and `R` is all the remaining ports<sup>1</sup>.

I figured I could do better and then I remembered doing [a puzzle for 2015](http://adventofcode.com/2015/day/15) where
the solution space was very large - too large to compute all at once - and I solved that
[with a generator](https://github.com/baileyp/advent-of-code-2015/blob/master/day15/header.php).

Back to this puzzle - loading the ports takes O(P) time and space, where `P` is all of the ports in the input. It wasn't
a lot of work to convert the graph-building code to permutation-yielding code. The same worst-case scenario described
above still applies here for time - O(ZR!) - but in reality it's much less. Probably best described as O(ZR(R - X)) where
`X` represents ports in `R` that cannot connect<sup>2</sup>. However, because of the generator, the space requirement
drops dramatically, down to O(L) where `L` represents the number of ports in the longest bridge, which worst-case is the 
same as O(P).

In the end, this takes O(P + ZR(R - X)) time requiring O(P) space.

## Part 2

Trivial modification where the size of the bridge matters in addition to its strength. I suppose this could have caught
you out if your part 1 solution did too much to hide the bridge lengths, but that wasn't the case for me.

## Solutions

 - [PHP](../../php/src/Solution/Day24Solution.php)
 
## Footnotes

 1. Worst-case is astronomically high, but real-world space requirements would be much, much less. The only way you'd
    truly consume that much space is if all the `Z` and `R` ports were identical (i.e., all `Z` ports could connect to
    `R` ports and all `R` ports could connect to all other `R` ports).
 2. If you know of a better way to document this, [let me know](https://twitter.com/phpbagpiper).