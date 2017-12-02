# PHP Solutions

## Requirements

 1. PHP 7.1 or higher
 2. [Composer](https://getcomposer.org)
 
## Setup

All you need to do is install the dependencies with composer

```bash
$ composer install

# If not installed globally
$ php composer.phar install
```

## Running

Once the project is installed, just use `advent` command to execute a puzzle's solution.

To run Day 1, Part 1 with the input I received:

```bash
$ bin/advent puzzle:solution 1 1
```

Or you can run it with any input file

```bash
$ bin/advent puzzle:solution 1 1 path/to/input/file.txt
```

For more details and options, you can fetch the help

```bash
$ bin/advent help puzzle:solution
```

## Testing

Unit tests can be run if the dev dependencies were installed

```bash
$ bin/phpunit
```