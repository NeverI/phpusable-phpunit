# PHPUsable
## Motivation
The goal of this project is to provide a more usuable syntax ontop of PHPUnit, while still being compatible with PHPUnit.

Much of the inspiration for the DSL and syntax is drawn from the ruby testing framework [RSpec](http://rspec.info/).

## Installation

PHPUsable can be installed using [Composer](http://getcomposer.org/).

At first, save below as `composer.json` at the root of your project.

```json
{
    "require": {
        "mover-io/phpusable-phpunit": "dev-master"
    }
}
```

And run these commands.

```
$ wget http://getcomposer.org/composer.phar
$ php composer.phar install
```

Then PHPUsable will be installed in `./vendor` directory and also `./vendor/autoload.php` is generated.

## Usage Example

``` php
<?php
namespace PHPUsable;
require 'vendor/autoload.php';


class PHPTest extends PHPUsableTest {
    public function tests() {
        PHPUsableTest::$current_test = $this;

        describe('with esperance style assertions', function($test) {
            describe('with a true value', function($test) {
                before(function($test) {
                    //Arbitratry variables can be stored on test to pass between blocks
                    $test->my_value = true;
                });

                it ('should be true', function($test) {
                    $test->expect($test->my_value)->to->be->ok();
                });
            });

            describe('with a false value', function($test) {
                before(function($test) {
                    $test->my_value = false;
                });

                it ('should be false', function($test) {
                    $test->expect($test->my_value)->to->be(false);
                });
            });
        });

        describe('with phpunit style assertions', function($test) {
            describe('with a true value', function($test) {
                before(function($test) {
                    $test->my_value = true;
                });

                it ('should be true', function($test) {
                    $test->assertTrue($test->my_value);
                });
            });

            describe('with a false value', function($test) {
                before(function($test) {
                    $test->my_value = false;
                });

                it ('should be false', function($test) {
                    $test->assertFalse($test->my_value);
                });
            });
        });
    }
}
```

## Team
This library was created by the [Mover](http://mover.io) team for use in testing our PHP code base when we got tired of the PHPUnit syntax.

## Expectations
PHPUsable uses [Esperance](https://github.com/esperance/esperance) to offer an expectation based syntax for assertions.

## License
MIT License (or buy me a beer)
