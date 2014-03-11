<?php

class ActiveTest extends PHPUnit_Framework_TestCase
{

    public function testPatternMethod()
    {
	$route = Mockery::mock('\Illuminate\Routing\Route');
	$route->shouldReceive('getUri')->once()->andReturn('foo/bar/baz');
	$active = new \HieuLe\Active\Active($route);
	$this->assertEquals('active', $active->pattern('foo/*'));
	$this->assertEquals('', $active->pattern('foo/'));
	$this->assertEquals('selected', $active->pattern('foo/*', 'selected'));
	$this->assertEquals('selected', $active->pattern(array('foo/*', '*bar/*'), 'selected'));
    }
    
    public function testRouteMethod()
    {
	$route = Mockery::mock('\Illuminate\Routing\Route');
	$route->shouldReceive('getName')->once()->andReturn('foo');
	$active = new \HieuLe\Active\Active($route);
	$this->assertEquals('active', $active->route('foo'));
	$this->assertEquals('selected', $active->route('foo', 'selected'));
	$this->assertEquals('active', $active->route(array('fooz', 'foo')));
	$this->assertEquals('', $active->route(array()));
	$this->assertEquals('', $active->route('bar'));
    }

}