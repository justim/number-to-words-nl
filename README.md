# Number to words in Dutch [![Build Status](https://api.travis-ci.org/justim/number-to-words-nl.svg?branch=master)](https://travis-ci.org/justim/number-to-words-nl) [![Coverage Status](https://img.shields.io/coveralls/justim/number-to-words-nl.svg)](https://coveralls.io/r/justim/number-to-words-nl?branch=master)

> Convert numbers to words in Dutch

## Requirements

* `PHP >= 5.4`

## Installation

* For NumberToWordsNl to work you only need the `src/NumberToWordsNl.php` file, download it and hack away
* Also available at [Packagist](https://packagist.org/packages/justim/number-to-words-nl) (Composer)

## Usage

```php
$number = '12';
$words = NumberToWordsNl::toWords($number);
echo $words; // twaalf
```
