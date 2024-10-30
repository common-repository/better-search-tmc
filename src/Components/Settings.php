<?php

namespace tmc\bs\src\Components;

/**
 * @author jakubkuranda@gmail.com
 * Date: 04.06.2018
 * Time: 13:18
 */

use shellpress\v1_3_71\src\Shared\Components\IComponent;

class Settings extends IComponent {

	/**
	 * Called on creation of component.
	 *
	 * @return void
	 */
	protected function onSetUp() {

		$this::s()->options->setDefaultOptions(
			array(
				'searching'                     =>  array(
					'postTypes'                     =>  array(
						'post'                          =>  1
					)
				),
				'shortcodes'                    =>  array(
					'openBtnIcon'                   =>  $this::s()->getUrl( 'assets/img/icon-search.png' ),
					'openBtnText'                   =>  __( 'Search', 'tmc_bs' ),
				),
				'appearance'                    =>  array(
					'bgColor'                       =>  '#ffffff',
					'textColor'                     =>  '#000000',
					'colorAccentPrimary'            =>  '#343a40',
					'colorAccentSecondary'          =>  '#ffffff'
				),
				'content'                       =>  array(
					'resultTitleTag'                =>  'h2',
					'inputSearchTextPlaceholder'    =>  __( 'I am looking for...', 'tmc_bs' ),
					'inputSearchButtonText'         =>  __( 'Search', 'tmc_bs' ),
					'inputSearchButtonLoadingText'  =>  __( 'Searching...', 'tmc_bs' ),
					'noResultsFoundText'            =>  __( 'No results found.', 'tmc_bs' ),
				)
			)
		);

		$this::s()->event->addOnActivate( array( $this, '_a_fillSettingsOnPluginActivation' ) );

	}

	/**
	 * @return string|null
	 */
	public function getBackgroundColor() {

		return $this::s()->options->get( 'appearance/bgColor', '#ffffff' );

	}

	/**
	 * @return string|null
	 */
	public function getTextColor() {

		return $this::s()->options->get( 'appearance/textColor', '#000000' );

	}

	/**
	 * @return string|null
	 */
	public function getColorAccentPrimary() {

		return $this::s()->options->get( 'appearance/colorAccentPrimary', '#000000' );

	}

	/**
	 * @return string|null
	 */
	public function getColorAccentSecondary() {

		return $this::s()->options->get( 'appearance/colorAccentSecondary', '#ffffff' );

	}

	/**
	 * @return string|null
	 */
	public function getResultTitleTag() {

		return $this::s()->options->get( 'content/resultTitleTag', 'h2' );

	}

	/**
	 * @return string|null
	 */
	public function getSearchPlaceholder() {

		return $this::s()->options->get( 'content/inputSearchTextPlaceholder' );

	}

	/**
	 * @return string|null
	 */
	public function getSearchButtonText() {

		return $this::s()->options->get( 'content/inputSearchButtonText' );

	}

	/**
	 * @return string|null
	 */
	public function getSearchButtonLoadingText() {

		return $this::s()->options->get( 'content/inputSearchButtonLoadingText' );

	}
	/**
	 * @return string|null
	 */
	public function getNoResultsFoundText() {

		return $this::s()->options->get( 'content/noResultsFoundText' );

	}

	/**
	 * @return string|bool
	 */
	public function getThumbnailsPosition() {

		$option = $this::s()->options->get( 'thumbnails/position' );

		if( ! $option || $option === 'disabled' ){
			return false;
		} else {
			return $option;
		}

	}

	/**
	 * @return array
	 */
	public function getSupportedPostTypes() {

		$postTypes  = (array) $this::s()->options->get( 'searching/postTypes' );
		$supported  = array();

		foreach( $postTypes as $type => $value ){

			if( $value ){
				$supported[] = $type;
			}

		}

		return $supported;

	}

	/**
	 * @return string
	 */
	public function getOpenButtonIconUrl() {

		return $this::s()->options->get( 'shortcodes/openBtnIcon', '' );

	}

	/**
	 * @return string
	 */
	public function getOpenButtonText() {

		return $this::s()->options->get( 'shortcodes/openBtnText', '' );

	}

	/**
	 * @return string
	 */
	public function getAnalyticsType() {

		return $this::s()->options->get( 'analytics/type' );

	}

	/**
	 * @return bool
	 */
	public function isInternalHistoryEnabled() {

		return (bool) $this::s()->options->get( 'internalHistory/isEnabled', false );

	}

	/**
	 * @return int
	 */
	public function getNumOfMaxStoredQueries() {

		return (int) $this::s()->options->get( 'internalHistory/numOfMaxStoredQueries', 0 );

	}

	/**
	 * @return array
	 */
	public function getStoredQueries() {

		return (array) get_option( $this::s()->getPrefix( '_storedQueries' ), array() );

	}

	/**
	 * @param array $array
	 *
	 * @return void
	 */
	public function setStoredQueries( $array ) {

		update_option( $this::s()->getPrefix( '_storedQueries' ), $array );

	}

	//  ================================================================================
	//  ACTIONS
	//  ================================================================================

	/**
	 * Called on plugin activation.
	 *
	 * @internal
	 */
	public function _a_fillSettingsOnPluginActivation() {

		$this::s()->log->info( 'Filled settings differences.', $this::s()->options->getDefaultOptions() );

		$this::s()->options->fillDifferencies();
		$this::s()->options->flush();

	}

}