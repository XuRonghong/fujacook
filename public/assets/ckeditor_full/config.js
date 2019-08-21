/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

    // config.filebrowserBrowseUrl = ckeditor_baseUrl+'/ckfinder/ckfinder.html';
    // config.filebrowserImageBrowseUrl = ckeditor_baseUrl+'/ckfinder/ckfinder.html?Type=Images';
    // config.filebrowserFlashBrowseUrl = ckeditor_baseUrl+'/ckfinder/ckfinder.html?Type=Flash';
    // config.filebrowserUploadUrl = ckeditor_baseUrl+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'; //可上傳一般檔案
    // config.filebrowserImageUploadUrl = ckeditor_baseUrl+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';//可上傳圖檔
    // config.filebrowserFlashUploadUrl = ckeditor_baseUrl+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';//可上傳Flash檔案


    // Remove some buttons provided by the standard plugins, which are
    // not needed in the Standard(s) toolbar.
    // config.removeButtons = 'Underline,Subscript,Superscript';

    // Toolbar configuration generated automatically by the editor based on config.toolbarGroups.
    // config.toolbar = [
    //     { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ /*'Source', '-',*/ 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
    //     { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
    //     { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
    //     { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
    //     { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
    //     { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
    //     { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
    //     { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
    //     '/',
    //     { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
    //     { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
    //     { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
    //     { name: 'others', items: [ '-' ] },
    //     { name: 'about', items: [ 'About' ] },
    // ];
    config.toolbar = 'Full';

    // Set the most common block elements.
    config.format_tags = 'p;h1;h2;h3;pre';

    // Simplify the dialog windows.
    config.removeDialogTabs = 'image:advanced;link:advanced';

// 介面語言，預設為 'en'
    config.language = 'zh-tw';
