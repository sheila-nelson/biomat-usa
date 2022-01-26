<?php
class ViewTemplate {
    var $cssPath = '';
    var $assignedValues = array();
    var $partialBuffer;
    var $tmplName;
    var $tmpl;

    function __construct($_filePath = '') {
        if (!empty($_filePath)) {
            if (file_exists($_filePath)) {
                $this->tmplName = explode('.', str_replace('templates/', '', $_filePath))[0];
                $this->tmpl = file_get_contents($_filePath);
                $this->includeRelatedCss();
            } else {
                echo "there was a template issue";
            }
        }
    }

    function renderPartial($_searchString, $_filePath, $_assignedValues = array()){
        if (!empty($_searchString)) {
            if (file_exists($_filePath)) {
                $this->partialBuffer = file_get_contents($_filePath);
                if (count($_assignedValues) > 0) {
                    $this->updatePartialBuffer($_assignedValues);
                }
                // USE [[___YOUR_VAR____]] as template PARTIAL replace expressions
                $tmplTarget = "[[".strtoupper($_searchString)."]]"; 
                $this->tmpl = str_replace($tmplTarget, $this->partialBuffer, $this->tmpl);
                // clear buffer
                $this->partialBuffer = '';
                
            } else {
                echo "template error when rendering partials";
            }
        }
    }

    // Loop through and replace values of target in partial buffer
    function updatePartialBuffer($_assignedValues) {
        foreach($_assignedValues as $key => $value) {
            // USE {{___YOUR_VAR____}} as variable replace expressions
            $assignedValTarget = "{{".strtoupper($key)."}}";
            $this->partialBuffer = str_replace($assignedValTarget, $value, $this->partialBuffer);
        }
    }


    function assign($_searchString, $_replaceString) {
        if (!empty($_searchString)) {
            $this->assignedValues[strtoupper($_searchString)] = $_replaceString;
        }
    }

    function includeRelatedCss() {
        if (file_exists('./css/'.$this->tmplName.'.css')) {            
            $sheetName = 'pagestyles';
            $linkStart = '<link rel="stylesheet" href="./assets/css/';
            $linkEnd = '.css">';
            $originalTarget = "<!-- page specific styles -->";
            
            if (stristr($this->tmpl, $originalTarget)) {
                $updatedTarget = $linkStart.$this->tmplName.$linkEnd;
                $this->tmpl = str_replace($originalTarget,$updatedTarget, $this->tmpl);
            }
        }
    }

    function show() {
        if (count($this->assignedValues) > 0) {
            foreach ($this->assignedValues as $key => $value) {
                $this->tmpl = str_replace("{{".$key."}}", $value, $this->tmpl);
            }
        }
        echo $this->tmpl;
    }
}