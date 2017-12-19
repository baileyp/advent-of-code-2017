const assert = require('assert');

const map = require('../../../lib/collection/map');

describe('Collection/Map Module', function() {
    describe('#int()', function () {
        it ('Should convert Strings to Numbers', function(){
            assert.strictEqual(map.int('5'), 5);
        });

        it ('Should always return integers', function(){
            assert.strictEqual(map.int('5.7'), 5);
        });

        it ('Should work with negative values', function(){
            assert.strictEqual(map.int('-5'), -5);
        });

        it ('Should always convert with base 10', function(){
            assert.strictEqual(map.int('010'), 10);
        });

        it ('Should return NaN when input is not numeric', function(){
            assert.strictEqual(isNaN(map.int('5')), false);
            assert.strictEqual(isNaN(map.int('a')), true);
        });
    });

    describe('#hex()', function() {
        it('Should convert base 10 digits 0-15', function() {
            ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f'].forEach(function(hex, dec) {
                assert.strictEqual(map.hex(dec), hex);
            });
        });

        it('Should work with large numbers', function() {
            assert.strictEqual(map.hex(1e6), 'f4240');
            assert.strictEqual(map.hex(2 ** 32), '100000000');
        });
    });

    describe('#ord()', function() {
        it('Should convert characters to code points', function() {
            assert.strictEqual(map.ord('A'), 65);
        });

        it('Should convert only the first character', function() {
            assert.strictEqual(map.ord('BA'), 66);
        });
    });

    describe('#padStart()', function() {
        it('Pad strings correctly', function() {
            assert.strictEqual(map.padStart('*', 2)('AB'), 'AB');
            assert.strictEqual(map.padStart('*', 5)('AB'), '***AB');
        });

        it('Should curry properly', function() {
            const fiveSplats = map.padStart('*', 5);
            const tenDollars = map.padStart('$', 10);

            assert.strictEqual(fiveSplats(''), '*****');
            assert.strictEqual(fiveSplats('A'), '****A');
            assert.strictEqual(tenDollars(''), '$$$$$$$$$$');
            assert.strictEqual(tenDollars('A'), '$$$$$$$$$A');
        });
    });
});