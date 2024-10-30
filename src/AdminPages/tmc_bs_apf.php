<?php

use tmc\bs\src\AdminPages\TabBasics;
use tmc\bs\src\App;

/**
 * @author jakubkuranda@gmail.com
 * Date: 04.06.2018
 * Time: 12:48
 */

class tmc_bs_apf extends TMC_v1_0_6_AdminPageFramework {

	public function setUp() {

		//  ----------------------------------------
		//  Definition
		//  ----------------------------------------

		$this->oProp->bShowDebugInfo = false;
		$this->setInPageTabTag( 'h2' );

		$this->setRootMenuPage( 'Settings' );
		$this->addSubMenuItem(
			array(
				'title'     =>  __( 'Better Search TMC' ),
				'page_slug' =>  'tmc_bs_settings'
			)
		);

		//  ----------------------------------------
		//  Tabs
		//  ----------------------------------------

		new TabBasics( $this, 'tmc_bs_settings', 'basics' );

	}

	public function load() {

		//  ----------------------------------------
		//  Filters
		//  ----------------------------------------

		add_filter( 'footer_left_' . $this->oProp->sClassName,      array( $this, '_f_replaceFooterLeftHTML' ) );
		add_filter( 'footer_right_' . $this->oProp->sClassName,     array( $this, '_f_replaceFooterRightHTML' ) );

		//  ----------------------------------------
		//  Styles and scripts
		//  ----------------------------------------

		$this->enqueueStyle(
			App::s()->getUrl( 'vendor/tmc/shellpress/assets/css/AdminPageFramework/SPAdminPageFramework.css' ),
			'',
			'',
			array(
				'version'   =>  App::s()->getFullPluginVersion()
			)
		);

	}

	//  ================================================================================
	//  FILTERS
	//  ================================================================================

	/**
	 * Called on footer_left_.
	 *
	 * @return string
	 */
	public function _f_replaceFooterLeftHTML() {

		$url = 'https://themastercut.co/?utm_source=client&utm_medium=plugin&utm_campaign=tmc-better-search';

		return sprintf( '<a href="%1$s" target="_blank">Better Search TMC by TheMasterCut.co</a>', $url );

	}

	/**
	 * Called on footer_right_.
	 *
	 * @return string
	 */
	public function _f_replaceFooterRightHTML() {

		return '';

	}

}