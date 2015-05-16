jQuery(window).ready(function(e){
    var svg = jQuery('svg');
    svg.each(function(i, el) {
        var paths = jQuery(el).find('path:not(defs path)');

        paths.each(function(i, e) {
            e.style.strokeDasharray = e.style.strokeDashoffset = e.getTotalLength();
        });
    });

    var bg = jQuery('.bg');

    var tlBg = new TimelineMax();
    tlBg.set(bg, {
        opacity: 0,
        y: -50
    });

    var tlItems = new TimelineMax();
    tlItems.set(jQuery('.items .item'), {
        opacity: 0,
        y: -10
    });
    tlItems.set(jQuery('.items .infos'), {
        height:'auto',
        opacity: 0
    });

});

jQuery(window).load(function(e){
    var svg = jQuery('svg');

    svg.each(function(i, el) {

        var paths = jQuery(el).find('path:not(defs path)');

        // For each path, set the stroke-dasharray and stroke-dashoffset
        // equal to the path's total length, hence rendering it invisible
        // paths.each(function(i, e) {
        //     e.style.strokeDasharray = e.style.strokeDashoffset = e.getTotalLength();
        // });

        // Add each separate line animation to the timeline, animating the
        // stroke-dashoffset to 0. Use the duration, delay and easing to
        // achieve the perfect animation.
        setTimeout(function() {

              // .to(paths.eq(1), 0.15, {strokeDashoffset: 0}, "+=.15")
            tl = new TimelineMax(),
            tl.to(paths.eq(0), 0.1, {strokeDashoffset: 0})
              .to(paths.eq(1), 0.1, {strokeDashoffset: 0}, "+=.05")
              .to(paths.eq(2), 0.1, {strokeDashoffset: 0}, "+=.05")
              .to(paths.eq(3), 0.1, {strokeDashoffset: 0}, "+=.05")
              .to(paths.eq(4), 0.2, {strokeDashoffset: 0}, "+=.25")
              .to(paths.eq(5), 0.3, {strokeDashoffset: 0})
              .to(paths.eq(6), 0.2, {strokeDashoffset: 0}, "+=.25")
              .to(paths.eq(7), 0.15, {strokeDashoffset: 0})
              .to(paths.eq(8), 0.15, {strokeDashoffset: 0})
              .to(paths.eq(9), 0.15, {strokeDashoffset: 0})
              .to(paths.eq(10), 0.15, {strokeDashoffset: 0})
              ;

        }, 500);

    });

    var bg = jQuery('.bg');

    var tlBg = new TimelineMax();
    tlBg.to(bg, 2, {
        y: 0,
        opacity: 0.1,
        delay: 1.4
    });


    jQuery('.items .item').each(function(i, item) {
        // var item = jQuery('.items .item').eq(0);
        var item = jQuery(item);
        var title = item.find('.title');
        var infos = item.find('.infos');

        var tlItems = new TimelineMax();

        // if(i < 2) {
        var delay = 1800+(i*150);
        setTimeout(function() {

            tlItems.to(item, 0.5, {
                opacity: 1,
                y: 0,
                ease: Power2.easeOut
            });
            // tlItems.to(title, 0.5, {
            //     top: -38
            // });
            // tlItems.set(infos, {
            //     height:'auto',
            //     opacity: 0
            // });
            tlItems.from(infos, 0.5, {
                height: 0,
                opacity: 0,
                ease: Power2.easeOut,
                delay: 0.5
            }).to(infos, 0.5, {
                opacity: 1,
                ease: Power2.easeOut
            }, '-=0.2');

        }, delay);
        // }

    });

});