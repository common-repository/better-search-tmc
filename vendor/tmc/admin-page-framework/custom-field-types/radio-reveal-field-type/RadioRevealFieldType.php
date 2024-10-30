<?php

/**
 * @author jakubkuranda@gmail.com
 * Date: 2017-08-05
 * Time: 01:51
 */

class TMC_v1_0_6_RadioRevealFieldType extends TMC_v1_0_6_AdminPageFramework_FieldType_radio {

    /**
     * Defines the field type slugs used for this field type.
     */
    public $aFieldTypeSlugs = array( 'radioreveal' );

    /**
     * Defines the default key-values of this field type.
     *
     * Ezample of reveals array:
     *
     * array(
     *      'a'     =>  '#field_1',
     *      'b'     =>  '#field_2'
     * )
     */
    protected $aDefaultKeys = array(
        'label'                 =>  array(),
        'attributes'            =>  array(),
        'reveals'               =>  array()     //  Array of css selectors to reveal
    );

    /**
     * Gets modified field HTML.
     * It adds new script at the end of whole string.
     *
     * @param array $fieldArray
     *
     * @return string
     *
     */
    public function getField( $fieldArray ) {

        $wholeFieldHtml = parent::getField( $fieldArray );

        return $wholeFieldHtml . PHP_EOL . $this->_getRevealScript( $fieldArray['_field_container_id'], $fieldArray['reveals'] );

    }

    /**
     * Gets whole javascript definition.
     *
     * @param string $fieldContainerId
     *
     * @return string
     */
    protected function _getRevealScript( $fieldContainerId, $revealSelectors ) {

        $jsonRevealSelectors = wp_json_encode( $revealSelectors );

        $script = "
            jQuery( document ).ready( function( $ ){
            
                var revealSelectors = {$jsonRevealSelectors};
                
                $( '#{$fieldContainerId}' ).TMC_RadioReveal( revealSelectors );
                
            });
        ";

        return "<script>{$script}</script>";

    }

    /**
     * Enqueue scripts.
     *
     * @return array
     */
    public function getEnqueuingScripts() {

        $scripts = array(
            array(
                'src'           =>  __DIR__ . '/RadioReveal.js',
                'version'       =>  'TMC_v1_0_5',
                'dependencies'  =>  array( 'jquery' )
            )
        );

        return $scripts;

    }

}