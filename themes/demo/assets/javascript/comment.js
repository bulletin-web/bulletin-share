$(function () {
    if ($('div').hasClass('error'))
    {
        $('html, body').animate({
            scrollTop: $("button[type='reset']").offset().top
        });
    }
    if ($('div').hasClass('success'))
    {
        $('html, body').animate({
            scrollTop: $(".success").offset().top
        });
    }

    $("article").slice(0, 8).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $("article:hidden").slice(0, 8).slideDown();
        if ($("article:hidden").length == 0) {
            $("#load").fadeOut();
        }
        if (!$('article').filter(':hidden:first').next('article').length) {
            $('#loadMore').attr('style', 'display:none');
        }
    });

    // Configure/customize these variables.
    var showChar = 130;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "more &#8594;";
    var lesstext = "&#8592; less";


    $('.more').each(function() {
        var content = $(this).html();

        if(content.length > showChar) {

            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);

            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span style="display: none;">' + h + '</span>&nbsp;&nbsp;<a style="display:block;" href="" class="morelink text-primary">' + moretext + '</a></span>';

            $(this).html(html);
        }

    });

    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
    $('.fr-fil').parent().addClass('fr-fil');
    $('.fr-dib').parent().addClass('fr-dib');
    $('.fr-fir').parent().addClass('fr-fir');
});