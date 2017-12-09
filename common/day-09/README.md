# Part 1

Simple State Machine! These are usually pretty easy to implement but somehow, always fun too.

This problem requires two states to be tracked

 1. An integer to represent current group depth. A depth of 0 would indicate we're not in a group
 2. A boolean to indicate whether or not we're in a piece of garbage
 
Obviously we also need an integer to track the score, but that's not technically a part of the state machine.
 
Time and space complexity are both O(n) where `n` is the number of input characters.

# Part 2

No change to the state machine - only the "scoring" needed to change.

# Solutions

 - [PHP](../../php/src/Solution/Day09Solution.php)