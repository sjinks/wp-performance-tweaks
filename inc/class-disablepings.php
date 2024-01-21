<?php

namespace WildWolf\WordPress\PerformanceTweaks;

use WildWolf\Utils\Singleton;
use WP_Error;

/**
 * @psalm-type CronEvent = object{ hook: string, timestamp: int, schedule: string|false, args: mixed[], interval?: int }
 */
final class DisablePings {
	use Singleton;

	/**
	 * Constructed during `init`
	 */
	private function __construct() {
		$this->init();
	}

	private function init(): void {
		add_filter( 'pre_schedule_event', [ $this, 'pre_schedule_event' ], 10, 2 );
		add_filter( 'schedule_event', [ $this, 'schedule_event' ] );
	}

	/**
	 * @param null|bool|WP_Error $pre      Value to return instead. Default null to continue adding the event.
	 * @param object $event                An object containing an event's data
	 * @psalm-param CronEvent $event
	 * @return null|bool|WP_Error
	 */
	public function pre_schedule_event( $pre, $event ) {
		if ( null !== $pre ) {
			return $pre;
		}

		return 'do_pings' === $event->hook ? false : $pre;
	}

	/**
	 * @param object|false $event          An object containing an event's data, or boolean false to prevent the event from being scheduled
	 * @psalm-param false|CronEvent $event
	 * @return object|false
	 * @psalm-return false|CronEvent
	 */
	public function schedule_event( $event ) {
		if ( ! is_object( $event ) ) {
			return $event;
		}

		return 'do_pings' === $event->hook ? false : $event;
	}
}
