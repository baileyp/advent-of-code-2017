'use strict';

module.exports = {
    newTower: () => new Tower(),
    newProgram: (name, weight) => new Program(name, weight),
}

class Tower
{
    constructor() {
        this.programs = new Map();
    }

    /**
     * Find the base program of the tower
     *
     * @returns {Program}
     */
    get base() {
        var base;
        this.programs.forEach((program) => {
            if (!program.supportedBy) {
                base = program;
            }
        });

        return base;
    }

    /**
     * Retrieve a program by its name
     *
     * @param name
     * @returns {Program}
     */
    findProgram(name) {
        return this.programs.get(name);
    }

    /**
     * Add a program to the tower
     *
     * @param program
     */
    addProgram(program) {
        this.programs.set(program.name, program);
    }

    /**
     * Write one or more programs to the disc of another
     *
     * @param programName
     * @param children
     */
    writeProgramsToDisc(programName, children) {
        const program = this.programs.get(programName);
        children.forEach(child => program.addToDisc(this.programs.get(child)));
    }

    /**
     * Find the amount of imbalance in the tower.
     *
     * @returns {Number}
     */
    findImbalance() {
        return this.findImbalanceRecursive(this.base);
    }

    /**
     * Recursively search for the imbalanced program and return the amount of imbalance
     *
     * @param program
     * @returns {Number}
     */
    findImbalanceRecursive(program) {
        const weights = new Map();
        var imbalancedWeight;
        var balancedWeight;

        // Build up a hashtable of weight => programs
        program.disc.forEach(supported => {
            const totalWeight = supported.totalWeight;
            var programsAtWeight = weights.get(totalWeight) || [];
            programsAtWeight.push(supported.name);
            weights.set(totalWeight, programsAtWeight);
        });

        if (weights.size === 1) {
            throw "Program is balanced!";
        }

        // Identify the balanced and imbalanced weights
        weights.forEach((programsAtWeight, weight) => {
            if (programsAtWeight.length == 1) {
                imbalancedWeight = weight;
            } else {
                balancedWeight = weight;
            }
        });

        const imbalancedProgram = this.programs.get(weights.get(imbalancedWeight)[0]);

        // Basically - is the imbalance, here or in a program on the disc?
        try {
            return this.findImbalanceRecursive(imbalancedProgram);
        }
        catch (err) {
            const imbalance = Math.abs(balancedWeight - imbalancedWeight);
            return Math.abs(imbalancedProgram.weight - imbalance);
        }
    }
}

class Program
{
    constructor(name, weight) {
        this._name = name;
        this._weight = weight;
        this._disc = new Map();
        this._supportedBy = null;
    }

    /**
     * Get the program's name
     * @returns {String}
     */
    get name() {
        return this._name;
    }

    /**
     * Get the weight of just this program
     *
     * @returns {Number}
     */
    get weight() {
        return this._weight;
    }

    /**
     * Get the weight of this program plus all the programs it supports
     *
     * @returns {number}
     */
    get totalWeight() {
        var weight = this.weight;
        this.disc.forEach(program => weight += program.totalWeight);
        return weight;
    }

    /**
     * Get the program's disc aka child programs
     *
     * @returns {Map}
     */
    get disc() {
        return this._disc;
    }

    /**
     * Get the supporting program, if it exists
     *
     * @returns {Program}
     */
    get supportedBy() {
        return this._supportedBy;
    }

    /**
     * Support this program with another
     *
     * @param program
     * @returns {Program}
     */
    set supportedBy(program) {
        this._supportedBy = program;

        return this;
    }

    /**
     * Add a new program to this program's disc
     *
     * @param program
     */
    addToDisc(program) {
        this._disc.set(program.name, program);
        program.supportedBy = this;
    }
}