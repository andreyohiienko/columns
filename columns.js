(function() {

    /**
     * Way to remove last directory in url
     *
     * @param  {string} url site address
     *
     * @return  {string} url withour last directory
     */
    function removeLastEl(url) {
        var str = url.substr(url.lastIndexOf('/') + 1) + '$';
        return url.replace( new RegExp(str), '' );
    }

    tinymce.create('tinymce.plugins.Columns', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the js-file is located.
         */
        init : function(ed, url) {
            url = removeLastEl(url);
            ed.addButton('row', {
                title : 'Add [row]',
                image : url + 'icons/row.svg',
                onclick : function() {
                    ed.selection.setContent('[row]<br>' + ed.selection.getContent() + '<br>[end]');
                }
            });

            ed.addButton('col', {
                title : 'Add [col]',
                image : url + 'icons/col.svg',
                onclick : function() {
                    ed.selection.setContent('[col]<br>'  + ed.selection.getContent() + '<br>[end]');
                }
            });
        },

        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl : function(n, cm) {
            return null;
        }
    });

    // Register plugin
    tinymce.PluginManager.add('columns', tinymce.plugins.Columns);
})();