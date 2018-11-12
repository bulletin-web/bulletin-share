$(function() {
    replaceEditor('.textarea');
    replaceEditor('.from_media');
    resizeWindow();
    $(window).resize(function () {
        resizeWindow();
    });
    scrollWindow();
    $(window).scroll(function () {
        scrollWindow();
    });
});

function replaceEditor(textarea) {
    var toolbarButtons;
    toolbarButtons = [
        'bold',
        'italic',
        'underline',
        'strikeThrough',
        'subscript',
        'superscript',
        'fontSize', '|',
        'color',
        'paragraphFormat',
        'align',
        'formatOL',
        'formatUL',
        'outdent',
        'indent',
        'quote',
        'insertTable',
        'undo',
        'redo',
        'insertImage',
        'insertFile',
        'insertLink',
        'html'
    ];

    if (textarea === '.from_media') {
        toolbarButtons = [
            'insertImage'
        ];
    }

    $('#tblEditor').find(textarea).froalaEditor({
        language: 'ja',
        toolbarButtons: toolbarButtons,
        placeholderText: false,
        imageUploadURL: '/backend/cms/media/uploadImg',
        imageEditButtons: ['imageDisplay', 'imageAlign', 'imageRemove'],
        imageDefaultWidth: 500,
        fileAllowedTypes: 	['video/mp4', 'video/webm', 'video/ogg'],
        fileInsertButtons: ['fileUpload', 'fileByURL'],
        fileUploadURL: '/backend/cms/media/uploadVideo',
        fileMaxSize: 1024 * 1024 * 1000
    });

    $('#tblEditor').find('.icon-file-o').removeClass('icon-file-o').addClass('icon-video-camera');
    hiddenItemOfEditor();

    $('#tblEditor .redips-drag').find('div').addClass('redips-nodrag');

    $('#tblEditor').find('.fr-element').bind('DOMNodeInserted', function() {
        if ($('#tblEditor').find('.fr-element').find('a.fr-file').length > 0) {
            var url = "https://www.youtube.com/watch?v=";
            var media = $('#tblEditor').find('.fr-element').find('a.fr-file');
            var href = media.attr('href');
            href = href.replace(url, 'https://www.youtube.com/embed/');
            media.replaceWith('<iframe width="560" height="315" src="'+href+'" frameborder="0" allowfullscreen=""></iframe>');
            media.remove();
        }
    });
}

function resizeWindow() {
    if ($(window).height() < 730) {
        $('#left').addClass('scroll-menu');
    } else {
        $('#left').removeClass('scroll-menu');
    }
    hiddenItemOfEditor();
}

function scrollWindow() {
    if ($(window).scrollTop() > 240) {
        $('#left').addClass('scroll-top');
    }  else {
        $('#left').removeClass('scroll-top');
    }
    hiddenItemOfEditor();
}

function hiddenItemOfEditor() {
    $('#tblEditor').find('.fa-rotate-left').parent().attr('style', 'display: none !important');
    $('#tblEditor').find('.fa-rotate-right').parent().attr('style', 'display: none !important');
    $('#tblEditor').find('.fa-file-o').parent().attr('style', 'display: none !important');
    $('#tblEditor').find('button[id^=insertVideo-]').attr('style', 'display: none !important');
}