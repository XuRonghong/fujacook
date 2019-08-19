/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

    // config.language = 'fr';
    // config.uiColor = '#AADC6E';

    config.toolbar = [
        ['Bold','Italic','Underline','Strike','JustifyLeft','JustifyCenter','JustifyRight'],
        ['Image','Table','HorizontalRule','SpecialChar'],
        ['TextColor','BGColor','RemoveFormat','Font','FontSize','Source']
    ]

    config.filebrowserBrowseUrl = ckeditor_baseUrl+'/ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl = ckeditor_baseUrl+'/ckfinder/ckfinder.html?Type=Images';
    config.filebrowserFlashBrowseUrl = ckeditor_baseUrl+'/ckfinder/ckfinder.html?Type=Flash';
    config.filebrowserUploadUrl = ckeditor_baseUrl+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'; //可上傳一般檔案
    config.filebrowserImageUploadUrl = ckeditor_baseUrl+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';//可上傳圖檔
    config.filebrowserFlashUploadUrl = ckeditor_baseUrl+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';//可上傳Flash檔案

};
