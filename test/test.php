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

        describe('with mock expectations', function($test) {
            before(function($test) {
                $test->mock = $test->getMock('simple_mock', array('test_method'));
                $test->mock->expects($test->once())
                    ->method('test_method')
                    ->will($test->returnValue('hello world!'));
            });

            it ('should return the expected value', function($test) {
                $test->assertEquals($test->mock->test_method(), 'hello world!');
            });

            it ('should fail when it is not called', function($test) {
                $test->markTestIncomplete(
                    'Some graceful manner needs to be found to indicate that this is expected to fail'
                );
            });
        });

        describe('with expected exceptions', function($test) {
            it ('should not error out', function($test) {
                $test->setExpectedException('Exception');
                throw new \Exception();
            });
        });

        describe('disabled specs', function($test) {
            it ('should not fatal, whitout test body');

            xit ('should not error out whit xit', function($test){
               throw new \Exception();
            });

            describe('entry describe without body');

            xdescribe('entry describe with x', function($test){
                it('should not error out whit xit', function($test){
                   throw new \Exception();
                });

                describe('inner describe', function($test){
                    it('should be also disabled', function($test){
                        throw new \Exception();
                    });
                });
            });

            it('should not stack on disabled state', function($test){
                $test->assertTrue(true);
            });
        });
    }
}
