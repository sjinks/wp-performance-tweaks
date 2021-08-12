<?php

namespace WildWolf\WordPress\PerformanceTweaks;

trait Singleton {
	/** @var self|null */
	protected static $instance;

	public static function instance(): self {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		// Do nothing
	}
}
