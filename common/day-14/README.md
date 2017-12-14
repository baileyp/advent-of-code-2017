# Day 14

http://adventofcode.com/2017/day/14

## Part 1

Fun! First time where we have to leverage a previous solution. This wasn't a terribly hard problem but I think at the
bare minimum it forces your hand in making sure your Day 10 Part 2 solution is re-usable, if it wasn't already. That
also means we're importing the O(C) time and space complexity from that solution.

Then it's just a simple conversion and counting exercise, both of which are O(1) since they are not bound to the input
size<sup>1</sup>. That said, the underlying algorithms that do the conversion and counting are linear time.

## Part 2

I've seen this problem before. If I hadn't I might have struggled but I know this as the "connected cells" problem. In
the context under which I last encountered it, the task was to get the size of the largest contiguous region, not to
count all regions. That said, the basic approach is identical: use [DFS](https://en.wikipedia.org/wiki/Depth-first_search)
to visit adjacent squares/cells/nodes/whatever and count accordingly.

Time complexity for DFS is O(V + E) although, again, the size of the solution space that DFS is applied to is constant,
so this is an O(1) operation for the solution overall.

That means that despite all the extra work, we *still* end up using only O(C) time and O(C) space.

## Solutions

 - [PHP](../../php/src/Solution/Day14Solution.php)
 
## End Notes
 
<sup>1</sup> The solution space is constant - a 128 x 128 grid - no matter how big or small the input is. Therefore, all
algorithms that operate on the solution space take O(1) time in the context of the full solution.
