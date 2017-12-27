'use strict';

module.exports = {
    part1: function (input) {
        const graph = buildGraph(input.split("\n"));

        return bfsCount(graph, '0');
    },

    part2: function(input) {
        const graph = buildGraph(input.split("\n"));
        const visitedNodes = new Map();
        let groupCount = 0;

        for (let root of graph.keys()) {
            if (!visitedNodes.has(root)) {
                for (let unique of bfsFlatten(graph, root)) {
                    visitedNodes.set(unique, true);
                }
                groupCount++;
            }
        }

        return groupCount;
    }
};

function buildGraph(lines)
{
    const graph = new Map();

    lines.forEach(line => {
        let [program, connected] = line.split(' <-> ');

        graph.set(program, connected.split(', '));
    });

    return graph;
}

function bfsCount(graph, root) {
    const queue = [];
    const visited = new Map();
    let count = 1;

    queue.push(root);
    visited.set(root, true);
    while (queue.length > 0) {
        let node = queue.shift();
        graph.get(node).forEach(neighbor => {
            if (!visited.has(neighbor)) {
                count++;
                visited.set(neighbor, true);
                queue.push(neighbor);
            }
        });
    }

    return count;
}

function bfsFlatten(graph, root) {
    const queue = [];
    const visited = new Map();

    queue.push(root);
    visited.set(root, true);

    while(queue.length) {
        let node = queue.shift();
        graph.get(node).forEach(neighbor => {
            if (!visited.has(neighbor)) {
                visited.set(neighbor, true);
                queue.push(neighbor);
            }
        });
    }

    return visited.keys();
}
