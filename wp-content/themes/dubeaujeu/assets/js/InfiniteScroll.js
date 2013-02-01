/**
  *
  * Infinite scroll
  *
  */

var InfiniteScroll = new Class({
    Implements: [Options,Events],
    options:{
    },
    initialize: function(element, options) {
        var inf = this;
        inf.element = $(element);
        if(!inf.element) return;
        // variables
        inf.setOptions(options);
        inf.paged = inf.element.get('data-paged').toInt();
        if(inf.paged < 1) inf.paged = 1;
        inf.maxPaged = 90000;
        inf.timeOut = 0;
        inf.inProgress = false;

        // actions
        inf.scroll();
    },
    scroll: function() {
        var inf = this;
        var totalHeight, currentScroll, visibleHeight;
            totalHeight = document.body.offsetHeight;
            visibleHeight = document.documentElement.clientHeight;
        // if no scroll
        // if(totalHeight === visibleHeight ) {
        //     clearTimeout(inf.timeOut);
        //     inf.timeOut = setTimeout(function() {
        //         if(!inf.inProgress && inf.paged+1 < inf.maxPaged)
        //             inf.loadMore();
        //     }, 100);
        // } else {

            $(window).addEvent('scroll',function(e){
                currentScroll = window.getScroll().y;
                totalHeight = document.body.offsetHeight;
                visibleHeight = document.documentElement.clientHeight;

                if(currentScroll >= totalHeight - visibleHeight - 100){
                    clearTimeout(inf.timeOut);
                    inf.timeOut = setTimeout(function() {
                        if(!inf.inProgress && inf.paged+1 < inf.maxPaged)
                            inf.loadMore();
                    }, 100);
                }
            });
        // }
    },
    loadMore: function() {
        var inf = this;
        var url = new URI();
        var sParam = url.getData('s');
        var request = new Request({
            url: '',
            method: 'get',
            data: {'ajax':'1', 'mode': 'infinitescroll', 'page': inf.paged+1},
            onRequest: function(){
                inf.inProgress = true;
                inf.loading();
            },
            onFailure: function(xhr){
                inf.inProgress = false;
                inf.maxPaged = inf.paged;
                inf.stopLoading();
            },
            onSuccess: function(response){
                if(response === "") {
                    // no more content
                    inf.inProgress = true;
                    inf.maxPaged = inf.paged;
                    inf.stopLoading();
                }else {
                    inf.reveal(response);
                }
            }
        }).send();
    },
    reveal: function(response) {
        var inf = this;
        var append = new Element('div', {'class': 'append', 'data-liffect': 'slideTop'});
        append.set('html', response)
            .inject(inf.element);

        var dbjThumbs = Asset.images(append.getElements('img'), {
            onComplete: function(){
                inf.element.masonry({
                        appendedContent: inf.element.getElements('.append:last-child')[0],
                        columnWidth: 330,
                        itemSelector: '.box'
                    });
                inf.liffect(append);
                inf.paged++;
                inf.stopLoading();
                inf.inProgress = false;
            }
        });
    },
    loading: function() {
        var inf = this;
        inf.element.addClass("loading");
    },
    stopLoading: function() {
        var inf = this;
        inf.element.removeClass("loading");
    },
    liffect: function(el) {
        var inf = this;
        inf.element.set('data-liffect', '');
        el.getElements(".li").each(function (el,i) {
            var delay = i*100;
            el.set("style", "-webkit-animation-delay:" + delay + "ms;"
                + "-moz-animation-delay:" + delay + "ms;"
                + "-o-animation-delay:" + delay + "ms;"
                + "animation-delay:" + delay + "ms;");
        });
        el.addClass('play');
    }
});