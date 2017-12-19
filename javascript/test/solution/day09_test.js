const assert = require('assert');

const solution = require('../../lib/solution/day09.js');
const input1 = [
    ['{}', '1'],
    ['{{{}}}', '6'],
    ['{{},{}}', '5'],
    ['{{{},{},{{}}}}', '16'],
    ['{<a>,<a>,<a>,<a>}', '1'],
    ['{{<ab>},{<ab>},{<ab>},{<ab>}}', '9'],
    ['{{<!!>},{<!!>},{<!!>},{<!!>}}', '9'],
    ['{{<a!>},{<a!>},{<a!>},{<ab>}}', '3'],
];
const input2 = [
    ['<>', '0'],
    ['<random characters>', '17'],
    ['<<<<>', '3'],
    ['<{!>}>', '2'],
    ['<!!>', '0'],
    ['<!!!>>', '0'],
    ['<{o"i!a,<{i<a>', '10'],
];

describe('Day 09 Module', function() {
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
