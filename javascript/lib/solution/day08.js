'use strict';

const jumps = {
    'dec': (value, amount) => value - amount,
    'inc': (value, amount) => value + amount,
};
const conditions = {
    '>': (left, right) => left > right,
    '<': (left, right) => left < right,
    '>=': (left, right) => left >= right,
    '<=': (left, right) => left <= right,
    '==': (left, right) => left == right,
    '!=': (left, right) => left != right,
};

module.exports = {
    part1: function(input) {
        const registers = new Map();

        input.split("\n")
            .map(parseLine)
            .forEach(i9n => {
                if (i9n.condition(readRegister(registers, i9n.ifRegister), i9n.value)) {
                    registers.set(
                        i9n.register,
                        i9n.jump(readRegister(registers, i9n.register), i9n.amount)
                    );
                }
            });

        return Math.max(...registers.values());
    },

    part2: function(input) {
        const registers = new Map();
        var max = 0;

        input.split("\n")
            .map(parseLine)
            .forEach(function(i9n) {
                if (i9n.condition(readRegister(registers, i9n.ifRegister), i9n.value)) {
                    registers.set(
                        i9n.register,
                        i9n.jump(readRegister(registers, i9n.register), i9n.amount)
                    );
                }

                max = Math.max(max, Math.max(...registers.values()));
            });

        return max;
    }
}

/**
 * Read the value of register |key|. If it does not exist, create it and initialize to 0
 *
 * @param key
 * @returns {*}
 */
function readRegister(registers, key) {
    if (!registers.has(key)) {
        registers.set(key, 0);
    }
    return registers.get(key);
}

/**
 * Parse an input line into an instruction object
 *
 * @param line
 * @returns {{register: String, jump: function, amount: Number, ifRegister: string, condition: function, value: Number}}
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