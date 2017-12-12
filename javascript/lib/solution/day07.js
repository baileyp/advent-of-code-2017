'use strict';

const hashtable = require('../datatype/hashtable.js');

module.exports = {
    part1: function(input) {
        return buildTower(input).base().name();
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
    const tower = new Tower();
    const associations = new hashtable.hashtable;
    const rows = input.split("\n").map(parseLine);

    rows.forEach(function(row){
        const program = row[0];
        const children = row[1];

        tower.addProgram(program);

        if (children.length) {
            associations.put(program.name(), children);
        }
    });

    associations.forEach(function(children, name){
        tower.writeProgramsToDisc(name, children);
    });

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
        new Program(nodeParts[1], parseInt(nodeParts[2], 10)),
        children ? children.split(', ') : []
    ];
}

/**
 * Tower object
 *
 * @constructor
 */
function Tower()
{
    var programs = new hashtable.hashtable;

    /**
     * Retrieve a program by its name
     *
     * @param name
     */
    this.findProgram = function(name) {
        return programs.get(name);
    };

    /**
     * Add a program to the tower
     *
     * @param program
     */
    this.addProgram = function(program) {
        programs.put(program.name(), program);
    };

    /**
     * Write one or more programs to the disc of another
     *
     * @param programName
     * @param children
     */
    this.writeProgramsToDisc = function(programName, children)
    {
        var program = programs.get(programName);
        children.forEach(function(child){
            var childProgram = programs.get(child);
            program.addToDisc(childProgram);
        });
    };

    /**
     * Find the base program of the tower
     *
     * @returns {Program}
     */
    this.base = function()
    {
        var base;
        programs.forEach(function(program, name){
            if (!program.supportedBy()) {
                base = program;
            }
        });

        return base;
    };

    /**
     * Find the amount of imbalance in the tower.
     *
     * @return int
     *
     * @codeCoverageIgnore
     */
    this.findImbalance = function()
    {
        return this.findImbalanceRecursive(this.base());
    };

    /**
     * Recursively search for the imbalanced program and return the amount of imbalance
     *
     * @param Program $program
     * @return int
     *
     * @codeCoverageIgnore
     */
    this.findImbalanceRecursive = function(program)
    {
        const weights = new hashtable.hashtable;
        var imbalancedWeight;
        var balancedWeight;

        // Build up a hashtable of weight => programs
        program.disc().forEach(function(supported) {
            const totalWeight = supported.totalWeight();
            var programsAtWeight = weights.get(totalWeight) || [];
            programsAtWeight.push(supported.name());
            weights.put(totalWeight, programsAtWeight);
        });

        if (weights.size() === 1) {
            throw "Program is balanced!";
        }

        // Identify the balanced and imbalanced weights
        weights.forEach(function(programsAtWeight, weight) {
            if (programsAtWeight.length == 1) {
                imbalancedWeight = weight;
            } else {
                balancedWeight = weight;
            }
        });

        const imbalancedProgram = programs.get(weights.get(imbalancedWeight)[0]);

        // Basically - is the imbalance, here or in a program on the disc?
        try {
            return this.findImbalanceRecursive(imbalancedProgram);
        }
        catch (err) {
            const imbalance = Math.abs(balancedWeight - imbalancedWeight);
            return Math.abs(imbalancedProgram.weight() - imbalance);
        }
    };
}

/**
 * Program object
 *
 * @param name
 * @param weight
 * @constructor
 */
function Program(name, weight)
{
    const disc = new hashtable.hashtable;
    var supportedBy = null;

    this.name = function()
    {
        return name;
    };

    this.weight = function()
    {
        return weight;
    };

    /**
     * Get the weight of this program plus all the programs it supports
     *
     * @returns {number}
     */
    this.totalWeight = function()
    {
        var weight = this.weight();
        disc.forEach(function(program){
            weight += program.totalWeight();
        });
        return weight;
    };

    /**
     * Get the program's disc aka child programs
     *
     * @returns {Hashtable}
     */
    this.disc = function()
    {
        return disc;
    };

    /**
     * Get the supporting program, if it exists
     *
     * @returns {Program}
     */
    this.supportedBy = function()
    {
        return supportedBy;
    };

    /**
     * Add a new program to this program's disc
     *
     * @param program
     */
    this.addToDisc = function(program)
    {
        disc.put(program.name(), program);
        program.setSupportedBy(this);
    };

    /**
     * Support this program with another
     *
     * @param program
     * @returns {Program}
     */
    this.setSupportedBy = function(program)
    {
        supportedBy = program;

        return this;
    };
}