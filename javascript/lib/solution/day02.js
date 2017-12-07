'use strict';

module.exports = {
    part1: function(input) {

        return input.split("\n")
            .map(rowToNumbers)
            .map(calculateRowDiff)
            .reduce(sum);
    },

    part2: function(input) {
        return input.split("\n")
            .map(rowToNumbers)
            .map(findDifference)
            .reduce(sum);
    },
}

function sum(carry, value) {
    return carry + value;
}

function rowToNumbers(row) {
    return row.split("\t").map(function(cell){
        return parseInt(cell, 10);
    });
}

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