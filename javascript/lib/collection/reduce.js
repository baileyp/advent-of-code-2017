'use strict';

module.exports = {
    /**
     * Reduce function that sums values
     *
     * @param carry
     * @param value
     * @returns {number}
     */
    sum: function(carry, value) {
        return carry + value;
    },

    /**
     * Reduce function that XORs values
     *
     * @param carry
     * @param value
     * @returns {number}
     */
    xor: function(carry, value) {
        return carry ^ value;
    },
}