const assert = require('assert');

const solution = require('../../lib/solution/day01.js');
const input1 = [
    ['1122', '3'],
    ['1111', '4'],
    ['1234', '0'],
    ['91212129', '9'],
];
const input2 = [
    ['1212', '6'],
    ['1221', '0'],
    ['123425', '4'],
    ['123123', '12'],
    ['12131415', '4'],
];

describe('Day 01 Module', function() {
    describe('#part1()', function() {
        it('should return correct answers for all example data', function() {
            input1.forEach(function(data) {
                assert.equal(solution.part1(data[0]), data[1]);
            });
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
