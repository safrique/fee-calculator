Interview Test - Fee Calculation
=====

## Background

This test is designed to evaluate your problem solving approach and your engineering ability. Design your solution in a way that shows your knowledge of OOP concepts, SOLID principles, design patterns, clean and extensible architecture.

Provide a test suite verifying your solution, use any testing framework you feel comfortable with. Use any libraries (or none) you feel add value to your solution. Treat the packaged project as a template; if you feel that your solution can be improved with modifications to it then please go ahead.

## The test

The requirement is to build a fee calculator that - given a monetary **amount** and a **term** (the contractual duration of the loan, expressed as a number of months) - will produce an appropriate fee for a loan, based on a fee structure and a set of rules described below. A general contract for this functionality is defined in the interface `FeeCalculator`.

Implement your solution such that it fulfils the requirements.

- The fee structure does not follow a formula.
- Values in between the breakpoints should be interpolated linearly between the lower bound and upper bound that they fall between.
- The number of breakpoints, their values, or storage might change.
- The term can be either 12 or 24 (number of months), you can also assume values will always be within this set.
- The fee should be rounded up such that fee + loan amount is an exact multiple of 5.
- The minimum amount for a loan is £1,000, and the maximum is £20,000.
- You can assume values will always be within this range but they may be any value up to 2 decimal places.

Example inputs/outputs:

|Loan amount  |Term       |Fee     |
|-------------|-----------|--------|
|£11,500      |24 months  |£460    |
|£19,250      |12 months  |£385    |

# Installation
A database or any other external dependency is not required for this test.

```bash
composer install
```

# Example
```php
<?php

use Lendable\Interview\Interpolation\Model\LoanApplication;

$calculator = new FeeCalculator();

$application = new LoanApplication(24, 2750);
$fee = $calculator->calculate($application);
// $fee = (float) 115.0
```

# Fee Structure
The fee structure doesn't follow particular algorithm and it is possible that same fee will be applicable for different amounts.

### Term 12
```
£1000: £50
£2000: £90
£3000: £90
£4000: £115
£5000: £100
£6000: £120
£7000: £140
£8000: £160
£9000: £180
£10000: £200
£11000: £220
£12000: £240
£13000: £260
£14000: £280
£15000: £300
£16000: £320
£17000: £340
£18000: £360
£19000: £380
£20000: £400
```

### Term 24

```
£1000: £70
£2000: £100
£3000: £120
£4000: £160
£5000: £200
£6000: £240
£7000: £280
£8000: £320
£9000: £360
£10000: £400
£11000: £440
£12000: £480
£13000: £520
£14000: £560
£15000: £600
£16000: £640
£17000: £680
£18000: £720
£19000: £760
£20000: £800
```

# Submitting your solution

Please do not make a public repository for your solution. Instead, please submit your solution either as a git bundle (from a local or private repository) or compress your solution into a zip archive.

# SOLUTION

### _Josef van Niekerk_

The solution can be used in 2 ways, via the web browser & via the command line console.

## Installation

### Prerequisites

The user needs `composer` installed and needs a web server running.

1. Create a folder called `fee-calculator` in the user's local repository directory.
2. To start the installation, run the following command: `composer install`

## Browser

To see the solution working in a browser window, navigate to http://localhost/fee-calculator. By default, the 
minimum term (12 months) & minimum loan amount (£1,000) will be selected. The user can change these values within 
the parameters indicated within the instructions above. Once the user clicks the Submit button, the page will 
display the loan schedule for the selected values.

## Command Line

In the command line window, navigate to the folder where the project has been installed. Run the `cd Commands` 
command to get to the directory to run the commands from. To run the calculation, run the command: `php calculateFee.
php`. The solution will ask the user to enter a valid term & loan amount. If the user doesn't enter valid values, it 
will keep asking until valid values have been provided.

The solution also has the option to send in the term & amount with the command, e.g. `php calculateFee.php --term=12 
--amount=1000`. For the solution to work correctly, both the term & amount have to be added, or else the solution 
will ask the user to provide both.

## Cache

A rudimentary caching system has been built to help speed the processing up. The caching happens in 2 separate 
places and caching is kept for 5 hours.

1. Web Page Cache: The HTML for all pages displayed in the browser are cached as pure HTML files.
2. Calculations: Calculations are also cached, so they don't have to be recalculated again if the same calculation is 
   requested within the caching time.

## Testing

To run the tests, navigate to the project root directory and run the command: `./vendor/bin/phpunit --testdox tests
` for descriptive set of automated tests.
