//tag and cate
$(document).ready(function() {

    $(".tag-select-choose").select2({
        tags: true,
        tokenSeparators: [',']
    })
    $(".parent-select-choose").select2({
        placeholder: "Select a state",
        allowClear: true
    });
});

//content tiny
var editor_config = {
    path_absolute : "http://localhost/unimart/",
    selector: 'textarea.tinymce',
    relative_urls: false,
    plugins: [
    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars code fullscreen",
    "insertdatetime media nonbreaking save table directionality",
    "emoticons template paste textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect |fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    file_picker_callback : function(callback, value, meta) {
    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
    var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
    if (meta.filetype == 'image') {
        cmsURL = cmsURL + "&type=Images";
    } else {
        cmsURL = cmsURL + "&type=Files";
    }

    tinyMCE.activeEditor.windowManager.openUrl({
        url : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no",
        onMessage: (api, message) => {
        callback(message.content);
        }
    });
    tinyMCE.init({
        /* ... */
        fontsize_formats:
          "8pt 9pt 10pt 11pt 12pt 14pt 18pt 24pt 30pt 36pt 48pt 60pt 72pt 96pt",
      });
    }
};

tinymce.init(editor_config);
