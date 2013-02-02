window.addEvent('domready',function(){

    if($('du-beau-jeu')){
        var el = $('du-beau-jeu');
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
                var infiniteScroll = new InfiniteScroll('du-beau-jeu');
            }
        });
    }

    $$("[data-liffect] .el").each(function (el,i) {
        var delay = (i*100)+200;
        el.set("style", "-webkit-animation-delay:" + delay + "ms;"
            + "-moz-animation-delay:" + delay + "ms;"
            + "-o-animation-delay:" + delay + "ms;"
            + "animation-delay:" + delay + "ms;");
    });

});
