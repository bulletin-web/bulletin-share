jQuery( function($){
    $('.textOverFlow').each(function(){
        $(window).on('resize', function() {
            var w = $(window).width();
            if (w < 544) {
                wMode = 1;
            } else if (w < 768) {
                wMode = 2;
            } else if (w < 992) {
                wMode = 3;
            } else if (w < 1200) {
                wMode = 4;
            } else {
                wMode = 5;
            }
            if (3 > wMode) {
                $('header').removeClass('textOverFlow');
            }
        });
        var $target = $(this);

        // オリジナルの text を取得
        var text = $target.html();

        // 対象の要素を、高さを auto に指定して非表示で複製
        var $clone = $target.clone();
        $clone.css({
            display:	'none',
            position:	'absolute',
            overflow:	'visible'
        })
            .width($target.width())
            .height('auto');

        // DOM を一旦追加
        $target.after($clone);

        // 指定した高さになるまで1文字づつ削除
        while((text.length > 0) && ($clone.height() > $target.height())){
            text = text.substr(0, text.length -1);
            $clone.html(text + '...');
        }

        // text を入れ替えて、複製した要素を削除
        $target.html($clone.html());
        $clone.remove();
    });
});