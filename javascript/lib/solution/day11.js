'use strict';

const ops = {
    n: (x, y) => [x, y - 1],
    s: (x, y) => [x, y + 1],
    ne: (x, y) => [x + 1, y - 0.5],
    nw: (x, y) => [x - 1, y - 0.5],
    se: (x, y) => [x + 1, y + 0.5],
    sw: (x, y) => [x - 1, y + 0.5],
}

module.exports = {
    part1: function (input) {
        const steps = input.split(',');
        let x = 0;
        let y = 0;
        
        steps.forEach(function(step){
            [x, y] = ops[step](x, y);
        });

        return distanceFromCenter(x, y);
    },

    part2: function(input) {
        const steps = input.split(',');
        let x = 0;
        let y = 0;
        let maxDistance = 0;

        steps.forEach(function(step){
            [x, y] = ops[step](x, y);
            maxDistance = Math.max(maxDistance, distanceFromCenter(x, y));
        });

        return maxDistance;
    }
};

function distanceFromCenter(x, y) {
    x = Math.abs(x);
    y = Math.max(0, Math.abs(y) - (x / 2));

    return x + y;
}
