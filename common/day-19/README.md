# Day 19

http://adventofcode.com/2017/day/19

## Part 1

Really cool puzzle. Not hard in concept but was difficult to debug for me<sup>1</sup>.

I'll be honest, I'm not sure if I did this optimally but I reasoned that this was the stuff I needed:

 - State to load the entire diagram into a grid/matrix
 - State to keep track of the current position along the path in the diagram. A point/coordinate/cursor/whatever.
 - State to keep track of the current direction of travel (NSEW, UDLR, etc)
 - State to collect letters
 - Logic to find the starting point
 - Logic to move within the boundaries of the diagram
 - Logic to move *over* intersections
 - Logic to decide what routes are available at corners `+` (basically, logic for making turns)
 - Logic to detect when a letter should be collected
 
These were not hard to implement but represent a decent number of components. Now lets look at the time/space complexity.

 - Loading the diagram into a grid requires O(WH) time and space, where `W` and `H` are the width and height of the
   diagram.
 - Finding the trailhead of the path takes O(W) time
 - Traversing the path takes O(P) time<sup>2</sup> requiring O(C) space where `P` is the number of path characters in the
   diagram (anything that is not a blank space) and `C` is the number of collectible characters along the path.
   
So overall time complexity is O(WH + W + P) and space complexity is O(WH + C).

## Part 2

Trivial modification - just need an additional piece of state to count the number of steps taken. No change to time/space
complexity<sup>3</sup>.

## Solutions

 - [PHP](../../php/src/Solution/Day19Solution.php)
 
## Footnotes

 1. I may or may not have realized that my editor trimmed all the trailing whitespace from my [input file](input.txt) -_-
 2. It did occur to me that any characters at intersections would be traversed twice but since you drop constants in Big
    O notation, I didn't bother to record them since at worst it would be something less than 2P total.
 3. Technically, you could reduce the space needed by removing `C` since part 2 doesn't care about the collected letters.
    I didn't actually implement that reduction though as it's academic at this point.