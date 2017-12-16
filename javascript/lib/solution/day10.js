'use strict';

const map = require('../collection/map.js');
const reduce = require('../collection/reduce.js');
const LIST_SIZE = 256;

var currentPosition = 0;
var skipSize = 0;

module.exports = {
    part1: function (input) {
        const lengths = input.split(',').map(map.int);
        var list = range(0, LIST_SIZE - 1);

        list = applyLengthReversals(list, lengths);
        
        return list[0] * list[1];
    },
    
    part2: function(input) {
        const lengths = input.split('').map(map.ord).concat([17, 31, 73, 47, 23]);
        var list = range(0, LIST_SIZE - 1);

        for (var i = 0; i < 64; i++) {
            list = applyLengthReversals(list, lengths);
        }

        return hashDense(list)
            .map(map.hex)
            .map(map.padStart('0', 2))
            .join('');
    }
}

/**
 * Range builder for integers
 *
 * @param from
 * @param to
 * @returns {boolean}
 */
function range(from, to)
{
    return Array.from(Array(to - from + 1), (x,i) => i + from);
}

/**
 * Generate a dense hash from a sparse hash
 *
 * @param sparseHash
 * @returns {Array}
 */
function hashDense(sparseHash)
{
    var chunks = [];
    while (sparseHash.length) {
        chunks.push(sparseHash.splice(0, 16));
    }

    return chunks.map(function(chunk) {
        return chunk.reduce(reduce.xor);
    });
}

/**
 * For each length provided in |lengths|, reverse a sublist of |list| based on that length and global positioning data
 *
 * @param list
 * @param lengths
 * @returns {*}
 */
function applyLengthReversals(list, lengths)
{
    lengths.forEach(function(length) {
        list = reverseSublist(list, currentPosition, length);

        currentPosition += length + skipSize;
        if (currentPosition > LIST_SIZE) {
            currentPosition = currentPosition % LIST_SIZE;
        }

        skipSize++;
    });

    return list;
}

/**
 * Inside |list|, identify a sublist bounded by |start| and |length| and reverse the items in that sublist. If either
 * bound of the sublist extends beyond the list's size, treat the list as circular and "wrap-around" to the other
 * side.
 *
 * @param list
 * @param start
 * @param length
 * @returns {array}
 */
function reverseSublist(list, start, length)
{
    var end = start + length - 1;
    if (start >= LIST_SIZE) {
        start = start % LIST_SIZE;
    }
    if (end >= LIST_SIZE) {
        end = end % LIST_SIZE;
    }
    for (var i = 0; i < length; i += 2) {
        const temp = list[start];
        list[start] = list[end];
        list[end] = temp;

        start++;
        end--;

        if (end < 0) {
            end = LIST_SIZE - 1;
        }

        if (start >= LIST_SIZE) {
            start = 0;
        }
    }
    return list;
}