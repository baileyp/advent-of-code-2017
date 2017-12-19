const assert = require('assert');

const solution = require('../../lib/solution/day06.js');
const input = "0\t2\t7\t0";

describe('Day 06 Module', function() {
    describe('#part1()', function() {
        it('should return correct answers for all example data', function() {
            assert.equal(solution.part1(input), '5');
        });
    });

    describe('#part2()', function() {
        it('should return correct answers for all example data', function() {
            assert.equal(solution.part2(input), '4');
        });
    });
});
