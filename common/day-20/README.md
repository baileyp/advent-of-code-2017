# Day 20

http://adventofcode.com/2017/day/20

## Part 1

This was a really enjoyable puzzle for me. After I read it a couple times just to make sure I understood the test data
and desired output, it took me a bit to realize what was needed or more critically, what is not: We don't actually need
to simulate particle movement.

The key insight here is that the puzzle says "in the long term." Rationing what we should know about speed and
acceleration is that, regardless of starting speed and position, given enough time the fastest particles will never
remain the closest to `<0,0,0>`. High acceleration and high velocity particles can be removed until one or more particles
remain, at which point we just need to choose the closest.

Generating and storing the particles takes O(P) time and space, where `P` is the number of particles in the input.
Filtering out unwanted particles is also O(P) time.

## Part 2

This was even more fun that the first. Overall seems to be a math-oriented puzzle and I wouldn't be surprised to learn
that there is a math trick that helps solve part 2 in a more performant manner that I managed. Still, what I figured out
runs in less than 10 seconds so I'm happy with that and it was a good challenge. Here's the breakdown of my algorithm:

 1. For every pair of particles, determine if they will ever collide<sup>1</sup>.
 2. If they will, determine at what point in time. This requires actual particle simulation to move the pairs enough
    times to detect if they're diverging<sup>2</sup>. Time required for this step is O(TP<sup>2</sup>) and space is
    O(C) where `T` is the number of ticks required to determine when the particles collide or diverge (varies per
    particle pair) and `C` is the number of collisions<sup>3</sup>.
 3. Chronologically remove particles that appear in the collision map, making sure to ignore collisions that become
    obsolete from particle removal. Time required is O(X log(X) + XC) where `X` is the number of ticks where
    collisions occur<sup>4</sup>.
    
Overall this takes O(TP<sup>2</sup> + X log(X) + XC) time, requiring O(P + C) space.

## Solutions

 - [PHP](../../php/src/Solution/Day20Solution.php)
 
## Footnotes

 1. After solving this, I did a little research and it seems you can make this determination in O(1) time because
    there's a formula for determining if two vectors intersect. However, I don't think that's sufficient because we also
    need to know *when* they intersect. Why that is needed is explained above, but I could be wrong.
 2. I had to google the formula for getting the distance between two 3D points. And for the purposes of my algorithm,
    Euclidean distance was just fine. Plus, I actually got a bad answer when I tried Manhattan distance - might come
    back to this in the future to see what's up.
 3. The actual time cost of iterating all unique pairs is O(P(P - 1) / 2) which is really close to O(0.5P<sup>2</sup>)
    but since you drop constants in Big O - even decimal ones - this is recorded as O(P<sup>2</sup>)
 4. The `X log(X)` complexity comes from having to sort the collision map so collisions can be destroyed chronologically.
    PHP's ksort() is actually an O(N<sup>2</sup>) sort (bubble) but I documented a best-case sorting algorithm here since
    the difference is academic - if I *really needed* a logarithmic key sort, I could implement one.