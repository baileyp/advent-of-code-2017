# Part 1

Key insight here was that the location of each square in the grid did not need to be stored, only the position of the
n*th* square or, put another way, the (x,y) coordinate of the n*th* square if `1` is placed at (0,0).

Therefore, this can be done in O(n) time, where `n` is the integer range of `1` to the input, and in O(1) space.

As with Day 1, key concept still seems to be loops with the addition of a basic understanding of grids and a little math
to get the spiral logic correct.

On the topic of math, it struck me that there might be a math trick that makes this "simpler" but if such a trick
exists, it is unknown to me.

# Part 2

The core algorithm ("building" the spiral grid) remains the same, but requires the addition of a hastable to store the
grid values. The new solution still requires O(n) time but now also requires O(n) space.

# Solutions

 - [PHP](../../php/src/Solution/Day03Solution.php)