// 設定寬高
//     config.width = 400;
//     config.height = 400;
// 編輯器樣式，有三種：'kama'（預設）、'office2003'、'v2'
   /* config.skin = 'v2';
// 背景顏色
    config.uiColor = '#FFF';
// 工具欄（基礎'Basic'、全能'Full'、自定義）ckeditor/ckeditor.js
    config.toolbar = 'Basic';
    config.toolbar = 'Full';
// 這將配合：
    config.toolbar_Full = [
        ['Source','-','Save','NewPage','Preview','-','Templates'],
        ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
        ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
        ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
        '/',
        ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
        ['Link','Unlink','Anchor'],
        ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
        '/',
        ['Styles','Format','Font','FontSize'],
        ['TextColor','BGColor']
    ];
// 工具欄是否可以被收縮
    config.toolbarCanCollapse = true;
// 工具欄的位置
    config.toolbarLocation = 'top';// 可選：bottom
// 工具欄預設是否展開
    config.toolbarStartupExpanded = true;
// 取消 “拖拽以改變尺寸”功能 plugins/resize/plugin.js
    config.resize_enabled = false;
// 改變大小的最大高度
    config.resize_maxHeight = 3000;
// 改變大小的最大寬度
    config.resize_maxWidth = 3000;
// 改變大小的最小高度
    config.resize_minHeight = 250;
// 改變大小的最小寬度
    config.resize_minWidth = 750;
// 當提交包含有此編輯器的表單時，是否自動更新元素內的資料
    config.autoUpdateElement = true;
// 設定是使用絕對目錄還是相對目錄，為空為相對目錄
    config.baseHref = '';
// 編輯器的z-index值
    config.baseFloatZIndex = 10000;
// 設定快捷鍵
//     config.keystrokes = [
//         [ CKEDITOR.ALT   121 , 'toolbarFocus' ], // 獲取焦點
//         [ CKEDITOR.ALT   122 , 'elementsPathFocus' ], // 元素焦點
//         [ CKEDITOR.SHIFT   121 , 'contextMenu' ], // 文字選單
//         [ CKEDITOR.CTRL   90 , 'undo' ], // 撤銷
//         [ CKEDITOR.CTRL   89 , 'redo' ], // 重做
//         [ CKEDITOR.CTRL   CKEDITOR.SHIFT   90 , 'redo' ], //
//         [ CKEDITOR.CTRL   76 , 'link' ], // 連結
//         [ CKEDITOR.CTRL   66 , 'bold' ], // 粗體
//         [ CKEDITOR.CTRL   73 , 'italic' ], // 斜體
//         [ CKEDITOR.CTRL   85 , 'underline' ], // 下劃線
//         [ CKEDITOR.ALT   109 , 'toolbarCollapse' ]
//     ],
// 設定快捷鍵 可能與瀏覽器快捷鍵衝突 plugins/keystrokes/plugin.js.
//         config.blockedKeystrokes = [
//             CKEDITOR.CTRL   66 ,
//             CKEDITOR.CTRL   73 ,
//             CKEDITOR.CTRL   85
//         ],
// 設定編輯內元素的背景色的取值 plugins/colorbutton/plugin.js.
        config.colorButton_backStyle = {
            element : 'span',
            styles : { 'background-color' : '#(color)' }
        };
// 設定前景色的取值 plugins/colorbutton/plugin.js
// config.colorButton_colors =
// '000,800000,8B4513,2F4F4F,008080,000080,4B0082,696969,B22222,A52A2A,DAA520,006400,40E0D0,0000CD,800080,808080,F00,FF8C00,FFD700,008000,0FF,00F,EE82EE,A9A9A9,FFA07A,FFA500,FFFF00,00FF00,AFEEEE,ADD8E6,DDA0DD,D3D3D3,FFF0F5,FAEBD7,FFFFE0,F0FFF0,F0FFFF,F0F8FF,E6E6FA,FFF’;
// 是否在選擇顏色時顯示“其它顏色”選項 plugins/colorbutton/plugin.js
    config.colorButton_enableMore = false;
// 區塊的前景色預設值設定 plugins/colorbutton/plugin.js
    config.colorButton_foreStyle = {
        element : 'span',
        styles : { 'color' : '#(color)' }
    };
// 所需要新增的CSS檔案 在此新增 可使用相對路徑和網站的絕對路徑
    config.contentsCss = './contents.css';
// 文字方向
    config.contentsLangDirection = 'rtl'; // 從左到右
// CKeditor的配置檔案 若不想配置 留空即可
    CKEDITOR.replace( 'myfiled', { customConfig : './config.js' } );
// 介面編輯框的背景色 plugins/dialog/plugin.js
    config.dialog_backgroundCoverColor = 'rgb(255, 254, 253)'; // 可設定參考
    config.dialog_backgroundCoverColor = 'white'; // 預設
// 背景的不透明度 數值應該在：0.0～1.0 之間 plugins/dialog/plugin.js
    config.dialog_backgroundCoverOpacity = 0.5;
// 移動或者改變元素時 邊框的吸附距離 單位：畫素 plugins/dialog/plugin.js
    config.dialog_magnetDistance = 20;
// 是否拒絕本地拼寫檢查和提示 預設為拒絕 目前僅firefox和safari支援 plugins/wysiwygarea/plugin.js.
    config.disableNativeSpellChecker = true;
// 進行表格編輯功能 如：新增行或列 目前僅firefox支援 plugins/wysiwygarea/plugin.js
    config.disableNativeTableHandles = true; // 預設為不開啟
// 是否開啟 圖片和表格 的改變大小的功能 config.disableObjectResizing = true;
    config.disableObjectResizing = false; // 預設為開啟
// 設定HTML文件型別
    config.docType = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"' ;
// 是否對編輯區域進行渲染 plugins/editingblock/plugin.js
    config.editingBlock = true;
// 編輯器中回車產生的標籤
    config.enterMode = CKEDITOR.ENTER_P; // 可選：CKEDITOR.ENTER_BR或CKEDITOR.ENTER_DIV
// 是否使用HTML實體進行輸出 plugins/entities/plugin.js
    config.entities = true;
// 定義更多的實體 plugins/entities/plugin.js
    config.entities_additional = '#39'; // 其中#代替了&
// 是否轉換一些難以顯示的字元為相應的HTML字元 plugins/entities/plugin.js
    config.entities_greek = true;
// 是否轉換一些拉丁字元為HTML plugins/entities/plugin.js
    config.entities_latin = true;
// 是否轉換一些特殊字元為ASCII字元 如"This is Chinese: 漢語."轉換為"This is Chinese:
// 漢語." plugins/entities/plugin.js
    config.entities_processNumerical = false;
// 新增新元件
    config.extraPlugins = 'myplugin'; // 非預設 僅示例
// 使用搜尋時的高亮色 plugins/find/plugin.js
    config.find_highlight = {
        element : 'span',
        styles : { 'background-color' : '#ff0', 'color' : '#00f' }
    };
// 預設的字型名 plugins/font/plugin.js
    config.font_defaultLabel = 'Arial';
// 字型編輯時的字符集 可以新增常用的中文字元：宋體、楷體、黑體等 plugins/font/plugin.js
    config.font_names = 'Arial;Times New Roman;Verdana';
// 文字的預設式樣 plugins/font/plugin.js
    config.font_style = {
        element   : 'span',
        styles   : { 'font-family' : '#(family)' },
        overrides : [ { element : 'font', attributes : { 'face' : null } } ]
    };
// 字型預設大小 plugins/font/plugin.js
    config.fontSize_defaultLabel = '12px';
// 字型編輯時可選的字型大小 plugins/font/plugin.js
    config.fontSize_sizes ='8/8px;9/9px;10/10px;11/11px;12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;72/72px';
// 設定字型大小時 使用的式樣 plugins/font/plugin.js
    config.fontSize_style = {
        element   : 'span',
        styles   : { 'font-size' : '#(size)' },
        overrides : [ { element : 'font', attributes : { 'size' : null } } ]
    };
// 是否強制複製來的內容去除格式 plugins/pastetext/plugin.js
    config.forcePasteAsPlainText =false; // 不去除
// 是否強制用“&”來代替“&”plugins/htmldataprocessor/plugin.js
    config.forceSimpleAmpersand = false;
// 對address標籤進行格式化 plugins/format/plugin.js
    config.format_address = { element : 'address', attributes : { class : 'styledAddress' } };
// 對DIV標籤自動進行格式化 plugins/format/plugin.js
    config.format_div = { element : 'div', attributes : { class : 'normalDiv' } };
// 對H1標籤自動進行格式化 plugins/format/plugin.js
    config.format_h1 = { element : 'h1', attributes : { class : 'contentTitle1' } };
// 對H2標籤自動進行格式化 plugins/format/plugin.js
    config.format_h2 = { element : 'h2', attributes : { class : 'contentTitle2' } };
// 對H3標籤自動進行格式化 plugins/format/plugin.js
    config.format_h1 = { element : 'h3', attributes : { class : 'contentTitle3' } };
// 對H4標籤自動進行格式化 plugins/format/plugin.js
    config.format_h1 = { element : 'h4', attributes : { class : 'contentTitle4' } };
// 對H5標籤自動進行格式化 plugins/format/plugin.js
    config.format_h1 = { element : 'h5', attributes : { class : 'contentTitle5' } };
// 對H6標籤自動進行格式化 plugins/format/plugin.js
    config.format_h1 = { element : 'h6', attributes : { class : 'contentTitle6' } };
// 對P標籤自動進行格式化 plugins/format/plugin.js
    config.format_p = { element : 'p', attributes : { class : 'normalPara' } };
// 對PRE標籤自動進行格式化 plugins/format/plugin.js
    config.format_pre = { element : 'pre', attributes : { class : 'code' } };
// 用分號分隔的標籤名字 在工具欄上顯示 plugins/format/plugin.js
    config.format_tags = 'p;h1;h2;h3;h4;h5;h6;pre;address;div';
// 是否使用完整的html編輯模式 如使用，其原始碼將包含：<html><body></body></html>等標籤
    config.fullPage = false;
// 是否忽略段落中的空字元 若不忽略 則字元將以“”表示 plugins/wysiwygarea/plugin.js
    config.ignoreEmptyParagraph = true;
// 在清除圖片屬性框中的連結屬性時 是否同時清除兩邊的<a>標籤 plugins/image/plugin.js
    config.image_removeLinkByEmptyURL = true;
// 一組用逗號分隔的標籤名稱，顯示在左下角的層次巢狀中 plugins/menu/plugin.js.
    config.menu_groups ='clipboard,form,tablecell,tablecellproperties,tablerow,tablecolumn,table,anchor,link,image,flash,checkbox,radio,textfield,hiddenfield,imagebutton,button,select,textarea';
// 顯示子選單時的延遲，單位：ms plugins/menu/plugin.js
    config.menu_subMenuDelay = 400;
// 當執行“新建”命令時，編輯器中的內容 plugins/newpage/plugin.js
    config.newpage_html = '';
// 當從word裡複製文字進來時，是否進行文字的格式化去除 plugins/pastefromword/plugin.js
    config.pasteFromWordIgnoreFontFace = true; // 預設為忽略格式
// 是否使用<h1><h2>等標籤修飾或者代替從word文件中貼上過來的內容 plugins/pastefromword/plugin.js
    config.pasteFromWordKeepsStructure = false;
// 從word中貼上內容時是否移除格式 plugins/pastefromword/plugin.js
    config.pasteFromWordRemoveStyle = false;
// 對應後臺語言的型別來對輸出的HTML內容進行格式化，預設為空
//     config.protectedSource.push( /</?[/s/S]*?/?>/g );   // PHP Code
//     config.protectedSource.push( // g ); // ASP Code
//     config.protectedSource.push( /(] >[/s|/S]*?<// asp:[^/>] >)|(] //>)/gi ); //
// ASP.Net Code
// 當輸入：shift Enter時插入的標籤
    config.shiftEnterMode = CKEDITOR.ENTER_P; // 可選：CKEDITOR.ENTER_BR或CKEDITOR.ENTER_DIV
// 可選的表情替代字元 plugins/smiley/plugin.js.
    config.smiley_descriptions = [
        ':)', ':(', ';)', ':D', ':/', ':P',
        '', '', '', '', '', '',
        '', ';(', '', '', '', '',
        '', ':kiss', '' ];
// 對應的表情圖片 plugins/smiley/plugin.js
    config.smiley_images = [
        'regular_smile.gif','sad_smile.gif','wink_smile.gif','teeth_smile.gif','confused_smile.gif','tounge_smile.gif',
        'embaressed_smile.gif','omg_smile.gif','whatchutalkingabout_smile.gif','angry_smile.gif','angel_smile.gif','shades_smile.gif',
        'devil_smile.gif','cry_smile.gif','lightbulb.gif','thumbs_down.gif','thumbs_up.gif','heart.gif',
        'broken_heart.gif','kiss.gif','envelope.gif'];
// 表情的地址 plugins/smiley/plugin.js
    config.smiley_path = 'plugins/smiley/images/';
// 頁面載入時，編輯框是否立即獲得焦點 plugins/editingblock/plugin.js
// plugins/editingblock/plugin.js.
    config.startupFocus = false;
// 載入時，以何種方式編輯 原始碼和所見即所得 "source"和"wysiwyg" plugins/editingblock/plugin.js.
    config.startupMode ='wysiwyg';
// 載入時，是否顯示框體的邊框 plugins/showblocks/plugin.js
    config.startupOutlineBlocks = false;
// 是否載入樣式檔案 plugins/stylescombo/plugin.js.
    config.stylesCombo_stylesSet = 'default';
// 以下為可選
    config.stylesCombo_stylesSet = 'mystyles';
    config.stylesCombo_stylesSet = 'mystyles:/editorstyles/styles.js';
    config.stylesCombo_stylesSet = 'mystyles:http://www.example.com/editorstyles/styles.js';
// 起始的索引值
    config.tabIndex = 0;
// 當使用者鍵入TAB時，編輯器走過的空格數，( ) 當值為0時，焦點將移出編輯框 plugins/tab/plugin.js
    config.tabSpaces = 0;
// 預設使用的模板 plugins/templates/plugin.js.
    config.templates = 'default';
// 用逗號分隔的模板檔案plugins/templates/plugin.js.
    config.templates_files = [ 'plugins/templates/templates/default.js' ];
// 當使用模板時，“編輯內容將被替換”框是否選中 plugins/templates/plugin.js
    config.templates_replaceContent = true;
// 主題
    config.theme = 'default';
// 撤銷的記錄步數 plugins/undo/plugin.js
    config.undoStackSize =20;
// 在 CKEditor 中整合 CKFinder，注意 ckfinder 的路徑選擇要正確。
    CKFinder.SetupCKEditor(null, '/ckfinder/');*/
};
