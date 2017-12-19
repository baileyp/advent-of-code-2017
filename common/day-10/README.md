# Day 10

http://adventofcode.com/2017/day/10

## Part 1

The core challenge here is writing the algorithm that reverses a sublist, specifically to ensure it "wraps" correctly.

I opted to identify the "start" and "end" of the sublist, and progressively walk inwards with each cursor, transposing
characters along the way. As the cursors move inwards, they each know how to wrap around the list in a circular manner.

I tried to think if there is a particular data structure that is ideally suited for the problem than arrays/vectors but
ultimately, that's what I used.

My algorithm ended up having a time-complexity of O(LN) where `L` is the number of lengths in the input and `N` is
number of items in the list. However, since the puzzle asserts that `N` is a fixed-size (only varies for the simplified
description) then it's probably more correct to document as O(1) not O(N), therefore the overall time-complexity is just
O(L). Space-complexity is also O(L).

## Part 2

Wow - so far the biggest change introduced by the second part. It's not significantly more complicated but you do have
to apply quite a bit more work to compute the result.

Clearly the first thing that needs to change is producing the length list. Most languages will have a function that
converts a character to its ASCII code. But even if they didn't, you could write up a mapping in a few minutes.
Time-complexity is O(C) where `C` is the character length of the input (note that this is larger than `L` from part 1).

Second thing is to realize that calculating the sparse hash is just essentially applying part one 64 times - so we've
got that covered, although the time and space complexity are now O(C).

The dense hash is just a little map/reduce exercise. Reduce each 16-item sub-array to an XOR'd result and map those
those resulting values to to their hexadecimal equivalents. Since this operation is not dependent on the input, it takes
O(1) time.

At the end now, for time-complexity, we've got O(C) + O(64C) + O(1) which distills down to just O(C). Space-complexity
is O(C) as well.

## Solutions

 - [PHP](../../php/src/Solution/Day10Solution.php)