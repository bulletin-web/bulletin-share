$(function () {
    var $uploadCrop, url, title, path, viewport, width, height;
    viewport = {width: 200, height: 200};
    initCrop();
    $('#myModal').delegate('#basic-width, #basic-height', 'input', function () {
        width = parseInt($('.basic-width').val(), 10);
        height = parseInt($('.basic-height').val(), 10);
        if (width && height) {
            viewport = { width: width, height: height };
        }
        $uploadCrop.croppie('destroy');
        initCrop();
        bindCrop();
    });
    $('#MediaManager-manager-item-list')
        .delegate('tr[data-document-type="image"], li[data-document-type="image"]', 'click', function () {
            $('#resize_media').html('<button class="btn btn-primary">編集</button>');
            url = $(this).data('public-url');
            title = $(this).data('title');
            path = url.replace(title,'');
            $('#imgShow').html('<img style="width: 100%" class="img-responsive" src="'+ url +'">');
            $('#resize_media').delegate('button', 'click', function () {
                $('#myModal').find('#submit').removeAttr('disabled');
                $('.basic-width').val(200);
                $('.basic-height').val(200);
                viewport = {width: 200, height: 200};
                $uploadCrop.croppie('destroy');
                initCrop();
                bindCrop();
                $('#myModal').modal('show');
            });
        });
    $('#MediaManager-manager-item-list')
        .delegate('tr:not([data-document-type="image"]), li:not([data-document-type="image"])', 'click', function () {
            $('#resize_media').html('');
        });
    $('#myModal').delegate('#submit:not(:disabled)', 'click', function () {
        $('#myModal').find('#submit').attr('disabled', 'disabled');
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: viewport
        }).then(function (resp) {
            $.ajax({
                method: "POST",
                url: "/backend/cms/media/resizeImg",
                data: {imagebase64: resp, fileName: title, path: path}
            }).done(function () {
                $('#myModal').modal('hide');
                $('button[data-command="refresh"]').click();
            });
        });
    });
    function initCrop() {
        $uploadCrop = $('#upload-demo').croppie({
            viewport: viewport,
            boundary: {
                width: 500,
                height: 500
            },
            showZoomer: true
        });
    }
    function bindCrop() {
        $uploadCrop.croppie('bind', {
            url: url,
            // points: [0, 0, 280, 739]
        });
    }
})