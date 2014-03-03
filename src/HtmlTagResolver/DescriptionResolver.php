<?php
/**
 * This is part of the HtmlTagResolver package
 *
 * (c) Min Ye (Ryan) <ryanicle@gmail.com>
 */
namespace HtmlTagResolver;
class DescriptionResolver extends BaseResolver {
	public function resolve() {
		$html = $this->fetchContent($this->baseUrl);
		
		libxml_use_internal_errors( true );
		$doc = new \DOMDocument();
		$doc->loadHTML($html);

		$description = null;
		$metaTags = $doc->getElementsByTagName('meta');

		if (empty($description)) {
			# Base on data-page-subject attribute
			foreach($metaTags as $metaTag) {
				$metaTagSubject = $metaTag->getAttribute('data-page-subject');
				$metaTagName = $metaTag->getAttribute('name');
				if (empty($description) && !empty($metaTagSubject) && preg_match('/description/i', $metaTagName)) {
					$description = $metaTag->getAttribute('content');
				}
			}
		}

		if (empty($description)) {
			$metaTags = $doc->getElementsByTagName('meta');
			foreach($metaTags as $metaTag) {
				$metaTagProperty = $metaTag->getAttribute('property');
				if (empty($description) && !empty($metaTagProperty) && preg_match('/description/i', $metaTagProperty)) {
					$description = $metaTag->getAttribute('content');
				}
			}
		}

		if (!empty($description))
			return $description;
		else
			return null;
	}
}