<?php
class HtmlTagResolverTest extends PHPUnit_Framework_TestCase {
	public $obj = NULL;
	public $expectedData = array(
		'title' => 'Tuts+ Premium Course: What’s Coming to JavaScript  ',
		'description' => 'JavaScript is the most popular programming language in the world, but that doesn’t mean it’s perfect. In fact, it’s far from ideal, ...',
		'image' => '//tutsplus-media.s3.amazonaws.com/tutsplus.com/uploads/2014/02/11_DevFront31-100x100.png'
	);

	public function setUp() {
		$this->obj = new HtmlTagResolver\TagResolver('https://tutsplus.com/course/whats-coming-to-javascript/');
	}

	public function testResolve() {
		$expected = $this->expectedData;
		$this->assertEquals(
			$expected,
			$this->obj->resolve(
				array(
					'title' => true,
					'description' => true,
					'image' => true
				)
			)
		);
	}

	public function tearDown() {
		unset($this->obj);
	}
}