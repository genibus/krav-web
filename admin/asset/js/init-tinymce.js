tinymce.init({
    selector: '#content',
    entities: '160,nbsp,162,cent,8364,euro,163,pound',
    entity_encoding: "raw",
    body_id: 'editeur',
    theme: 'modern',
    width: '100%',
    height: 300,
    relative_urls: false,
    remove_script_host: false,
    plugins: [
        'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
        'save table contextmenu directionality emoticons template paste textcolor responsivefilemanager code'
    ],
    content_css: 'asset/css/style.css',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
    toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
    image_advtab: true,
    //  CHANGER L'URL POUR VERSION EN LIGNE
    external_filemanager_path: "asset/js/tinymce/filemanager/",
    filemanager_title: "Responsive Filemanager",
    external_plugins: { "filemanager": "filemanager/plugin.min.js" }
});