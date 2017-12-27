# Day 21

http://adventofcode.com/2017/day/21

## Part 1

Lots of components to this. By my reckoning, here's a breakdown of what is needed

 - State to store the enhancement rules
 - State to store the current generation of the art
 - Logic to match matrices, which has a couple discrete parts
    - Matrix rotations
    - Matrix flipping
    - Some sort of equality comparison
 - Logic to create a new generation which includes
    - Matrix splitting
    - Matrix merging
 - Logic to count the number of "on" pixels in a matrix

I'm not great at matrix stuff. In the past I've heavily relied on libraries. Rotations and flips were relatively simple,
but had a devil of a time debugging the merge and split operations. Since matching matrices needs to happen alot against
a fixed data set (the enhancement rules), I decided pre-cache all possible rotations and flips up front. This decision
ups the space requirement but allows matrix matching to occur in O(1) time. On that note, time to cover the Big O stuff.

Loading the enhancement rules, including pre-caching all the transformations, takes O(E(M + M<sup>2</sup>)) time
requiring O(E) space, where `E` is the number of enhancement rules and `M` is the size<sup>1</sup> of the matrices in
the input, which varies per enhancement rule but has a reliable median.

Generating a new generation of the art requires splitting the matrix, which is O(G(MS)<sup>2</sup>) where `G` is the 
growth per generation<sup>2</sup> and `S` is the size of the split (which is always 2 or 3, per the puzzle instructions).
The we need to match each split to an output matrix which takes O(1) time, so this step takes O((GM/S)<sup>2</sup>)
time<sup>3</sup>. Merging them back together takes O((M + G)<sup>2</sup>) time and also O((M + G)<sup>2</sup>) space.

Whew! Overall that means this requires O(E(M + M</sup>2</sup>) + G(MS)<sup>2</sup> + (GM/S)<sup>2</sup> + (M + G)<sup>2</sup>) time
and O(E + G(M + 1)<sup>2</sup>) space (I think...)

## Part 2

Not much to say here - its the exact same solution just requires more generations. I had to up PHP's memory limit to get
this to complete (ended up consuming almost 800MB) because by the end of the 18th generation, `M` was 2,187 so the number
of pixels in the drawing was a bit under 4.8 million!

## Solutions

 - [PHP](../../php/src/Solution/Day21Solution.php)
 
## Footnotes

 1. Here I'm using "size" the same way as a described in the puzzle - a matrix with a size of 3 is a 3x3 matrix.
    Therefore, operation that act on the size will be recorded as O(M) whereas operations that occur on all elements in
    a matrix will be recorded as O(M<sup>2</sup>)
 2. I had a hard time describing this. Here `G` describes a sort of generational coefficient - the growth is not linear
    because the generational value of `M` increases in multiples of 2 or 3.
 3. (GM/S)<sup>2</sup> describes the number of matrices after splitting.
    