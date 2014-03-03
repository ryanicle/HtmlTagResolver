<?php
/**
 * This is part of the HtmlTagResolver package
 *
 * (c) Min Ye (Ryan) <ryanicle@gmail.com>
 */
namespace HtmlTagResolver;
class ImageResolver extends BaseResolver {
	public function resolve() {
		$html = $this->fetchContent($this->baseUrl);
		
		libxml_use_internal_errors( true );
		$doc = new \DOMDocument();
		$doc->loadHTML($html);

		$image = null;

		$images = array();
		$metaTags = $doc->getElementsByTagName('meta');
		foreach($metaTags as $metaTag) {
			$metaTagSubject = $metaTag->getAttribute('data-page-subject');
			$metaTagName = $metaTag->getAttribute('name');
			if (empty($image) && !empty($metaTagSubject) && preg_match('/image/i', $metaTagName)) {
				$image = $metaTag->getAttribute('content');
			}
		}

		if (empty($image)) {
			$metaTags = $doc->getElementsByTagName('meta');
			foreach($metaTags as $metaTag) {
				$metaTagProperty = $metaTag->getAttribute('property');
				if (empty($image) && !empty($metaTagProperty) && preg_match('/image/i', $metaTagProperty)) {
					$image = $metaTag->getAttribute('content');
				}
			}
		}

		return $image;
	}
}