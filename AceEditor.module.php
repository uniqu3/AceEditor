<?php
#-------------------------------------------------------------------------
# Module: AceEditor - Syntax highlighting editor http://ace.ajax.org/.
# Version: 0.2, Goran Ilic uniqu3e@gmail.com http://www.ich-mach-das.at
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2007 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------

#-------------------------------------------------------------------------
# For Help building modules:
# - Read the Documentation as it becomes available at
#   http://dev.cmsmadesimple.org/
# - Check out the Skeleton Module for a commented example
# - Look at other modules, and learn from the source
# - Check out the forums at http://forums.cmsmadesimple.org
# - Chat with developers on the #cms IRC channel
#-------------------------------------------------------------------------

class AceEditor extends CMSModule {
	protected $noeditors = 0,
	$headerinfosent = false,
	$_htmlactive = false,
	$_javascriptactive = false,
	$_cssactive = false,
	$_phpactive = false,
	$_defaultactive = false;

	public function GetName() {
		return 'AceEditor';
	}

	public function GetFriendlyName() {
		return $this -> Lang('friendlyname');
	}

	public function GetVersion() {
		return '0.2.3';
	}

	public function GetHelp() {

		$smarty = cmsms() -> GetSmarty();
		$config = cmsms()-> GetConfig();			
		$smarty -> assign('module_path', ($this -> GetModuleURLPath()));
		
		$smarty -> assign('help_general_title', $this -> Lang('help_general_title'));
		$smarty -> assign('help_general_text', $this -> Lang('help_general_text'));
		$smarty -> assign('help_keyboardshortcuts_title', $this -> Lang('help_keyboardshortcuts_title'));
		$smarty -> assign('help_keyboardshortcuts_content', $this -> Lang('help_keyboardshortcuts_content'));
		$smarty -> assign('help_frontend_title', $this -> Lang('help_frontend_title'));		
		$smarty -> assign('help_frontend_content', $this -> Lang('help_frontend_content'));
		$smarty -> assign('help_frontend_sample', cms_htmlentities($this -> Lang('help_frontend_sample')));
		$smarty -> assign('help_about_title', $this -> Lang('help_about_title'));
		$smarty -> assign('help_about_text', $this -> Lang('help_about_text'));

		return $this -> ProcessTemplate('help.tpl');
	}

	public function GetAuthor() {
		return 'Goran Ilic';
	}

	public function GetAuthorEmail() {
		return 'uniqu3e@gmail.com';
	}

	public function GetChangeLog() {
		return $this -> Lang('changelog');
	}

	public function IsPluginModule() {
	  return true;
	}

	public function SetParameters() 
	{
		if (version_compare(CMS_VERSION, '1.10') < 0) {
			$this -> InitializeFrontend();
			$this -> InitializeAdmin();
		}		
	}

	public function InitializeFrontend()
	{
		$this->RegisterModulePlugin();
		$this->RestrictUnknownParams();
		
		$this->SetParameterType('action', CLEAN_STRING);
		$this->SetParameterType('modes', CLEAN_STRING);
		$this->SetParameterType('themes', CLEAN_STRING);
		$this->SetParameterType('mode', CLEAN_STRING);
		$this->SetParameterType('theme', CLEAN_STRING);
		$this->SetParameterType('width', CLEAN_STRING);
		$this->SetParameterType('height', CLEAN_STRING);
		$this->SetParameterType('divid', CLEAN_STRING);

	}

	public function InitializeAdmin()
	{
		$this->CreateParameter('action', 'default', $this->Lang('help_param_action'));
		$this->CreateParameter('modes', 'html', $this->Lang('help_param_modes'));
		$this->CreateParameter('themes', 'textmate', $this->Lang('help_param_themes'));
		$this->CreateParameter('mode', 'html', $this->Lang('help_param_mode'));
		$this->CreateParameter('theme', 'textmate', $this->Lang('help_param_theme'));
		$this->CreateParameter('width', '400', $this->Lang('help_param_width'));
		$this->CreateParameter('height', '400', $this->Lang('help_param_height'));
		$this->CreateParameter('divid', 'editor', $this->Lang('help_param_divid'));

	}	

	public function LazyLoadFrontend() 
	{
		return false; // till Smarty3 and LazyLoading issue is figured out
	}

	public function HasAdmin() {
		return true;
	}

	public function GetAdminSection() {
		return 'extensions';
	}	

	public function GetAdminDescription() {
		return $this -> Lang('admindescription');
	}

	public function VisibleToAdminUser() {
		return $this -> CheckPermission('Modify Site Preferences');
	}

	public function MinimumCMSVersion() {
		return "1.9";
	}

	public function MaximumCMSVersion() {
		return "1.11";
	}

	public function InstallPostMessage() {
		return $this -> Lang('postinstall');
	}

	public function UninstallPostMessage() {
		return $this -> Lang('postuninstall');
	}

	public function UninstallPreMessage() {
		return $this -> Lang('really_uninstall');
	}

	public function HasCapability($capability, $params = array()) {
		switch($capability)
		{
			default:
				return false;
				break;

			case 'wysiwyg':
				return false;
				break;

			case 'syntaxhighlighting':
				return true;
				break;
		}
	}

	public function IsWYSIWYG() {
		return false;
	}

	public function IsSyntaxHighlighter() {
		return true;
	}

	public function SyntaxPageFormSubmit() {
		return;
	}

