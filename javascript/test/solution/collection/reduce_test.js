const assert = require('assert');

const reduce = require('../../../lib/collection/reduce');

describe('Collection/Reduce Module', function() {
    describe('#sum()', function() {
        it('Should sum correctly', function() {
            assert.strictEqual(reduce.sum(5, 11), 16);
            assert.strictEqual(reduce.sum(0, 11), 11);
            assert.strictEqual(reduce.sum(-5, 11), 6);
        });

        it('Should reduce an array correctly', function() {
            assert.strictEqual([1, 2, 3, 4, 5].reduce(reduce.sum), 15);
            assert.strictEqual([0, -5, 0, 10, 0].reduce(reduce.sum), 5);
        })
    });

    describe('#xor()', function() {
        it('Should XOR correctly', function() {
            assert.strictEqual(reduce.xor(0b1111, 0b1010), 0b0101);
        });

        it('Should reduce an array correctly', function() {
            assert.strictEqual([0b1111, 0b1010, 0b0001].reduce(reduce.xor), 0b0100);
        })
    });
});