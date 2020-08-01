(function( $ ) {
	'use strict';

	$(document).ready(function(){

		// ios style switch
		$('input.lc_switch').lc_switch();

		
		if( addonify_objects.color_picker_is_available ){
			// initiate wp color picker
			$('.color-picker').wpColorPicker();
		}


		if( addonify_objects.code_editor_is_available ){
			// code editor
			if( $('#addonify_qv_custom_css').length ) {
				var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
				editorSettings.codemirror = _.extend(
					{},
					editorSettings.codemirror,
					{
						indentUnit: 2,
						tabSize: 2
					}
				);
				var editor = wp.codeEditor.initialize( $('#addonify_qv_custom_css'), editorSettings );
			}
		}
	
	})

})( jQuery );
