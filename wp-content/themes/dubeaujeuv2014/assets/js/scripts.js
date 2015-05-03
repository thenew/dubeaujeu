jQuery(window).load(function(e){

    mobs();

    // mask content during loading assets and play on complete
/*    if($('js-illustrations-page')){
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
                el.getElements('.boxes')[0].getElements('.box').each(function(el,i) {
                    var delay = i*300-20;
                    setTimeout(function() {
                        el.addClass('play');
                    }, delay);
                });
                var infiniteScroll = new InfiniteScroll('js-illustrations-page');
            }
        });
    }*/

    // js-toggle-zoom
    /*$$('.js-toggle-zoom').each(function(el) {
        el.addEvent('click', function(e) {
            e.preventDefault();
            el.toggleClass('is-zoomed');
        });
    });*/


});
