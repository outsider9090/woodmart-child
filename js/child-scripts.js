jQuery(document).ready(function($) {

    $('.pp_like').click(function(e){
        e.preventDefault();
        var postid=$(this).data('id');
        var dataId = $(this).data('id');
        var data = {
            action: 'my_action',
            security : MyAjax.security,
            postid: postid
        };


        $('#loadingPanel'+postid).css('display', 'flex');
        $.ajax({
            url: MyAjax.ajaxurl,
            type: 'POST',
            data: data,
            //dataType: 'JSON',
            success: function (res) {
                var result=$.parseJSON( res );
                likes=result.likecount;
                if (result === 0){
                    Toastnotify.create({
                        text:"برای اینکار باید عضو سایت شوید!",
                        type:'dark',
                        duration : 5000,
                        important:true,
                        callbackOk:()=>{
                            location.href= jQuery('#url_redirect').data('url');
                        },
                        callbackCancel:()=>{
                            //console.log('Cancel');
                        }
                    });
                    $('#loadingPanel'+postid).css('display', 'none');
                    return;
                }
                if (result.is_liked === 1){
                    $('#pp_like'+dataId).find('i').removeClass('fa-heart-o').addClass('fa-heart heartBeat');
                    $('#pp_like'+dataId).find('span').removeClass().addClass('liked');
                    Toastnotify.create({
                        text:"نظر شما ثبت شد.",
                        type:'dark',
                        duration : 2000,
                        important:false,
                    });
                }else if(result.is_liked === 0){
                    $('#pp_like'+dataId).find('i').removeClass('fa-heart heartBeat').addClass('fa-heart-o');
                    $('#pp_like'+dataId).find('span').removeClass().addClass('notliked');
                    Toastnotify.create({
                        text:"نظر شما ثبت شد.",
                        type:'dark',
                        duration : 2000,
                        important:true,
                    });
                }
                $('#pp_like'+dataId).find('span').text(likes);
                //console.log(res);
            }, error:function (err) {
                // console.log(err);
            },complete:function () {
                $('#loadingPanel'+postid).css('display', 'none');
            }
        });
    });

    $('.like_btn').click(function(e){
        e.preventDefault();
        var postid=$(this).data('id');
        var data = {
            action: 'my_action',
            security : MyAjax.security,
            postid: postid
        };

        $('.article-cover').css('display', 'flex');
        $.ajax({
            url: MyAjax.ajaxurl,
            type: 'POST',
            data: data,
            success: function (res) {
                var result=$.parseJSON( res );
                likes=result.likecount;
                if (result === 0){
                    Toastnotify.create({
                        text:"برای اینکار باید عضو سایت شوید!",
                        type:'dark',
                        duration : 5000,
                        important:true,
                        callbackOk:()=>{
                            location.href= jQuery('#url_redirect').data('url');
                        },
                        callbackCancel:()=>{
                            // console.log('Cancel');
                        }
                    });
                    $('.article-cover').css('display', 'none');
                    return;
                }
                if (result.is_liked === 1){
                    $('.like_btn').find('i').removeClass('fa-heart-o').addClass('fa-heart heartBeat');
                    $('.like_btn').find('span').removeClass().addClass('sliked');
                    Toastnotify.create({
                        text:"نظر شما ثبت شد.",
                        type:'dark',
                        duration : 2000,
                        important:false,
                    });
                }else if(result.is_liked === 0){
                    $('.like_btn').find('i').removeClass('fa-heart heartBeat').addClass('fa-heart-o');
                    $('.like_btn').find('span').removeClass().addClass('snotliked');
                    Toastnotify.create({
                        text:"نظر شما ثبت شد.",
                        type:'dark',
                        duration : 2000,
                        important:true,
                    });
                }
                $('.like_btn').find('span').text(likes);
                // console.log(res);
            }, error:function (err) {
                // console.log(err);
            },complete:function () {
                $('.article-cover').css('display', 'none');
            }
        });
    });


    // Custom tooltip //
    function placeTooltip(x_pos, y_pos) {
        $("#tooltip").css({
            top: y_pos-70 + 'px',
            left: x_pos-30 + 'px',
            position: 'absolute'
        });
    }
    $('.woodmart-entry-content').find('p').mouseup(function (e) {
        var selection = window.getSelection().toString();
        $('p#selTxt').val(selection.toString());
        var x = e.pageX;
        var y = e.pageY;
        placeTooltip(x, y);
        if (selection.length > 1){
            $("#tooltip").show();
        } else {
            $('div#tooltip').css('display', 'none');
        }
    });
    $('#twitter_intent').click(function (e) {
        e.preventDefault();
       var share_txt = 'https://twitter.com/intent/tweet?text='+$('p#selTxt').val()+' \n '+$('#short_link').val();
        window.open(share_txt, '_blank', 'width=700,height=500');
        //$('div#tooltip').css('display', 'none');
        return false;
    });
    // $('#facebook_intent').click(function (e) {
    //     e.preventDefault();
    //     var share_txt = 'https://www.facebook.com/dialog/share?app_id=1838554979696051&display=popup&quote='
    //         +$('p#selTxt').val()+'&href='+$('#short_link').val();
    //     window.open(share_txt, '_blank', 'width=700,height=500');
    //     return false;
    // });
    // Custom tooltip //


});


document.onscroll = function(){
    var pos = getVerticalScrollPercentage(document.body);
    document.getElementById("scroll-bar").style.width = pos+'%';
};
function getVerticalScrollPercentage( elm ){
    var p = elm.parentNode,
        pos = (elm.scrollTop || p.scrollTop) / (p.scrollHeight - p.clientHeight ) * 100;
    return pos;
}




