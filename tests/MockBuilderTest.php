<?php

namespace malkusch\phpmock;

use malkusch\phpmock\functions\FixedValueFunction;

/**
 * Tests MockBuilder.
 *
 * @author Markus Malkusch <markus@malkusch.de>
 * @link bitcoin:1335STSwu9hST4vcMRppEPgENMHD2r1REK Donations
 * @license http://www.wtfpl.net/txt/copying/ WTFPL
 * @see MockBuilder
 */
class MockBuilderTest extends \PHPUnit_Framework_TestCase
{
    
    /**
     * Tests build().
     *
     * @test
     */
    public function testBuild()
    {
        $builder = new MockBuilder();
        $builder->setNamespace(__NAMESPACE__)
                ->setName("time")
                ->setFunction(
                    function () {
                        return 1234;
                    }
                );
        
        $mock = $builder->build();
        $mock->enable();
        $this->assertEquals(1234, time());
        $mock->disable();
        
        
        $builder->setFunctionProvider(new FixedValueFunction(123));
        $mock = $builder->build();
        $mock->enable();
        $this->assertEquals(123, time());
        $mock->disable();
    }
}
