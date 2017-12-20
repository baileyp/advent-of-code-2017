'use strict';

module.exports = {
    part1: function(input) {
        var score = 0;
        var groupDepth = 0;
        var inGarbage = false;

        for (var i = 0; i < input.length; i++) {
            switch (input.charAt(i)) {
                case '!':
                    i++;
                    break;
                case '{':
                    if (!inGarbage) {
                        groupDepth++;
                    }
                    break;
                case '}':
                    if (!inGarbage) {
                        score += groupDepth;
                        groupDepth--;
                    }
                    break;
                case '<':
                    if (!inGarbage) {
                        inGarbage = true;
                    }
                    break;
                case '>':
                    if (inGarbage) {
                        inGarbage = false;
                    }
                    break;
                default:
                    // Nothing
            }
        }

        return score;
    },

    part2: function(input) {
        var garbageCount = 0;
        var groupDepth = 0;
        var inGarbage = false;

        for (var i = 0; i < input.length; i++) {
            switch (input.charAt(i)) {
                case '!':
                    i++;
                    break;
                case '{':
                    if (!inGarbage) {
                        groupDepth++;
                    } else {
                        garbageCount++;
                    }
                    break;
                case '}':
                    if (!inGarbage) {
                        groupDepth--;
                    } else {
                        garbageCount++;
                    }
                    break;
                case '<':
                    if (!inGarbage) {
                        inGarbage = true;
                    } else {
                        garbageCount++;
                    }
                    break;
                case '>':
                    if (inGarbage) {
                        inGarbage = false;
                    } else {
                        garbageCount++;
                    }
                    break;
                default:
                    if (inGarbage) {
                        garbageCount++;
                    }
            }
        }

        return garbageCount;
    },
}