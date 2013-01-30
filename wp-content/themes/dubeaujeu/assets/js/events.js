window.addEvent('domready',function(){

    if($('du-beau-jeu')){
        $('du-beau-jeu').addClass('loading');
    }

    $$("ul[data-liffect] .li").each(function (el,i) {
        var delay = (i*100)+200;
        el.set("style", "-webkit-animation-delay:" + delay + "ms;"
            + "-moz-animation-delay:" + delay + "ms;"
            + "-o-animation-delay:" + delay + "ms;"
            + "animation-delay:" + delay + "ms;");
    });

});

window.addEvent('load',function(){

    if($('du-beau-jeu')){
        $('du-beau-jeu').removeClass('loading')
            .masonry({
                itemSelector: '.box'
            });
        $('du-beau-jeu').addClass('play');
    }

});