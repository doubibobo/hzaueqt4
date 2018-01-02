$(function() {
    //***************************美图欣赏图片效果****************************
    $(".pitmainbox .pitbox").hover(function(){
        $(this).css({
            "box-shadow":"1px 4px 10px 2px #ccc",
            "transform":"translateY(-2%)",
            "-webkit-transition": "all 0.4s",
            "-moz-transition": "all 0.4s",
            "-ms-transition":" all 0.4s",
            "-o-transition": "all 0.4s",
            "transition":"all 0.4s"
        });
    },function(){
        $(this).css({
            "box-shadow":"",
            "transform":"",
            "-webkit-transition": "all 0.4s",
            "-moz-transition": "all 0.4s",
            "-ms-transition":" all 0.4s",
            "-o-transition": "all 0.4s",
            "transition":"all 0.4s"
        });
    });
    //***************************成果展示效果****************************
    $(".pitmainbox .pitbox").hover(function(){
        $(this).css({
            "box-shadow":"1px 4px 10px 2px #ccc",
            "transform":"translateY(-2%)",
            "-webkit-transition": "all 0.4s",
            "-moz-transition": "all 0.4s",
            "-ms-transition":" all 0.4s",
            "-o-transition": "all 0.4s",
            "transition":"all 0.4s"
        });
    },function(){
        $(this).css({
            "box-shadow":"",
            "transform":"",
            "-webkit-transition": "all 0.4s",
            "-moz-transition": "all 0.4s",
            "-ms-transition":" all 0.4s",
            "-o-transition": "all 0.4s",
            "transition":"all 0.4s"
        });
    });

    //***************************弹出框****************************
    //弹出
    $(".pitmainbox .pitbox").on('click', function () {
        $("body").append("<div id='mask'></div>");
        $("#mask").addClass("mask").fadeIn("slow");
        $(".alert_box").fadeIn("slow");
        $(".alert_box").children("img").attr('src',$(this).children("img")[0].src); 
    });
    //关闭
    $(".alert_box_close_btn").hover(function(){
        $(this).css({
            "transform":"rotate(-360deg)",
            "-webkit-transition": "all 0.8s",
            "-moz-transition": "all 0.8s",
            "-ms-transition":" all 0.8s",
            "-o-transition": "all 0.8s",
            "transition":"all 0.8s"
        });
    },function(){
        $(this).css({
            "transform":"",
            "-webkit-transition": "all 0.8s",
            "-moz-transition": "all 0.8s",
            "-ms-transition":" all 0.8s",
            "-o-transition": "all 0.8s",
            "transition":"all 0.8s"
        });
    });
    $(".alert_box_close_btn").hover(function () { $(this).css({ color: '#f0f0f0' }) }, function () { $(this).css({ color: '#fff' }) }).on('click', function () {
        $(".alert_box").fadeOut("fast");
        $("#mask").css({ display: 'none' });
    });
    
})