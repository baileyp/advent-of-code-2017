'use strict';

const reduce = require('../collection/reduce');

module.exports = {
    part1: function(input) {
        return input.split("\n")
            .map(passphrase => containsNoDuplicates(passphrase) ? 1 : 0)
            .reduce(reduce.sum);
    },

    part2: function(input) {
        return input.split("\n")
            .map(passphrase => containsNoAnagrams(passphrase) ? 1 : 0)
            .reduce(reduce.sum);
    },
}

/**
 * Verify that no two words in the passphrase are duplicates
 *
 * @param passphrase
 * @returns {boolean}
 */
function containsNoDuplicates(passphrase)
{
    const words = passphrase.split(' ');
    var dictionary = new Set();

    for (var i = 0; i < words.length; i++) {
        if (dictionary.has(words[i])) {
            return false;
        }
        dictionary.add(words[i]);
    }

    return true;
}

/**
 * Verify that no two words in the passphrase are anagrams of eachother
 *
 * @param passphrase
 * @returns {boolean}
 */
function containsNoAnagrams(passphrase)
{
    const words = passphrase
        .split(' ')
        .map(canonicalize);

    var dictionary = new Set();

    for (var i = 0; i < words.length; i++) {
        if (dictionary.has(words[i])) {
            return false;
        }
        dictionary.add(words[i]);
    }

    return true;
}

/**
 * Convert a string into a canonical format where the characters are lexicographically sorted
 *
 * @param input
 * @returns {string}
 */
function canonicalize(input)
{
    return input.split('').sort().join('');
}