'use strict';

const model = require('./day07/model');

module.exports = {
    part1: function(input) {
        return buildTower(input).base.name;
    },

    part2: function(input) {
        return buildTower(input).findImbalance();
    }
}

/**
 * Build a tower object from raw input data
 *
 * @param input
 * @returns {Tower}
 */
function buildTower(input)
{
    const tower = model.newTower();
    const associations = new Map();
    const rows = input.split("\n").map(parseLine);

    rows.forEach(row => {
        const [program, children] = row;

        tower.addProgram(program);

        if (children.length) {
            associations.set(program.name, children);
        }
    });

    associations.forEach((children, name) => tower.writeProgramsToDisc(name, children));

    return tower;
}

/**
 * Parse an input line into name, weight, and children values;
 * @param line
 * @returns {[Program,array]}
 */
function parseLine(line)
{
    const definition = line.split(' -> ')
    const nodeParts = definition[0].match(/([a-z]+) \((\d+)\)/);
    const children = definition[1] || '';

    return [
        model.newProgram(nodeParts[1], parseInt(nodeParts[2], 10)),
        children ? children.split(', ') : []
    ];
}