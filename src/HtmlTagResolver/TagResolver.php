<?php
/**
 * This is part of the HtmlTagResolver package
 *
 * (c) Min Ye (Ryan) <ryanicle@gmail.com>
 */
namespace HtmlTagResolver;

class TagResolver extends BaseResolver {
/**
 * Resolve to get content based on tags such as title, description, image
 * 
 * @param  array $options
 * @return array
 */
	public function resolve($options) {
		$results = array();

		if (isset($options['title'])) {
			$titleResolver = new TitleResolver($this->baseUrl);
			$results['title'] = $titleResolver->resolve();
		}

		if (isset($options['description'])) {
			$descriptionResolver = new DescriptionResolver($this->baseUrl);
			$results['description'] = $descriptionResolver->resolve();
		}

		if (isset($options['image'])) {
			$imageResolver = new ImageResolver($this->baseUrl);
			$results['image'] = $imageResolver->resolve();
		}

		return $results;
	}
}