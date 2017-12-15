'use strict';

const hashtable = require('../datatype/hashtable.js');
const jumps = {
    'dec': function(value, amount) {
        return value - amount;
    },
    'inc': function(value, amount) {
        return value + amount;
    }
};
const conditions = {
    '>': function(left, right) {
        return left > right;
    },
    '<': function(left, right) {
        return left < right;
    },
    '>=': function(left, right) {
        return left >= right;
    },
    '<=': function(left, right) {
        return left <= right;
    },
    '==': function(left, right) {
        return left == right;
    },
    '!=': function(left, right) {
        return left != right;
    },
};

module.exports = {
    part1: function(input) {
        const registers = new hashtable.hashtable;

        input.split("\n")
            .map(parseLine)
            .forEach(function(i9n) {
                if (i9n.condition(readRegister(registers, i9n.ifRegister), i9n.value)) {
                    const modifiedValue = i9n.jump(readRegister(registers, i9n.register), i9n.amount);
                    registers.put(i9n.register, modifiedValue);
                }
            });

        return Math.max.apply(null, registers.toArray());
    },

    part2: function(input) {
        const registers = new hashtable.hashtable;
        var max = 0;

        input.split("\n")
            .map(parseLine)
            .forEach(function(i9n) {
                if (i9n.condition(readRegister(registers, i9n.ifRegister), i9n.value)) {
                    const modifiedValue = i9n.jump(readRegister(registers, i9n.register), i9n.amount);
                    registers.put(i9n.register, modifiedValue);
                }

                max = Math.max(max, Math.max.apply(null, registers.toArray()));
            });

        return max;
    }
}

/**
 * Read the value of register |key|. If it does not exist, create it and initialize to 0
 *
 * @param registers
 * @param key
 */
function readRegister(registers, key) {
    const registerValue = registers.get(key);
    if (registerValue === null) {
        registers.put(key, 0);
    }
    return registers.get(key);
}

/**
 * Parse an input line into an instruction object
 *
 * @param line
 * @returns {{register: *, jump: *, amount: Number, ifRegister: *, condition: *, value: Number}}
 */
function parseLine(line)
{
    const parts = line.split(' ');
    return {
        register: parts[0],
        jump: jumps[parts[1]],
        amount: parseInt(parts[2], 10),
        ifRegister: parts[4],
        condition: conditions[parts[5]],
        value: parseInt(parts[6], 10)
    };
}