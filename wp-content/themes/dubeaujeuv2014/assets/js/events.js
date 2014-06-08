window.addEvent('domready',function(){

    // set delay in .box
    $$("[data-liffect] .box").each(function (el,i) {
        var delay = i*300-20;
        el.set("style", "-webkit-animation-delay:" + delay + "ms;" +
            "animation-delay:" + delay + "ms;");
    });

    // mask content during loading assets and play on complete
    if($('js-illustrations-page')){
        var el = $('js-illustrations-page');
        el.addClass('loading');
        var dbjThumbs = Asset.images(el.getElements('img').get('src'), {
            onComplete: function(){
                el.removeClass('loading');
                el.masonry({
                    columnWidth: 330,
                    itemSelector: '.box'
                });
                el.addClass('loaded');
                el.getElements('.boxes')[0].addClass('play');
                var infiniteScroll = new InfiniteScroll('js-illustrations-page');
            }
        });
    }


    // popinTrigger($$('.popin-trigger'));

    // $$('.fon-popin-trigger').each(function(el,i){
    //     var fonPopin = FonPopin(el);
    // });

    // heartLike($$('.heart'));

});
