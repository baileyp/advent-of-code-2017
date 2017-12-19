# JavaScript Solutions

## Requirements

 1. Node 0.10 or higher
 2. NPM 5 or higher
 
## Setup

All you need to do is install the dependencies with npm

```bash
$ npm install
```

## Running

Once the project is installed, just use `node` to execute a puzzle's solution.

To run Day 1, Part 1 with the input I received:

```bash
$ node solutions.js 1 1
```

Or you can run it with any input file

```bash
$ node solutions.js 1 1 path/to/input/file.txt
```

Or you can run it with input directly as an argument

```bash
$ node solutions.js 1 1 1122
```

## Testing

Unit tests can be run if the dev dependencies were installed

```bash
$ npm test
```

> **Note:** All the  `test/solution/day*_test.js` tests are not proper unit tests but are integration tests of the entire
> solution using the sample input data provided by the puzzle descriptions, when available.