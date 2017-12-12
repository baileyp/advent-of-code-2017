'use strict';

const hashtable = require('../datatype/hashtable.js');

module.exports = {
    part1: function(input) {
        var banks = parseInput(input);
        var configsSeen = new hashtable.hashtable;
        var config = hash(banks);

        while (!configsSeen.containsKey(config)) {
            configsSeen.put(config, true);
            banks = redistribute(findLargestBank(banks), banks);
            config = hash(banks);
        }
        return configsSeen.size().toString();
    },

    part2: function(input) {
        var banks = parseInput(input);
        var configsSeen = new hashtable.hashtable;
        var loopSize = 0;
        var config = hash(banks);

        while (!configsSeen.containsKey(config)) {
            configsSeen.put(config, loopSize++);
            banks = redistribute(findLargestBank(banks), banks);
            config = hash(banks);
        }

        return (loopSize - configsSeen.get(config)).toString();
    }
}

/**
 * Evenly redistribute the blocks in a given bank across all banks
 *
 * @param bank
 * @param banks
 * @returns {*}
 */
function redistribute(bank, banks)
{
    const blocks = banks[bank];
    const bankSize = banks.length;
    const evenDistribution = Math.floor(blocks / bankSize);
    const receiveRemainder = blocks % bankSize;

    banks[bank++] = 0;

    for (var i = 0, cursor = bank; i < bankSize; i++, cursor++) {
        if (cursor >= bankSize) {
            cursor = 0;
        }

        banks[cursor] += evenDistribution;
        if (i < receiveRemainder) {
            banks[cursor]++;
        }
    }

    return banks;
}

/**
 * Find the index the bank with the most blocks
 *
 * @param banks
 * @returns {number}
 */
function findLargestBank(banks)
{
    var index = 0;
    var blocks = 0;

    banks.forEach(function(val, key){
        if (val > blocks) {
            index = key;
            blocks = val;
        }
    });

    return index;
}

/**
 * Convert an array of banks to a representative hash
 *
 * @param banks
 * @returns {string}
 */
function hash(banks)
{
    return banks.join(',');
}

/**
 * Convert multi-line string input of digits into an array of numbers
 *
 * @param input
 * @returns {Array}
 */
function parseInput(input) {
    return input.split("\t")
        .map(function(line) {
            return parseInt(line, 10);
        });
}