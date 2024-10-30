<?php
namespace tmc\bs\src\Components;

/**
 * @author jakubkuranda@gmail.com
 * Date: 04.06.2018
 * Time: 13:21
 */

use shellpress\v1_3_71\src\Shared\Components\IComponent;
use tmc\bs\src\App;
use WP_Query;
use WP_Term;

class Display extends IComponent {

    const SUBMIT_AJAX_CALLBACK = 'tmc_bs_submit_callback';

	/**
	 * Called on creation of component.
	 *
	 * @return void
	 */
	protected function onSetUp() {

		add_action( 'wp_footer',                                        array( $this, '_a_displayPopupRoot' ) );
		add_action( 'wp_enqueue_scripts',                               array( $this, '_a_enqueueScripts' ) );

		add_action( 'wp_ajax_nopriv_' . $this::SUBMIT_AJAX_CALLBACK,    array( $this, '_a_submitAjaxCallback' ) );
		add_action( 'wp_ajax_' . $this::SUBMIT_AJAX_CALLBACK,           array( $this, '_a_submitAjaxCallback' ) );

		add_filter( 'wp_nav_menu_objects',                              array( $this, '_f_applyShortcodesOnNavMenu' ) );

	}

	/**
	 * Checks if current page should display popup HTML.
	 *
	 * @return bool
	 */
	protected function shouldDisplayPopup() {

		return ! is_admin();

	}

	//  ================================================================================
	//  ACTIONS
	//  ================================================================================

	/**
	 * Called on wp_footer.
	 *
	 * @internal
	 *
	 * @return void
	 */
	public function _a_displayPopupRoot() {

		if( ! $this->shouldDisplayPopup() ) return;

		?>

		<div class="tmc_bs_root" id="tmc_bs_root">

            <div class="close-root">

                <span class="close" id="tmc_bs_close"></span>

            </div>

            <div class="wrapper-inner">

                <form id="tmc_bs_form" action="<?php echo admin_url( 'admin-ajax.php' ); ?>">

                    <input type="hidden" name="action" value="<?php echo $this::SUBMIT_AJAX_CALLBACK; ?>">

                    <div class="inputs-row">
                        <div>
                            <input type="text" name="search" autocomplete="off" id="tmc_bs_input_text" class="input-text" placeholder="<?php echo App::i()->settings->getSearchPlaceholder(); ?>">
                        </div>
                        <div>
                            <input type="submit" class="input-button" id="tmc_bs_submit_button" data-loadingText="<?php echo App::i()->settings->getSearchButtonLoadingText(); ?>" value="<?php echo App::i()->settings->getSearchButtonText(); ?>">
                        </div>
                    </div>
                </form>

                <div class="results" id="tmc_bs_results">
                    <!-- HERE GOES RESULTS -->
                </div>

            </div>

		</div>

		<?php

	}

	/**
	 * Called on wp_enqueue_scripts.
     *
     * @internal
     *
     * @return void
	 */
	public function _a_enqueueScripts() {

	    if( ! $this->shouldDisplayPopup() ) return;

	    wp_enqueue_style( 'tmc_bs_style', $this::s()->getUrl( 'assets/css/style.css' ), array(), $this::s()->getFullPluginVersion() );

	    wp_enqueue_script( 'tmc_bs_search', $this::s()->getUrl( 'assets/js/front.js' ), array( 'jquery' ), $this::s()->getFullPluginVersion(), true );

	    ?>

        <!-- BEGIN TMC Better Search CUSTOM STYLE -->
        <style>
            #tmc_bs_root {
                color:                  <?php echo App::i()->settings->getTextColor(); ?>;
                background-color:       <?php echo App::i()->settings->getBackgroundColor(); ?>;
            }
            #tmc_bs_input_text {
                border-bottom-color:    <?php echo App::i()->settings->getColorAccentPrimary(); ?>;
            }
            #tmc_bs_submit_button {
                color:                  <?php echo App::i()->settings->getColorAccentSecondary(); ?>;
                background-color:       <?php echo App::i()->settings->getColorAccentPrimary(); ?>;
            }
            #tmc_bs_close:before,
            #tmc_bs_close:after {
                background-color:       <?php echo App::i()->settings->getColorAccentPrimary(); ?>;
            }
        </style>
        <!-- END TMC Better Search CUSTOM STYLE -->

        <?php

    }

	/**
     * Prepares HTML for ajax request.
     *
	 * @return void
	 */
    public function _a_submitAjaxCallback() {

        //  ----------------------------------------
        //  Prepare query
        //  ----------------------------------------

        $query = new WP_Query( array(
            'post_type'     =>  App::i()->settings->getSupportedPostTypes(),
            's'             =>  sanitize_text_field( $_REQUEST['search'] ),
            'post_status'   =>  'publish',
        ) );

        //  ----------------------------------------
        //  Pack data
        //  ----------------------------------------

	    //  Data passed to mustache engine.
        $templateData = array(
            'noResultsText'     =>  App::i()->settings->getNoResultsFoundText()
        );

	    while( $query->have_posts() ){

		    $query->the_post();

		    //  Messy stuff.

		    $thumbUrl       = get_the_post_thumbnail_url( null, 'thumbnail' );
		    $thumbPos       = App::i()->settings->getThumbnailsPosition();
		    $excerpt        = has_excerpt() ? apply_filters( 'the_excerpt', get_the_excerpt() ) : wp_trim_excerpt();
		    $titleTag       = App::i()->settings->getResultTitleTag();
		    $titleRendered  = "<{$titleTag}>" . apply_filters( 'the_title', get_the_title() ) . "</{$titleTag}>";

		    //  Nice, packed data.

		    $templateData['results'][] = array(
			    'title'         =>  get_the_title(),
			    'titleRendered' =>  $titleRendered,
			    'excerpt'       =>  strip_shortcodes( $excerpt ),
			    'url'           =>  get_the_permalink(),
			    'hasThumb'      =>  $thumbUrl && $thumbPos,
			    'thumbUrl'      =>  $thumbUrl,
			    'thumbPos'      =>  $thumbPos
		    );

		    wp_reset_postdata();

	    }

        //  ----------------------------------------
        //  Render HTML
        //  ----------------------------------------

        $html = $this::s()->mustache->render( 'src/Templates/searchResult.mustache', $templateData );

        wp_die( $html );    //  Send ajax response.

    }

    //  ================================================================================
    //  FILTERS
    //  ================================================================================

	/**
	 * @param string[] $items
	 *
	 * @return string[]
	 */
    public function _f_applyShortcodesOnNavMenu( $items ) {

        foreach( $items as $key => $item ){ /** @var WP_Term $item */
            if( strpos( $item->title, ShortCodes::SHORTCODE_TAG ) ){
                $item->title = do_shortcode( $item->title );
                $item->url = '';
            }
        }

        return $items;

    }

}