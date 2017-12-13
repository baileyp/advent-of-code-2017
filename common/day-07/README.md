# Day 7

http://adventofcode.com/2017/day/7

## Part 1

I figured a graph problem would come along in the first 10 days. 

The trickiest part of this for me was deciding on how to convert the raw input into a tree (the "tower"). Since the
input data is not ordered, I decided to build the tree in two passes:

 1. Build all the nodes (programs) with their **names** and **weights**
 2. Create all the edges/associations (write programs to discs)
 
This comes at a time cost of O(N + P) where `N` is the total number of programs, and `P` is the number of "parent"
programs i.e., those with other programs on their disc. Space required to build the tower is O(N) although I temporarily
needed O(N + P) to build it. 

Finding the base of the tower is O(N) although I suppose it's possible to try to determine the base during construction
but I did not go down that road, so overall time-complexity is O(N + P).

## Part 2

As is typical with many graph problems, this one requires recursion to find the imbalanced program. Worst-case you have
walk the whole tree to find the imbalanced program which makes the time-complexity O(N), but for each of those iterations
the weight needs to be calculated which is also recursive. Program total weight could be memoized, though, which also
makes that an O(N) exercise. Therefore we have

 1. Building the tree: O(N + P)
 2. Calculating all program weights: O(N)
 3. Walking the tree to find imbalances: O(N)
 
Therefore the total time-complexity remains O(N + P) with a constant space-complexity of O(N).

## Solutions

 - [PHP](../../php/src/Solution/Day07Solution.php)