	public function SyntaxTextarea($name = 'textarea', $syntax = 'html', $columns = '80', $rows = '15', $encoding = '', $content = '', $stylesheet = '', $addtext = '')
	{
		$textarea = "";
		$this -> syntaxactive = true;
		$smarty = $this -> smarty;
    	$config = cmsms() -> GetConfig();
    	$smarty -> assign('textareaid', "editor".$this -> noeditors);
		$smarty -> assign('editorid', "ace-editor".$this -> noeditors);
    	$smarty -> assign('textareaname', $name);
    	$smarty -> assign('syntax_content', $content);
    	$smarty -> assign('id', $this -> noeditors);	

		$width = $this -> GetPreference('width','80');
		$smarty -> assign('width', $width);	
		$height = $this -> GetPreference('height','40');
		$smarty -> assign('height', $height);
		if ($this -> GetPreference('enable_ie','1') == '1'){
			$smarty -> assign('enable_ie', 'true');
		} else {
			$smarty -> assign('enable_ie', 'false');
		}			
		$theme = $this -> GetPreference('theme','textmate');
		$smarty -> assign('theme', $theme);	
		$fontsize = $this -> GetPreference('fontsize','12px');
		$smarty -> assign('fontsize', $fontsize);				
		if ($this -> GetPreference('full_line','1') == '1'){
			 $smarty -> assign('full_line', 'line');
		} else {
			$smarty -> assign('full_line', 'text');
		}
		if ($this -> GetPreference('highlight_active',1) == 1){
			$smarty -> assign('highlight_active', 'true');
		} else {
			$smarty -> assign('highlight_active', 'false');
		}
		if ($this -> GetPreference('show_invisibles','1') == '1'){
			$smarty -> assign('show_invisibles', 'true');
		} else {
			$smarty -> assign('show_invisibles', 'false');
		}
		if ($this -> GetPreference('persistent_hscroll','1') == '1'){
			$smarty -> assign('persistent_hscroll', 'true');
		} else {
			$smarty -> assign('persistent_hscroll', 'false');
		}	
		$soft_wrap = $this -> GetPreference('soft_wrap','80,80');
		$smarty -> assign('soft_wrap', $soft_wrap);				
		if ($this -> GetPreference('show_gutter','1') == '1'){
			$smarty -> assign('show_gutter', 'true');
		} else {
			$smarty -> assign('show_gutter', 'false');
		}	
		if ($this -> GetPreference('print_margin','1') == '1'){
			$smarty -> assign('print_margin', 'true');
		} else {
			$smarty -> assign('print_margin', 'false');
		}
		if ($this -> GetPreference('soft_tab',1) == 1){
			$smarty -> assign('soft_tab', 'true');
		} else {
			$smarty -> assign('soft_tab', 'false');
		}
		if ($this -> GetPreference('highlight_selected','1') == '1'){
			$smarty -> assign('highlight_selected', 'true');
		} else {
			$smarty -> assign('highlight_selected', 'false');
		}
		
		switch ($syntax) {
			case 'html' : $smarty -> assign('mode', 'html'); $this -> _htmlactive = true; break;
			case 'js': case 'javascript' : $smarty -> assign('mode', 'javascript'); $this -> _javascriptactive = true; break;
			case 'css' : $smarty -> assign('mode', 'css'); $this -> _cssactive = true; break;
			case 'php' : $smarty -> assign('mode', 'php'); $this -> _phpactive = true; break;
			default : $syntax = $this -> GetPreference('mode','html'); $smarty -> assign('mode', $syntax); $this -> _defaultactive = true; break;	
		}
		
    	$textarea = $this -> ProcessTemplate('ace.tpl');
		$this -> noeditors++;

		return $textarea;											
	}

	public function SyntaxGenerateHeader($htmlresult = '') {
		if ($this -> headerinfosent) return '';
		$theme = $this -> GetPreference('theme','textmate');

		if ($this -> _cssactive) {
			$syntax = 'css';
		}
		if ($this -> _javascriptactive) {
			$syntax = 'javascript';
		}
		if ($this -> _phpactive) {
			$syntax = 'php';
		}
		if ($this -> _htmlactive) {
			$syntax = 'html';
		}
		if ($this -> _defaultactive){
			$syntax = $this -> GetPreference('mode','html');
		}

		$compression = $this -> GetPreference('use_uncompressed') ? '-uncompressed' : '';

		$header = '
		<link rel="stylesheet" type="text/css" href="' . $this -> GetModuleURLPath() . '/css/jquery-ui-1.8.16.custom.css" />
		<script src="' . $this -> GetModuleURLPath() . '/ace/src/ace' . $compression . '.js" type="text/javascript" charset="utf-8"></script>
		<script src="' . $this -> GetModuleURLPath() . '/ace/src/theme-' . $theme . $compression . '.js" type="text/javascript" charset="utf-8"></script>';

		if ($syntax != 'plain') {
			$header .= '
			<script src="' . $this -> GetModuleURLPath() . '/ace/src/mode-' . $syntax . $compression . '.js" type="text/javascript" charset="utf-8"></script>';
		}

		$this -> headerinfosent = true;
		return $header;
	}

	public function LazyLoadAdmin() {
		return true;
	}

	public function GetHeaderHTML() {
		$incdir = $this -> GetModuleURLPath();
		$tmpl = <<<EOT
	<script type="text/javascript" src="{$incdir}/js/functions.js"></script>
EOT;
		return $this -> ProcessTemplateFromData($tmpl);
	}
}
?>