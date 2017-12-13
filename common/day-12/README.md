# Part 1

This is another graph problem. In fact, the input is just a string-representation of an adjacency list so that was the most
straight-forward implementation. Then it was just a matter of using [BFS](https://en.wikipedia.org/wiki/Breadth-first_search)
to count the nodes in the graph starting at `0`.

BFS has a standard time-complexity of O(V + E) and space-complexity of O(V) where `V` is the number of vertices and `E`
is the number of edges. Put another way, in the context of this puzzle, the time-complexity is O(Pr + Pi) and
space-complexity is O(Pr) where `Pr` is the number of programs, and `Pi` is the number of pipes.

# Part 2

Took me a beat to figure this part out. I knew that I could again use BFS to flatten a group of programs connected by
pipes, and that flattened form would represent a unique group. 

In my first go, I converted the group to a hash by sorting it and converting it to a string. This was expensive though - 
O(R * (Pr + Pi) * n log n) where `R` is the number of root nodes in the input, `Pr` and `Pi` are as above, and `n` is
number of non-unique nodes defined in the entire input. And that's assuming I used an `n log n` sort. Space required is
also O(Pr + Pi).

But after a little thought, I reasoned that I needed to flatten a graph starting at given node *only if* that node had
not already been encountered previously. The new solution now requires O(R + (Pr + Pi)) time and O(Pr + Pi) space.


# Solutions

 - [PHP](../../php/src/Solution/Day12Solution.php)