<?php 
/**
	Admin Page Framework v3.8.19 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/tmcapf>
	Copyright (c) 2013-2019, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class TMC_v1_0_6_AdminPageFramework_Form_View___Attribute_SectionsTablesContainer extends TMC_v1_0_6_AdminPageFramework_Form_View___Attribute_Base {
    public $aSectionset = array();
    public $sSectionsID = '';
    public $sSectionTabSlug = '';
    public $aCollapsible = array();
    public $iSubSectionCount = 0;
    public function __construct() {
        $_aParameters = func_get_args() + array($this->aSectionset, $this->sSectionsID, $this->sSectionTabSlug, $this->aCollapsible, $this->iSubSectionCount,);
        $this->aSectionset = $_aParameters[0];
        $this->sSectionsID = $_aParameters[1];
        $this->sSectionTabSlug = $_aParameters[2];
        $this->aCollapsible = $_aParameters[3];
        $this->iSubSectionCount = $_aParameters[4];
    }
    protected function _getAttributes() {
        return array('id' => $this->sSectionsID, 'class' => $this->getClassAttribute('tmcapf-sections', $this->getAOrB(!$this->sSectionTabSlug || '_default' === $this->sSectionTabSlug, null, 'tmcapf-section-tabs-contents'), $this->getAOrB(empty($this->aCollapsible), null, 'tmcapf-collapsible-sections-content' . ' ' . 'tmcapf-collapsible-content' . ' ' . 'accordion-section-content'), $this->getAOrB(empty($this->aSectionset['sortable']), null, 'sortable-section')), 'data-seciton_id' => $this->aSectionset['section_id'], 'data-section_address' => $this->aSectionset['section_id'], 'data-section_address_model' => $this->aSectionset['section_id'] . '|' . '___i___',) + $this->_getDynamicElementArguments($this->aSectionset);
    }
    private function _getDynamicElementArguments($aSectionset) {
        if (empty($aSectionset['repeatable']) && empty($aSectionset['sortable'])) {
            return array();
        }
        $aSectionset['_index'] = null;
        $_oSectionNameGenerator = new TMC_v1_0_6_AdminPageFramework_Form_View___Generate_SectionName($aSectionset, $aSectionset['_caller_object']->aCallbacks['hfSectionName']);
        return array('data-largest_index' => max(( int )$this->iSubSectionCount - 1, 0), 'data-section_id_model' => $aSectionset['section_id'] . '__' . '___i___', 'data-flat_section_name_model' => $aSectionset['section_id'] . '|___i___', 'data-section_name_model' => $_oSectionNameGenerator->getModel(),);
    }
    }
    