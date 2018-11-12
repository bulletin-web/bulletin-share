$( document ).ready(function() {
    $('#post-content').val('');

    $('.btn.save').click(function () {
        var content = '';
        var contentJson = [];
        var contentValid = false;
        $('.dropped-element').each(function (index) {
            switch($(this).data('type')) {
                case 'html':
                    if ($(this).text() !== '') {
                        var htmlObject = {};
                        htmlObject['type'] = 'html';
                        contentValid = true;
                        var textHtml = $.trim($(this).text());

                        content += textHtml;
                        htmlObject['content'] = textHtml;

                        contentJson.push({'html': htmlObject});
                    }
                    break;
                case 'paragraph':
                    if ($(this).val() !== '') {
                        var paraObj = {};
                        paraObj['type'] = 'paragraph';

                        contentValid = true;
                        content += '<p>' + $(this).val() + '</p>';
                        paraObj['content'] = $(this).val();

                        contentJson.push({'paragraph': paraObj});
                    }

                    break;
                case 'from-media':
                    if ($(this).val() !== '') {
                        var mediaObj = {};
                        mediaObj['type'] = 'from-media';

                        contentValid = true;
                        content += '<p>' + $(this).val() + '</p>';
                        mediaObj['content'] = $(this).val();

                        contentJson.push({'from-media': mediaObj});
                    }

                    break;
                case 'table':
                    var hasContent = false;
                    $(this).find('tbody tr input').each(function () {
                        if ($(this).val().trim() !== '') {
                            hasContent = true;
                            contentValid = true;
                        }
                    });

                    if (hasContent) {
                        var tableObj = {};
                        tableObj['type'] = 'table';
                        var rows = $(this).find('tbody tr').length;
                        var cols = $(this).find('tbody tr:first td').length;
                        tableObj['rows'] = rows;
                        tableObj['cols'] = cols;

                        var tableTxt = '<table style="width: 100%"><tbody>';
                        $(this).find('tr').each(function (i) {
                            tableTxt += '<tr>';
                            $(this).find('td').each(function (j) {
                                var cellVal = $(this).find('input').val();
                                tableTxt += '<td>' + cellVal + '</td>';
                                tableObj['cell_' + i + '_' + j] = cellVal;
                            });
                            tableTxt += '</tr>';
                        });

                        tableTxt += '</tbody></table>';
                        content += tableTxt;

                        contentJson.push({'table': tableObj});
                    }

                    break;
                case 'quote':
                    if ($(this).val() !== '') {
                        var quoteObj = {};
                        quoteObj['type'] = 'quote';

                        contentValid = true;
                        content += '<blockquote>' + $(this).val() + '</blockquote>';
                        quoteObj['content'] = $(this).val();

                        contentJson.push({'quote': quoteObj});
                    }
                    break;
                case 'separation':
                    var separationObj = {};
                    separationObj['type'] = 'separation';
                    content += '<hr>';
                    contentJson.push({'separation': separationObj});
                    break;
                case 'image':
                    var srcImg = $(this).find('img').attr('src').trim();
                    if (srcImg !== "") {
                        var imgObj = {};
                        imgObj['type'] = 'image';

                        contentValid = true;
                        content += '<div style="text-align: center"><img src="' + srcImg + '" alt="" style="width: 100%;  margin-left: auto;  margin-right: auto;"></div>';
                        imgObj['src'] = srcImg;

                        contentJson.push({'image': imgObj});
                    }

                    break;
                case 'video':
                    var srcVideo = $(this).find('video').attr('src').trim();
                    if (srcVideo !== "") {
                        var videoObj = {};
                        videoObj['type'] = 'video';

                        contentValid = true;
                        content += '<div style="text-align: center"><video width="100%" src="'+ srcVideo +'" controls="">' +
                            '<div class="panel media-player-fallback">Your browser doesn\'t support HTML5 video.</div>' +
                            '</video></div>';
                        videoObj['src'] = srcVideo;

                        contentJson.push({'video': videoObj});
                    }

                    break;
                case 'list':
                    if ($(this).find('ul li.listItem:first textarea').val() !== '') {
                        var listObj = {};
                        listObj['type'] = 'list';

                        contentValid = true;
                        listObj['number'] = $(this).find('ul li.listItem').length;
                        var listTxt = '<ul style = "list-style: circle; padding-left: 20px;">';
                        $(this).find('ul li.listItem').each(function (i) {
                            var liContent = $(this).find('textarea').val();
                            listTxt += '<li>'+ liContent +'</li>';
                            listObj['li_' + i] = liContent;
                        });
                        listTxt += '</ul>';
                        content += listTxt;

                        contentJson.push({'list': listObj});
                    }

                    break;
                case 'qa':
                    if ($(this).find('ul li.listItem:first textarea').val() !== '') {
                        var qaObj = {};
                        qaObj['type'] = 'qa';

                        contentValid = true;
                        qaObj['number'] = $(this).find('ul li.listItem').length;
                        var qaTxt = '<ul style = "list-style: none;" class="faq-content">';
                        $(this).find('ul li.listItem').each(function (i) {
                            var liContent = $(this).find('textarea').val();
                            qaTxt += '<li>'+ liContent +'</li>';
                            qaObj['li_' + i] = liContent;
                        });
                        qaTxt += '</ul>';
                        content += qaTxt;

                        contentJson.push({'qa': qaObj});
                    }

                    break;
                case 'interview':
                    if ($(this).find('ul li.listItem:first textarea').val() !== '') {
                        var interviewObj = {};
                        interviewObj['type'] = 'interview';

                        contentValid = true;
                        interviewObj['number'] = $(this).find('ul li.listItem').length;
                        var interviewTxt = '<ul style = "list-style: none;" class="interview-content">';
                        $(this).find('ul li.listItem').each(function (i) {
                            var liContent = $(this).find('textarea').val();
                            interviewTxt += '<li>'+ liContent +'</li>';
                            interviewObj['li_' + i] = liContent;
                        });
                        interviewTxt += '</ul>';
                        content += interviewTxt;

                        contentJson.push({'interview': interviewObj});
                    }

                    break;
            }
        });

        if (contentValid) {
            $('#post-content').val(content);
            $('#post-content-json').val(JSON.stringify(contentJson));
        }

        $
    });

    if($('.btn-show').length && $('#left .table-wrap').length) {
        $('.btn-show').click(function() {
            $(this).hide();
            if($('#left .table-wrap').hasClass('hideItem')) {
                $('#left .table-wrap').removeClass('hideItem');
            }
            $('#left .table-wrap').toggleClass('show');
            $('.btn-hide').show();
        });
    }

    if($('.btn-hide').length && $('#left .table-wrap').length) {
        $('.btn-hide').click(function() {
            $(this).hide();
            if($('#left .table-wrap').hasClass('show')) {
                $('#left .table-wrap').removeClass('show');
            }
            $('#left .table-wrap').toggleClass('hideItem');
            $('.btn-show').show();
        });
    }

    var sticky = $('#sticky-drags');
    var top = sticky.offset().top;

    $(window).scroll(function() {
        if ($(this).scrollTop() >= 250) {
            $('#return-to-top').fadeIn(200);
        } else {
            $('#return-to-top').fadeOut(200);
        }

        if ($(this).scrollTop() >= top) {
            sticky.css(
                {
                    position: 'fixed',
                    top: 15 + 'px',
                    width: sticky.parent().width() + 'px'
                }
            );
        } else {
            sticky.attr('style', '');
        }
    });
    $('#return-to-top').click(function() {
        $('body,html').animate({
            scrollTop : 0
        }, 500);
    });
});

