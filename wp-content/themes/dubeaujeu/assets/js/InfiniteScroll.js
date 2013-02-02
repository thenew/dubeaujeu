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
        inf.url = new URI();

        // actions
        inf.scroll();
    },
    scroll: function() {
        var inf = this;
        var documentHeight, scrollY, clientHeight, elHeight;
        // if no scroll
        // if(documentHeight === clientHeight ) {
        //     clearTimeout(inf.timeOut);
        //     inf.timeOut = setTimeout(function() {
        //         if(!inf.inProgress && inf.paged+1 < inf.maxPaged)
        //             inf.loadMore();
        //     }, 100);
        // } else {

            $(window).addEvent('scroll',function(e){
                scrollY = window.getScroll().y;
                documentHeight = document.body.offsetHeight;
                clientHeight = document.documentElement.clientHeight;
                elHeight = inf.element.getHeight();
                // console.log('el '+ elHeight);
                // console.log(scrollY+clientHeight);

                // if(scrollY >= documentHeight - clientHeight - 100){
                if(elHeight - 200 <= scrollY+clientHeight){
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
        var request = new Request({
            url: '',
            method: 'get',
            data: {'ajax':'1', 'page': inf.paged+1},
            onRequest: function(){
                inf.loading();
            },
            onFailure: function(xhr){
                inf.maxPaged = inf.paged;
                inf.stopLoading();
            },
            onSuccess: function(response){
                if(response === "") {
                    // no more content
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
        var append = new Element('div', {'class': 'boxes'});
        append.set('html', response)
            .inject(inf.element);

        var dbjThumbs = Asset.images(append.getElements('img').get('src'), {
            onComplete: function(){
                inf.element.masonry({
                        appendedContent: inf.element.getElements('.boxes:last-child')[0],
                        columnWidth: 330,
                        itemSelector: '.box'
                    });
                inf.liffect(append);
                inf.paged++;
                // if hasPushState
                if(!!(window.history && history.pushState)) {
                    inf.url.set('directory', '/page/'+inf.paged);
                    // history.pushState('', '', inf.url.toString());
                }
                inf.stopLoading();
            }
        });
    },
    loading: function() {
        var inf = this;
        inf.inProgress = true;
        inf.element.addClass("loading");
        $('main-loader').addClass("loading");
    },
    stopLoading: function() {
        var inf = this;
        inf.element.removeClass("loading");
        $('main-loader').removeClass("loading");
        inf.inProgress = false;
    },
    liffect: function(el) {
        var inf = this;
        el.getElements(".el").each(function (el,i) {
            var delay = i*100;
            el.set("style", "-webkit-animation-delay:" + delay + "ms;"
                + "-moz-animation-delay:" + delay + "ms;"
                + "-o-animation-delay:" + delay + "ms;"
                + "animation-delay:" + delay + "ms;");
        });
        el.addClass('play');
    }
});