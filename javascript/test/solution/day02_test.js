const assert = require('assert');

const solution = require('../../lib/solution/day02.js');
const input1 = ["5\t1\t9\t5", "7\t5\t3", "2\t4\t6\t8"].join("\n");
const input2 = ["5\t9\t2\t8", "9\t4\t7\t3", "3\t8\t6\t5"].join("\n");

describe('Day 02 Module', function() {
    describe('#part1()', function() {
        it('should return correct answers for all example data', function() {
            assert.equal(solution.part1(input1), '18');
        });
    });

    describe('#part2()', function() {
        it('should return correct answers for all example data', function() {
            assert.equal(solution.part2(input2), '9');
        });
    });
});
