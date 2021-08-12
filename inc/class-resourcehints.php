<?php

namespace WildWolf\WordPress\PerformanceTweaks;

/**
 * @psalm-type ResourceHint = string|array{href: string, 'as': string, crossorigin: string, pr: float, type: string}
 */
final class ResourceHints {

	use Singleton;

	/**
	 * Constructed during `init`
	 */
	private function __construct() {
		$this->init();
	}

	private function init(): void {
		add_filter( 'wp_resource_hints', [ $this, 'wp_resource_hints' ], 10, 2 );
	}

	/**
	 * @param array $urls            Array of resources and their attributes, or URLs to print for resource hints.
	 * @psalm-param ResourceHint[] $urls
	 * @param string $relation_type  The relation type the URLs are printed for
	 * @return array
	 * @psalm-return ResourceHint[]
	 */
	public function wp_resource_hints( $urls, $relation_type ) {
		if ( 'dns-prefetch' !== $relation_type ) {
			return $urls;
		}

		/** @var ResourceHint[] */
		$ret = [];

		foreach ( $urls as $url ) {
			$href = is_array( $url ) ? $url['href'] : $url;
			if ( ! empty( $href ) ) {
				if ( ! preg_match( '!^(?:https?:)?//!i', $href ) ) {
					$href = '//' . $href;
				}

				/** @var string|null */
				$host = wp_parse_url( $href, PHP_URL_HOST );

				if ( $host && 's.w.org' !== $host ) {
					$ret[] = $url;
				}
			}
		}

		return $ret;
	}
}
