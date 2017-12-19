'use strict';

module.exports = {
    /**
     * Reduce function that sums values
     *
     * @param carry
     * @param value
     * @returns {number}
     */
    sum: (carry, value) => carry + value,

    /**
     * Reduce function that XORs values
     *
     * @param carry
     * @param value
     * @returns {number}
     */
    xor: (carry, value) => carry ^ value,
}