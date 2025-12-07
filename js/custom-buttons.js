
(function() {
    tinymce.PluginManager.add('custom_color_buttons', function(editor, url) {
        // Add Color 1 button
        editor.addButton('color3_button', {
            icon: 'color3-icon',
            tooltip: 'Color 3',
            onclick: function() {
                editor.execCommand('mceApplyTextcolor', 'forecolor', '');
                editor.formatter.apply('custom-color3');
            }
        });
       
        // Add Color 2 button
        editor.addButton('color2_button', {
            icon: 'color2-icon',
            tooltip: 'Color 2',
            onclick: function() {
                editor.execCommand('mceApplyTextcolor', 'forecolor', '');
                editor.formatter.apply('custom-color2');
            }
        });
       
        // Add Text H5 button
        editor.addButton('texth5_button', {
            icon: 'texth5-icon',
            tooltip: 'Text H5',
            onclick: function() {
                editor.execCommand('mceApplyTextcolor', 'forecolor', '');
                editor.formatter.apply('custom-texth5');
            }
        });
       
        // Register custom formats
        editor.on('init', function() {
            editor.formatter.register({
                'custom-color3': {
                    inline: 'span',
                    classes: 'text-color-3',
                    remove: 'all'
                },
                'custom-color2': {
                    inline: 'span',
                    classes: 'text-color-2',
                    remove: 'all'
                },
                'custom-texth5': {
                    inline: 'span',
                    classes: 'text-h5',
                    remove: 'all'
                }
            });
        });
    });
})();