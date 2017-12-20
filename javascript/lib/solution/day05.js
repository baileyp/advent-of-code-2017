'use strict';

const map = require('../collection/map');

module.exports = {
    part1: function(input) {
        const offsets = parseInput(input);

        var cursor = 0;
        var jumps = 0;

        while (cursor >= 0 && cursor < offsets.length) {
            cursor += offsets[cursor]++;
            jumps++
        }

        return jumps.toString();
    },
    part2: function(input) {
        const offsets = parseInput(input);

        var cursor = 0;
        var jumps = 0;

        while (cursor >= 0 && cursor < offsets.length) {
            if (offsets[cursor] >= 3) {
                cursor += offsets[cursor]--;
            } else {
                cursor += offsets[cursor]++;
            }
            jumps++;
        }

        return jumps.toString();
    }
}

/**
 * Convert multi-line string input of digits into an array of numbers
 *
 * @param input
 * @returns {Array}
 */
function parseInput(input)
{
    return input.split("\n").map(map.int);
}