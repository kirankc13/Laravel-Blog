/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	//config.language = 'fr';
	//config.uiColor = '#AADC6E';
	config.extraPlugins = 'uploadimage,youtube,embed,embedbase,autoembed,autolink,textmatch,image2,wordcount';
	config.youtube_responsive = true;
	config.embed_provider = '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}&api_key=1af0d03d1f77d1ea04ddbd'
	CKEDITOR.config.allowedContent = false;
};

CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'paragraph', groups: [ 'indent', 'list', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] }
	];
	config.removeButtons = 'Scayt,CopyFormatting,RemoveFormat,Flash,HorizontalRule,Smiley,SpecialChar,ShowBlocks,Save,NewPage,ExportPdf,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Form,Checkbox,Radio,TextField,Textarea,Select,Button,HiddenField,Replace,SelectAll,Font,FontSize,About,PageBreak,Anchor,Language,Strike,CreateDiv,BGColor,TextColor,Subscript,Superscript,Iframe,Outdent,Indent';
	config.extraPlugins = 'uploadimage,youtube,embed,embedbase,autoembed,autolink,textmatch,image2,wordcount,autogrow';
	config.height = 600;
	config.youtube_responsive = true;
	config.embed_provider = '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}'
	CKEDITOR.config.allowedContent = false;
};
