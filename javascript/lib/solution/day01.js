'use strict';

module.exports = {
    part1: function(input) {
        var sum = 0;

        for (var i = 0, next = 1, l = input.length; i < l; i++, next++) {
            if (next === l) {
                next = 0
            }
            if (input.charAt(i) === input.charAt(next)) {
                sum += parseInt(input.charAt(i), 10);
            }
        }

        return sum;
    },

    part2: function(input) {
        var sum = 0;

        for (var i = 0, l = input.length, next = l / 2; i < l; i++, next++) {
            if (next === l) {
                next = 0
            }
            if (input.charAt(i) === input.charAt(next)) {
                sum += parseInt(input.charAt(i), 10);
            }
        }

        return sum;
    }
}