const assert = require('assert');

const solution = require('../../lib/solution/day04.js');
const input1 = ["aa bb cc dd ee", "aa bb cc dd aa", "aa bb cc dd aaa"].join("\n");
const input2 = [
    "abcde fghij",
    "abcde xyz ecdab",
    "a ab abc abd abf abj",
    "iiii oiii ooii oooi oooo",
    "oiii ioii iioi iiio"
].join("\n");

describe('Day 04 Module', function() {
    describe('#part1()', function() {
        it('should return correct answers for all example data', function() {
            assert.equal(solution.part1(input1), '2');
        });
    });

    describe('#part2()', function() {
        it('should return correct answers for all example data', function() {
            assert.equal(solution.part2(input2), '3');
        });
    });
});
