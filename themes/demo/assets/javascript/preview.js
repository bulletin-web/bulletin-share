$(function () {
    var dataForm = localStorage.getItem('dataForm');
    var tags = localStorage.getItem('tags');
    var imgPath = localStorage.getItem('imgPath');
    var title = document.title;
    if (!dataForm) {
        window.location.href = "/";
        return;
    }

    dataForm = JSON.parse(dataForm);

    $('div.tag-list').html(tags);

    $.each(dataForm, function( index, value ) {
        if(value.name == 'Post[title]'){
            $('.post-main h3.title').html(value.value);
            $(document).attr('title', title + ' ' + value.value);
        }
        if(value.name =='Post[content]'){
            $('.post-main .post-content').html(value.value);
        }
    });
    $('.post-main > img').attr('src', imgPath);
    localStorage.clear();
    $('.fr-fil').parent().addClass('fr-fil');
    $('.fr-dib').parent().addClass('fr-dib');
    $('.fr-fir').parent().addClass('fr-fir');
});