'use strict';

const assert = require('assert');

const solution = require('../../lib/solution/day11.js');
const input1 = [
    ['ne,ne,ne', '3'],
    ['ne,ne,sw,sw', '0'],
    ['ne,ne,s,s', '2'],
    ['se,sw,se,sw,sw', '3'],
]
const input2 = [
    ['ne,ne,ne', '3'],
    ['ne,ne,sw,sw', '2'],
    ['ne,ne,s,s,s,n', '3'],
];

describe('Day 11 Module', function() {
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
