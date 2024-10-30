<?php 
/**
	Admin Page Framework v3.8.19 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/tmcapf>
	Copyright (c) 2013-2019, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class TMC_v1_0_6_AdminPageFramework_FieldType__nested extends TMC_v1_0_6_AdminPageFramework_FieldType {
    public $aFieldTypeSlugs = array('_nested');
    protected $aDefaultKeys = array();
    protected function getStyles() {
        return ".tmcapf-fieldset > .tmcapf-fields > .tmcapf-field.with-nested-fields > .tmcapf-fieldset.multiple-nesting {margin-left: 2em;}.tmcapf-fieldset > .tmcapf-fields > .tmcapf-field.with-nested-fields > .tmcapf-fieldset {margin-bottom: 1em;}.with-nested-fields > .tmcapf-fieldset.child-fieldset > .tmcapf-child-field-title {display: inline-block;padding: 0 0 0.4em 0;}.tmcapf-fieldset.child-fieldset > label.tmcapf-child-field-title {display: table-row; white-space: nowrap;}";
    }
    protected function getField($aField) {
        $_oCallerForm = $aField['_caller_object'];
        $_aInlineMixedOutput = array();
        foreach ($this->getAsArray($aField['content']) as $_aChildFieldset) {
            if (is_scalar($_aChildFieldset)) {
                continue;
            }
            if (!$this->isNormalPlacement($_aChildFieldset)) {
                continue;
            }
            $_aChildFieldset = $this->getFieldsetReformattedBySubFieldIndex($_aChildFieldset, ( integer )$aField['_index'], $aField['_is_multiple_fields'], $aField);
            $_oFieldset = new TMC_v1_0_6_AdminPageFramework_Form_View___Fieldset($_aChildFieldset, $_oCallerForm->aSavedData, $_oCallerForm->getFieldErrors(), $_oCallerForm->aFieldTypeDefinitions, $_oCallerForm->oMsg, $_oCallerForm->aCallbacks);
            $_aInlineMixedOutput[] = $_oFieldset->get();
        }
        return implode('', $_aInlineMixedOutput);
    }
    }
    class TMC_v1_0_6_AdminPageFramework_FieldType_inline_mixed extends TMC_v1_0_6_AdminPageFramework_FieldType__nested {
        public $aFieldTypeSlugs = array('inline_mixed');
        protected $aDefaultKeys = array('label_min_width' => '', 'show_debug_info' => false,);
        protected function getStyles() {
            return ".tmcapf-field-inline_mixed {width: 98%;}.tmcapf-field-inline_mixed > fieldset {display: inline-block;overflow-x: visible;padding-right: 0.4em;}.tmcapf-field-inline_mixed > fieldset > .tmcapf-fields{display: inline;width: auto;table-layout: auto;margin: 0;padding: 0;vertical-align: middle;white-space: nowrap;}.tmcapf-field-inline_mixed > fieldset > .tmcapf-fields > .tmcapf-field {float: none;clear: none;width: 100%;display: inline-block;margin-right: auto;vertical-align: middle; }.with-mixed-fields > fieldset > label {width: auto;padding: 0;}.tmcapf-field-inline_mixed > fieldset > .tmcapf-fields > .tmcapf-field .tmcapf-input-label-string {padding: 0;}.tmcapf-field-inline_mixed > fieldset > .tmcapf-fields > .tmcapf-field > .tmcapf-input-label-container,.tmcapf-field-inline_mixed > fieldset > .tmcapf-fields > .tmcapf-field > * > .tmcapf-input-label-container{padding: 0;display: inline-block;width: 100%;}.tmcapf-field-inline_mixed > fieldset > .tmcapf-fields > .tmcapf-field > .tmcapf-input-label-container > label,.tmcapf-field-inline_mixed > fieldset > .tmcapf-fields > .tmcapf-field > * > .tmcapf-input-label-container > label{display: inline-block;}.tmcapf-field-inline_mixed > fieldset > .tmcapf-fields > .tmcapf-field > .tmcapf-input-label-container > label > input,.tmcapf-field-inline_mixed > fieldset > .tmcapf-fields > .tmcapf-field > * > .tmcapf-input-label-container > label > input{display: inline-block;min-width: 100%;margin-right: auto;margin-left: auto;}.tmcapf-field-inline_mixed .tmcapf-input-label-container,.tmcapf-field-inline_mixed .tmcapf-input-label-string{min-width: 0;}";
        }
    }
    