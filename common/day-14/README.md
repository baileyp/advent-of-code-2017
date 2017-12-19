# Day 14

http://adventofcode.com/2017/day/14

## Part 1

Fun! First time where we have to leverage a previous solution. This wasn't a terribly hard problem but I think at the
bare minimum it forces your hand in making sure your Day 10 Part 2 solution is re-usable, if it wasn't already. That
also means we're importing the O(C) time and space complexity from that solution.

The time complexity is O(SC) where `S` is the square root of the grid size or one side of the grid<sup>1</sup>. 

## Part 2

I've seen this problem before. If I hadn't I might have struggled but I know this as the "connected cells" problem. In
the context under which I last encountered it, the task was to get the size of the largest contiguous region, not to
count all regions. That said, the basic approach is identical: use [DFS](https://en.wikipedia.org/wiki/Depth-first_search)
to visit adjacent squares/cells/nodes/whatever and count accordingly.

DFS has a standard time complexity of O(V + E) where `V` is the number of vertices and `E` is the number of edges. A
full DFS traversal occurs on every found region so the time complexity for that operation is O(R(V + E)).

Overall we end up with O(SC + R(V + E)) time complexity needing O(C + S<sup>2</sup>) space.

## Solutions

 - [PHP](../../php/src/Solution/Day14Solution.php)
 
## Footnotes

 1. The solution space is constant - a 128 x 128 grid - no matter how big or small the input is. Therefore, all
    algorithms that operate on the solution space take O(1) time in the context of the full solution. So while `S` is
    used here to represent a variable grid size, it is actually fixed at 128. Treating `S` as a constant means this time
    complexity would be O(C).
