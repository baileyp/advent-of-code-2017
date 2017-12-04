# Part 1

Very straightforward. I think the only key CS concept here is the use of a hashtable to store unique words which can be
used to trigger a failure if a duplicate is encountered. I suppose if a given language did not have good library
functions for splitting the passphrases into words, this would be a bit more challenging.

Worst-case runtime is O(w) where `w` is all of the words across all passphrases in the list, and space is O(c) where `c`
is the character-length of the longest passphrase in the list.

# Part 2

Only a slight variation on part 1 but requires additional time complexity since checking for anagrams has non-constant-time
cost.

Space complexity is the same but time complexity will vary based on the sorting algorithm used, but typical
best-case would be (O n log n) where `n` is the number of characters in the entire passphrase list.

# Solutions

- [PHP](../../php/src/Solution/Day04Solution.php)