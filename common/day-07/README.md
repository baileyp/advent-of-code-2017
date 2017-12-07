# Part 1

I figured a graph problem would come along in the first 10 days. 

The trickiest part of this for me was deciding on how to convert the raw input into a tree (the "tower"). Since the
input data is not ordered, I decided to build the tree in two passes:

 1. Build all the nodes (programs) with their **names** and **weights**
 2. Create all the edges/associations (write programs to discs)
 
This comes at a time cost of O(n + p) where `n` is the total number of programs, and `p` is the number of "parent"
programs i.e., those with other programs on their disc. Space required to build the tower is O(n) although I temporarily
needed O(n + p) to build it. 

Finding the base of the tower is O(n) although I suppose it's possible to try to determine the base during construction
but I did not go down that road, so overall time-complexity is O(n + p).

# Part 2

As is typical with many graph problems, this one requires recursion to find the imbalanced program. Worst-case you have
walk the whole tree to find the imbalanced program which makes the time-complexity O(n), but for each of those iterations
the weight needs to be calculated which is also recursive. Program total weight could be memoized, though, which also
makes that an O(n) exercise. Therefore we have

 1. Building the tree: O(n + p)
 2. Calculating all program weights: O(n)
 3. Walking the tree to find imbalances: O(n)
 
Therefore the total time-complexity remains O(n + p) with a constant space-complexity of O(n).

# Solutions

 - [PHP](../../php/src/Solution/Day07Solution.php)