function popinTrigger(els) {
    els.each(function(el,i){
        el.addEvent('click', function(e){
            var link = this;
            e.stop();
            var request = new Request({
                url: link.get('href'),
                method: 'get',
                data: {'ajax':'1'},
                onRequest: function(){
                    link.addClass('loading');
                },
                onSuccess: function(response){
                    var popin = new Element('div', {'id': 'popin'});
                    var popinContent = new Element('div', {'class': 'popin-content', 'html': response});
                    var popinOverlay = new Element('div', {'class': 'popin-overlay'});
                    if(el.get('data-bg')) {
                        popin.addClass('s-bg');
                        popinOverlay.setStyle('background-image', 'url('+el.get('data-bg')+')');
                    }
                    var popinCaption = new Element('div', {'class': 'popin-caption', 'html':'Press <small>ESC</small> to exit'});

                    popin.setStyles({'display':'none', 'opacity':0})
                        .grab(popinOverlay)
                        .grab(popinContent)
                        .grab(popinCaption)
                        .inject(document.body)
                        .morph({'display':'block', 'opacity':1});

                    link.removeClass('loading');

                    var closeFx = new Fx.Morph(
                        popin,
                        {onComplete:function(){
                            popin.destroy();
                        }}
                    );
                    $(window).addEvent('keydown', function(e){
                        // close
                        if(e.key == 'esc') {
                            closeFx.start({'opacity':0});
                        }
                    });
                    popinOverlay.addEvent('click', function(e){
                        // close
                        e.stop();
                        closeFx.start({'opacity':0});
                    });
                }
            }).send();
        });
    });
}

function popinNav(link, nav){
    var nextLink = link.getParent('.box');
    nextLink = (nav === "left") ? nextLink.getPrevious('.box') : nextLink.getNext('.box');
    nextLink = nextLink.getElements('.popin-trigger')[0];

    var requestNav = new Request({
        url: nextLink.get('href'),
        method: 'get',
        data: {'ajax':'1'},
        onRequest: function(){
            // link.addClass('loading');
        },
        onSuccess: function(response){
            $('popin').set('html', '').set('html', response);
            $(window).addEvent('keydown', function(e){
                if(e.key == "right" || e.key == "left") {
                    popinNav(nextLink, e.key);
                }
            });
        }
    }).send();
}

function heartLike(els){
     els.each(function(el,i){
        var timer = 0;
        el.addEvents({
            click: function(e){
                e.stop();
            },
            mouseenter: function(e){
                clearTimeout(timer);
                timer = setTimeout(function() {
                    var requestNav = new Request({
                        url: el.get('href'),
                        method: 'get',
                        data: {'ajax':'1', 'mode':'heart'},
                        onSuccess: function(response){

                        }
                    }).send();
                    el.addClass('liked');
                }, 1800);
            },
            mouseleave: function(e){
                clearTimeout(timer);
            }
        });
    });
}