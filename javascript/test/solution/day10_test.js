const assert = require('assert');

const solution = require('../../lib/solution/day10.js');
const input1 = '3,4,1,5';
const input2 = [
    ['', 'a2582a3a0e66e6e86e3812dcb672a272'],
    ['AoC 2017', '33efeb34ea91902bb2f59c9920caa6cd'],
    ['1,2,3', '3efbe78a8d82f29979031a4aa0b16a9d'],
    ['1,2,4', '63960835bcdc130f0b66d7ff4f6a5a8e'],
];

describe('Day 10 Module', function() {
    describe('#part1()', function() {
        it('should return correct answers for all example data', function() {
            assert.equal(solution.part1(input1, 5), '12');
        });
    });

    describe('#part2()', function() {
        it('should return correct answers for all example data', function() {
            input2.forEach(function(data) {
                assert.equal(solution.part2(data[0]), data[1]);
            });
        });
    });
});
