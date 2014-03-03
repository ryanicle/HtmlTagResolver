<?php
/**
 * This is part of the HtmlTagResolver package
 *
 * (c) Min Ye (Ryan) <ryanicle@gmail.com>
 */
namespace HtmlTagResolver;
class BaseResolver {
	public $baseUrl;

	public $imgExtensions = array(
		'png', 'jpg', 'jpeg', 'gif', 'bmp', 'svg'
	);

	public $rules = array(
		'large' => array(
				'score' => 1
			),
		'big' => array(
				'score' => 1
			),
		'main' => array(
				'score' => 1
			),
		'upload' => array(
				'score' => 1
			),
		'media' => array(
				'score' => 1
			)
	);

	public function __construct($baseUrl = '') {
		$this->setBaseUrl($baseUrl);
	}
/**
 * setBaseUrl
 * 
 * @param string $url
 */
	public function setBaseUrl($url) {
		$this->baseUrl = $url;
		return $this;
	}
/**
 * Fetch content
 *
 * @todo  replace with curl in near future
 * @param  string $url
 * @return string
 */
	public function fetchContent($url) {
		return file_get_contents($url);
	}
}