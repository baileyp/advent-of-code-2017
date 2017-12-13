# Day 6

http://adventofcode.com/2017/day/6

## Part 1

Another puzzle that needs loops and pointer manipulation, along with a hashtable for storing a unique value to check
against later. 

Space is required for storing the current state of the bank O(N) as well as hashes of seen configurations O(C * N)
where `N` is the number of banks and `C` is the number of unique redistribution cycles. I suppose for large enough 
inputs you could cut down on the space by using an actual hashing function so then I think that means space would go
down to O(c + n) - but then of course you'd incur the time cost of something like a SHA algorithm.

Time complexity should break down like this

 - Calculating hash: O(N)
 - Finding largest bank: O(N)
 - Redistributing: O(N)
 - Finding all distributions: O(C)
 
Which means overall the time complexity is O(C * N)

## Part 2

Identical to part one except the addition of tracking the loop size, which can be done with values in the hashtable we
already needed to track unique cycles. No changes to time or space complexity.

## Solutions

- [PHP](../../php/src/Solution/Day06Solution.php)