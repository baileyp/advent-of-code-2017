'use strict';

module.exports = {
    /**
     * Convert string value to integer numbers
     *
     * @param value
     * @returns {Number}
     */
    int: value => parseInt(value, 10),

    /**
     * Convert base 10 to hex string
     *
     * @param int
     * @returns {string}
     */
    hex: int => int.toString(16),

    /**
     * Convert chars to ordinal values
     *
     * @param chr
     * @returns {Number}
     */
    ord: chr => chr.charCodeAt(0),

    /**
     * Apply String.prototype.padStart() to every element of an array.
     *
     * Mmm, curry
     *
     * @param chr
     * @param amount
     * @returns {Function}
     */
    padStart: (chr, amount) => str => str.padStart(amount, chr)
};