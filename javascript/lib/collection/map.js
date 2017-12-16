'use strict';

module.exports = {
    /**
     * Convert string value to integer numbers
     *
     * @param value
     * @returns {Number}
     */
    int: function(value) {
        return parseInt(value, 10);
    },

    /**
     * Convert base 10 to hex string
     *
     * @param int
     * @returns {string}
     */
    hex: function(int) {
        return int.toString(16);
    },

    /**
     * Convert chars to ordinal values
     *
     * @param chr
     * @returns {Number}
     */
    ord: function(chr) {
        return chr.charCodeAt(0);
    },

    /**
     * Apply String.prototype.padStart() to every element of an array.
     *
     * Mmm, curry
     *
     * @param chr
     * @param amount
     * @returns {Function}
     */
    padStart: function(chr, amount) {
        return function(str) {
            return str.padStart(amount, chr);
        }
    }
};