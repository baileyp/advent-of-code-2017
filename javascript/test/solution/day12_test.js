'use strict';

const assert = require('assert');

const solution = require('../../lib/solution/day12.js');
const input = `0 <-> 2
1 <-> 1
2 <-> 0, 3, 4
3 <-> 2, 4
4 <-> 2, 3, 6
5 <-> 6
6 <-> 4, 5`;

describe('Day 12 Module', function() {
    describe('#part1()', function() {
        it('should return correct answers for all example data', function() {
            assert.equal(solution.part1(input), '6');
        });
    });

    describe('#part2()', function() {
        it('should return correct answers for all example data', function() {
            assert.equal(solution.part2(input), '2');
        });
    });
});
