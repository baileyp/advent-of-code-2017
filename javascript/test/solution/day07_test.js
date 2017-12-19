const assert = require('assert');

const solution = require('../../lib/solution/day07.js');
const input = "pbga (66)\n" +
    "xhth (57)\n" +
    "ebii (61)\n" +
    "havc (66)\n" +
    "ktlj (57)\n" +
    "fwft (72) -> ktlj, cntj, xhth\n" +
    "qoyq (66)\n" +
    "padx (45) -> pbga, havc, qoyq\n" +
    "tknk (41) -> ugml, padx, fwft\n" +
    "jptl (61)\n" +
    "ugml (68) -> gyxo, ebii, jptl\n" +
    "gyxo (61)\n" +
    "cntj (57)";

describe('Day 07 Module', function() {
    describe('#part1()', function() {
        it('should return correct answers for all example data', function() {
            assert.equal(solution.part1(input), 'tknk');
        });
    });

    describe('#part2()', function() {
        it('should return correct answers for all example data', function() {
            assert.equal(solution.part2(input), '60');
        });
    });
});
