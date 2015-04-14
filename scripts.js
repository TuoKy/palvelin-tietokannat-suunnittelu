tinymce.init({
		selector:"textarea.Post",
        browser_spellcheck : false,
        height : 500,
		file_picker_callback: function(callback, value, meta) {
        // Provide file and text for the link dialog
        if (meta.filetype == 'file') {
            callback('mypage.html', {text: 'My text'});
        }

        // Provide image and alt text for the image dialog
        if (meta.filetype == 'image') {
            callback($('#my_form input').click(), {alt: 'Poistettu'});
        }
		},
        plugins: ["advlist image textcolor link hr paste preview print hr anchor",
                             "table contextmenu"],

		 relative_urls: false					 							 
        });
tinymce.init({
		selector:"textarea.Comment",
        browser_spellcheck : false,
        height : 200,						 							 
        });