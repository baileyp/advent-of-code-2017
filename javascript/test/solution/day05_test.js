const assert = require('assert');

const solution = require('../../lib/solution/day05.js');
const input = "0\n3\n0\n1\n-3";

describe('Day 05 Module', function() {
    describe('#part1()', function() {
        it('should return correct answers for all example data', function() {
            assert.equal(solution.part1(input), '5');
        });
    });

    describe('#part2()', function() {
        it('should return correct answers for all example data', function() {
            assert.equal(solution.part2(input), '10');
        });
    });
});
