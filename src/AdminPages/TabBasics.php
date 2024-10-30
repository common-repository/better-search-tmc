<?php
namespace tmc\bs\src\AdminPages;

/**
 * @author jakubkuranda@gmail.com
 * Date: 08.06.2018
 * Time: 11:05
 */

use shellpress\v1_3_71\src\Shared\AdminPageFramework\AdminPageTab;
use WP_Post_Type;

class TabBasics extends AdminPageTab {

	/**
	 * Declaration of current element.
	 */
	public function setUp() {

		//  ----------------------------------------
		//  Definition
		//  ----------------------------------------

		$this->pageFactory->addInPageTab(
			array(
				'page_slug'     =>  $this->pageSlug,
				'tab_slug'      =>  $this->tabSlug,
				'title'         =>  __( 'Basics', 'tmc_bs' )
			)
		);

	}

	/**
	 * Called while current component is loaded.
	 */
	public function load() {

		//  ----------------------------------------
		//  Sections
		//  ----------------------------------------

		$this->pageFactory->addSettingSections(
			array(
				'section_id'        =>  'searching',
				'title'             =>  __( 'Searching', 'tmc_bs' ),
				'page_slug'         =>  $this->pageSlug,
				'tab_slug'          =>  $this->tabSlug,
			),
			array(
				'section_id'        =>  'shortcodes',
				'title'             =>  __( 'Shortcodes', 'tmc_bs' ),
				'page_slug'         =>  $this->pageSlug,
				'tab_slug'          =>  $this->tabSlug,
				'description'       =>  array(
					sprintf( '<p>%1$s <code>[tmc_bs_open]</code></p>',
						__( 'To display search button, use shortcode: ', 'tmc_bs' )
					),
					sprintf( '<p>%1$s</p>',
						__( 'This shortcode will work even in built in WordPress navigation menus.', 'tmc_bs' )
					),
					sprintf( '<p>%1$s <code>%2$s</code></p>',
						__( 'You can trigger shortcodes in your own code like this: ', 'tmc_bs' ),
						htmlentities( '<?php echo do_shortcode( \'[tmc_bs_open]\' ); ?>' )
					)
				)
			),
			array(
				'section_id'        =>  'content',
				'title'             =>  __( 'Content', 'tmc_bs' ),
				'page_slug'         =>  $this->pageSlug,
				'tab_slug'          =>  $this->tabSlug,
			),
			array(
				'section_id'        =>  'submit',
				'page_slug'         =>  $this->pageSlug,
				'tab_slug'          =>  $this->tabSlug,
				'save'              =>  false
			)
		);

		//  ----------------------------------------
		//  Fields
		//  ----------------------------------------

		$this->pageFactory->addSettingFields(
			'searching',
			array(
				'field_id'          =>  'postTypes',
				'type'              =>  'checkbox',
				'title'             =>  __( 'Post types', 'tmc_bs' ),
				'label'             =>  $this->getAllPostTypesNames()
			)
		);

		$this->pageFactory->addSettingFields(
			'shortcodes',
			array(
				'field_id'          =>  'openBtnIcon',
				'type'              =>  'image',
				'title'             =>  __( 'Open button icon', 'tmc_bs' )
			),
			array(
				'field_id'          =>  'openBtnText',
				'type'              =>  'text',
				'title'             =>  __( 'Open button text', 'tmc_bs' ),
				'tip'               =>  __( 'If the icon is not set or could not be loaded, this text will be displayed instead of.', 'tmc_bs' )
			)
		);

		$this->pageFactory->addSettingFields(
			'content',
			array(
				'field_id'          =>  'resultTitleTag',
				'type'              =>  'select',
				'title'             =>  __( 'Result header tag', 'tmc_bs' ),
				'label'             =>  array(
					'h1'                =>  'h1',
					'h2'                =>  'h2',
					'h3'                =>  'h3',
					'h4'                =>  'h4',
					'h5'                =>  'h5',
					'h6'                =>  'h6',
				),
				'default'           =>  'h2'
			),
			array(
				'field_id'          =>  'inputSearchTextPlaceholder',
				'type'              =>  'text',
				'title'             =>  __( 'Search placeholder', 'tmc_bs' ),
				'attributes'        =>  array(
					'class'             =>  'regular-text'
				)
			),
			array(
				'field_id'          =>  'inputSearchButtonText',
				'type'              =>  'text',
				'title'             =>  __( 'Search button text' ),
				'attributes'        =>  array(
					'class'             =>  'regular-text'
				)
			),
			array(
				'field_id'          =>  'inputSearchButtonLoadingText',
				'type'              =>  'text',
				'title'             =>  __( 'Search button loading', 'tmc_bs' ),
				'attributes'        =>  array(
					'class'             =>  'regular-text'
				)
			),
			array(
				'field_id'          =>  'noResultsFoundText',
				'type'              =>  'text',
				'title'             =>  __( 'No results text', 'tmc_bs' ),
				'attributes'        =>  array(
					'class'             =>  'regular-text'
				)
			)
		);

		$this->pageFactory->addSettingFields(
			'submit',
			array(
				'field_id'          =>  'submit',
				'type'              =>  'submit',
				'save'              =>  false
			)
		);

	}

	/**
	 * Returns array of keys => value post types.
	 *
	 * @return array
	 */
	private function getAllPostTypesNames() {

		/** @var WP_Post_Type[] $postTypesObjects */
		$postTypesObjects = get_post_types( array( 'public' => true ), 'objects' );

		$postTypes      = array();
		$excludeList    = array( 'attachment' );
		$acceptedList   = array( 'post', 'page' );  //  This will be used temporary.

		foreach( $postTypesObjects as $postType ){
			if( in_array( $postType->name, $acceptedList ) ){  //  Accept if in list

				$postTypes[ $postType->name ] = sprintf( '<span  style="display: inline-block; width: 150px; margin-right: 1em;">%1$s</span> <i>( %2$s )</i>',
					$postType->label,
					$postType->name
				);

			}
		}

		return $postTypes;

	}

}