function addItem(event, element) {
    event.preventDefault();
    $('<li class="listItem"><textarea class="form-control textareaClone" rows="1"></textarea></li>')
        .insertAfter($(element).parent().find('ul li.listItem:last'));
    replaceEditor('textarea.textareaClone');
    $('#tblEditor').find('textarea.textareaClone').removeClass('textareaClone');
    return false;

}

function removeItem(event, element) {
    event.preventDefault();

    var number = $(element).parent().find('li.listItem').length;
    if (number > 1) {
        $(element).parent().find('li.listItem:last').remove();
    }

    return false;
}

function addItemSpec(event, element) {
    event.preventDefault();
    $('<li class="listItem"><textarea class="form-control textareaClone" rows="1"></textarea></li><li class="listItem"><textarea class="form-control textareaClone" rows="1"></textarea></li>')
        .insertAfter($(element).parent().find('ul li.listItem:last'));
    replaceEditor('textarea.textareaClone');
    $('#tblEditor').find('textarea.textareaClone').removeClass('textareaClone');

    return false;
}

function removeItemSpec(event, element) {
    event.preventDefault();

    var number = $(element).parent().find('li.listItem').length;
    console.log(number);
    if (number > 2) {
        $(element).parent().find('li.listItem').slice(-2).remove();
    }

    return false;
}
function Preview(){
    getContentdata();
    var dataForm = $('form').serializeArray();
    var tags ='';
    $( "#parentTagDisplay span" ).each(function( index ) {
        if ($( this ).attr('style').indexOf('#ffffff') != -1) {
            tags =tags +'<a class="tag btn btn-default btn_tag" data-color="'+ $( this ).data("color") +'">'+$( this ).text()+'</a><a style="margin-right: 3px;"></a>';
        }
    });
    var imgPath = $('.upload-files-container .upload-object.is-success').data('path');
    localStorage.setItem('dataForm', JSON.stringify(dataForm));
    localStorage.setItem('tags', tags);
    localStorage.setItem('imgPath', imgPath);
    window.open('/blog/post/preview','PoP_Up','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=5000,height=5000');
}
function getContentdata() {
    var content = '';
    var contentJson = [];
    var contentValid = false;
    $('.dropped-element').each(function (index) {
        switch($(this).data('type')) {
            case 'html':
                if ($(this).text() !== '') {
                    var htmlObject = {};
                    htmlObject['type'] = 'html';
                    contentValid = true;
                    var textHtml = $.trim($(this).text());

                    content += textHtml;
                    htmlObject['content'] = textHtml;

                    contentJson.push({'html': htmlObject});
                }
                break;
            case 'paragraph':
                if ($(this).val() !== '') {
                    var paraObj = {};
                    paraObj['type'] = 'paragraph';

                    contentValid = true;
                    content += '<p>' + $(this).val() + '</p>';
                    paraObj['content'] = $(this).val();

                    contentJson.push({'paragraph': paraObj});
                }

                break;
            case 'from-media':
                if ($(this).val() !== '') {
                    var mediaObj = {};
                    mediaObj['type'] = 'from-media';

                    contentValid = true;
                    content += '<p>' + $(this).val() + '</p>';
                    mediaObj['content'] = $(this).val();

                    contentJson.push({'from-media': mediaObj});
                }

                break;
            case 'table':
                var hasContent = false;
                $(this).find('tbody tr input').each(function () {
                    if ($(this).val().trim() !== '') {
                        hasContent = true;
                        contentValid = true;
                    }
                });

                if (hasContent) {
                    var tableObj = {};
                    tableObj['type'] = 'table';
                    var rows = $(this).find('tbody tr').length;
                    var cols = $(this).find('tbody tr:first td').length;
                    tableObj['rows'] = rows;
                    tableObj['cols'] = cols;

                    var tableTxt = '<table style="width: 100%"><tbody>';
                    $(this).find('tr').each(function (i) {
                        tableTxt += '<tr>';
                        $(this).find('td').each(function (j) {
                            var cellVal = $(this).find('input').val();
                            tableTxt += '<td>' + cellVal + '</td>';
                            tableObj['cell_' + i + '_' + j] = cellVal;
                        });
                        tableTxt += '</tr>';
                    });

                    tableTxt += '</tbody></table>';
                    content += tableTxt;

                    contentJson.push({'table': tableObj});
                }

                break;
            case 'quote':
                if ($(this).val() !== '') {
                    var quoteObj = {};
                    quoteObj['type'] = 'quote';

                    contentValid = true;
                    content += '<blockquote>' + $(this).val() + '</blockquote>';
                    quoteObj['content'] = $(this).val();

                    contentJson.push({'quote': quoteObj});
                }
                break;
            case 'separation':
                var separationObj = {};
                separationObj['type'] = 'separation';
                content += '<hr>';
                contentJson.push({'separation': separationObj});
                break;
            case 'image':
                var srcImg = $(this).find('img').attr('src').trim();
                if (srcImg !== "") {
                    var imgObj = {};
                    imgObj['type'] = 'image';

                    contentValid = true;
                    content += '<div style="text-align: center"><img src="' + srcImg + '" alt="" style="width: 100%;  margin-left: auto;  margin-right: auto;"></div>';
                    imgObj['src'] = srcImg;

                    contentJson.push({'image': imgObj});
                }

                break;
            case 'video':
                var srcVideo = $(this).find('video').attr('src').trim();
                if (srcVideo !== "") {
                    var videoObj = {};
                    videoObj['type'] = 'video';

                    contentValid = true;
                    content += '<div style="text-align: center"><video width="100%" src="'+ srcVideo +'" controls="">' +
                        '<div class="panel media-player-fallback">Your browser doesn\'t support HTML5 video.</div>' +
                        '</video></div>';
                    videoObj['src'] = srcVideo;

                    contentJson.push({'video': videoObj});
                }

                break;
            case 'list':
                if ($(this).find('ul li.listItem:first textarea').val() !== '') {
                    var listObj = {};
                    listObj['type'] = 'list';

                    contentValid = true;
                    listObj['number'] = $(this).find('ul li.listItem').length;
                    var listTxt = '<ul style = "list-style: circle; padding-left: 20px;">';
                    $(this).find('ul li.listItem').each(function (i) {
                        var liContent = $(this).find('textarea').val();
                        listTxt += '<li>'+ liContent +'</li>';
                        listObj['li_' + i] = liContent;
                    });
                    listTxt += '</ul>';
                    content += listTxt;

                    contentJson.push({'list': listObj});
                }

                break;
            case 'qa':
                if ($(this).find('ul li.listItem:first textarea').val() !== '') {
                    var qaObj = {};
                    qaObj['type'] = 'qa';

                    contentValid = true;
                    qaObj['number'] = $(this).find('ul li.listItem').length;
                    var qaTxt = '<ul style = "list-style: none;" class="faq-content">';
                    $(this).find('ul li.listItem').each(function (i) {
                        var liContent = $(this).find('textarea').val();
                        qaTxt += '<li>'+ liContent +'</li>';
                        qaObj['li_' + i] = liContent;
                    });
                    qaTxt += '</ul>';
                    content += qaTxt;

                    contentJson.push({'qa': qaObj});
                }

                break;
            case 'interview':
                if ($(this).find('ul li.listItem:first textarea').val() !== '') {
                    var interviewObj = {};
                    interviewObj['type'] = 'interview';

                    contentValid = true;
                    interviewObj['number'] = $(this).find('ul li.listItem').length;
                    var interviewTxt = '<ul style = "list-style: none;" class="interview-content">';
                    $(this).find('ul li.listItem').each(function (i) {
                        var liContent = $(this).find('textarea').val();
                        interviewTxt += '<li>'+ liContent +'</li>';
                        interviewObj['li_' + i] = liContent;
                    });
                    interviewTxt += '</ul>';
                    content += interviewTxt;

                    contentJson.push({'interview': interviewObj});
                }

                break;
        }
    });

    if (contentValid) {
        $('#post-content').val(content);
        $('#post-content-json').val(decodeEntities(JSON.stringify(contentJson)));
    }
}