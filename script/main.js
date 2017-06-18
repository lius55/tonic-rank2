//NAVIGATION OPEN

$(function() {
    var trigger = $('.menu-trigger');
    var nav = $("nav");

    trigger.on("click", function(e) {
        event.preventDefault();
        $(this).toggleClass('active');
        nav.toggleClass('active');
    });
});


//PAGE TOP

$(function() {
    //ページトップ表示
    $("#pageTOP").hide();
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $("#pageTOP").fadeIn();
        } else {
            $("#pageTOP").fadeOut();
        }
    });
    //ページトップホバー画像変更
    $('#pageTOP img').hover(function() {
        $(this).attr('src', $(this).attr('src').replace('_off', '_on'));
    }, function() {
        $(this).attr('src', $(this).attr('src').replace('_on', '_off'));
    });
    //SMOOTH SCROLL
    $('#pageTOP a[href^="#"]').click(function() {
        var speed = 500;
        var href = $(this).attr("href");
        var target = $(href == "#" || href == "" ? 'html' : href);
        var position = target.offset().top;
        $("html, body").animate({ scrollTop: position }, speed, "swing");
        return false;
    });
});


//SCROLLBAR

$(function() {
    $(window).load(function() {
        $(".kuchikomi-inner").mCustomScrollbar({
            scrollInertia: 0, //スクロール加速度 OSデフォルトと異なると使いにくいので0
            mouseWheelPixels: 50, //スクロール量 デフォルトに近づけた。お好みで変更
            autoHideScrollbar: false, //マウスオーバーしていないときにスクロールバーを隠すか お好みで

            scrollButtons: {
                enable: true, //ボタンを出すか。個人的には不要（falseにしたら以下は指定不要）
                scrollType: "continuous", //ボタンを押してる間だけ進む
                scrollSpeed: 50, //ボタンのスクロールスピード OSデフォルトに近いづけた。お好みで変更
                scrollAmount: 50 //ボタンのスクロール量 OSデフォルトに近いづけた。お好みで変更
            },
            advanced: {
                updateOnContentResize: true, //自動的にスクロールバーを調整してくれる
                autoScrollOnFocus: true //フォーカスした場所にスクロールしてくれる
            }
        });
    });
});
