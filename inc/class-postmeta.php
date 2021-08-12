<?php

namespace WildWolf\WordPress\PerformanceTweaks;

class PostMeta {
	use Singleton;

	/**
	 * Constructed during `init`
	 */
	private function __construct() {
		$this->init();
	}

	public function init(): void {
		add_filter( 'add_post_metadata', [ $this, 'add_post_metadata' ], 10, 3 );
	}

	/**
	 * @param null|bool $check      Whether to allow adding metadata for the given type.
	 * @param int       $object_id  ID of the object metadata is for.
	 * @param string    $meta_key   Metadata key.
	 * @return null|bool
	 */
	public function add_post_metadata( $check, $object_id, $meta_key ) {
		return '_encloseme' === $meta_key ? false : $check;
	}
}
