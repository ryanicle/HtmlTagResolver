<?php
/**
 * This is part of the HtmlTagResolver package
 *
 * (c) Min Ye (Ryan) <ryanicle@gmail.com>
 */
namespace HtmlTagResolver;
class TitleResolver extends BaseResolver {
	public function resolve() {
		$html = $this->fetchContent($this->baseUrl);
		
		libxml_use_internal_errors( true );
		$doc = new \DOMDocument();
		$doc->loadHTML($html);

		$nodes = $doc->getElementsByTagName('title');
		$title = $nodes->item(0)->nodeValue;
		
		if (empty($title)) {
			# Based on data-page-subject attribute
			$metaTags = $doc->getElementsByTagName('meta');
			foreach($metaTags as $metaTag) {
				$metaTagSubject = $metaTag->getAttribute('data-page-subject');
				$metaTagName = $metaTag->getAttribute('name');
				if (empty($title) && !empty($metaTagSubject) && preg_match('/title/i', $metaTagName)) {
					$title = $metaTag->getAttribute('content');
				}
			}
		}

		if (empty($title)) {
			$metaTags = $doc->getElementsByTagName('meta');
			foreach($metaTags as $metaTag) {
				$metaTagProperty = $metaTag->getAttribute('property');
				if (empty($description) && !empty($metaTagProperty) && preg_match('/title/i', $metaTagProperty)) {
					$description = $metaTag->getAttribute('content');
				}
			}
		}

		if (!empty($title))
			return $title;
		else
			return null;
	}
}