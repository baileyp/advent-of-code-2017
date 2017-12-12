# Part 1

The only trick here seems to be finding the min/max values. Most languages will have library functions that do this
trivially, but I will implement them manually as a part of the exercise.

Should be solvable in O(n) time and space where `n` is the total number of cells in the spreadsheet.

# Part 2

I'm actually not sure if this can be done in better than O(n^2) time.

You can produce a slightly more optimized solution by sorting the row values first, but then you also incur the cost of
sorting which is, generally speaking, not going to get better than O(n log n).

For my solutions, I will forgo sorting.

# Solutions

 - [PHP](../../php/src/Solution/Day02Solution.php)
 - [JavaScript](../../javascript/lib/solution/day02.js)
