'use strict';

const reduce = require('../collection/reduce.js');

module.exports = {
    part1: function(input) {
        return input.split("\n")
            .map(rowToNumbers)
            .map(calculateRowDiff)
            .reduce(reduce.sum);
    },

    part2: function(input) {
        return input.split("\n")
            .map(rowToNumbers)
            .map(findDifference)
            .reduce(reduce.sum);
    },
}

/**
 * Convert a tab-delimited string of data into an array of numbers
 *
 * @param row
 * @returns {Array}
 */
function rowToNumbers(row) {
    return row.split("\t").map(function(cell){
        return parseInt(cell, 10);
    });
}

/**
 * Find the min/max integers in the cells and return their difference
 *
 * @param cells
 * @returns {number}
 */
function calculateRowDiff(cells) {
    var min = Number.MAX_VALUE;
    var max = Number.MIN_VALUE;

    for (var i = 0; i < cells.length; i++) {
        if (cells[i] < min) {
            min = cells[i];
        }
        if (cells[i] > max) {
            max = cells[i];
        }
    }

    return max - min;
}

/**
 * Find two integers in the cells that evenly divide and return their quotient
 *
 * @param cells
 * @returns {number}
 */
function findDifference(cells)
{
    for (var i = 0; i < cells.length; i++) {
        for (var j = 0; j < cells.length; j++) {
            var quotient = cells[i] / cells[j];
            if (i !== j && Number.isInteger(quotient)) {
                return quotient;
            }
        }
    }
    return 0;
}