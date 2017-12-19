const assert = require('assert');

const solution = require('../../lib/solution/day08.js');
const input = "b inc 5 if a > 1\n" +
    "a inc 1 if b < 5\n" +
    "c dec -10 if a >= 1\n" +
    "c inc -20 if c == 10";

describe('Day 08 Module', function() {
    describe('#part1()', function() {
        it('should return correct answers for all example data', function() {
            assert.equal(solution.part1(input), '1');
        });
    });

    describe('#part2()', function() {
        it('should return correct answers for all example data', function() {
            assert.equal(solution.part2(input), '10');
        });
    });
});
