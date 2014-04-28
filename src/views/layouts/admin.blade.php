<!DOCTYPE html>

<html>
    <head>
        {{HTML::style('packages/larapress/larapress/styles.css')}}
    </head>

    <body>
        <div id="page">
            <div id="sidebar">
                @foreach($packages as $package)
                {{HTML::link($package["admin_uri"], $package["name"])}}<br><br>
                @endforeach
            </div>

            <div id="main-content">
                @yield('content')
            </div>
        </div>


        <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
        <script type="text/javascript">
        function elFinderBrowser(field_name, url, type, win) {
            tinymce.activeEditor.windowManager.open({
                file: '<?php echo Config::get('larapress::setup.file_path'); ?>/elfinder/tinymce', // use an absolute path!
                title: 'elFinder 2.0',
                width: 900,
                height: 450,
                resizable: 'yes'
            }, {
                setUrl: function(url) {
                    win.document.getElementById(field_name).value = url;
                }
            });
            return false;
        }

        tinymce.init({
            selector: ".HTMLeditor",
            file_browser_callback: elFinderBrowser,
            theme: "modern",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | forecolor backcolor emoticons",
            image_advtab: true,
            templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
            ]
        });
        </script>
    </body>
</html>