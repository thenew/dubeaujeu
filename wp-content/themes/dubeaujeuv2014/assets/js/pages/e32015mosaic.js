jQuery(window).ready(function(e){

    // svg logo
    var svg = jQuery('svg');
    svg.each(function(i, el) {
        var paths = jQuery(el).find('path:not(defs path)');

        paths.each(function(i, e) {
            e.style.strokeDasharray = e.style.strokeDashoffset = e.getTotalLength();
        });
    });

    // packery
    var $container = jQuery('.bricks');
    // init
    $container.packery({
      itemSelector: '.brick-item',
      percentPosition: true,
      transitionDuration: '0s',
      stamp: '.stamp',
      gutter: 0
    });

});

jQuery(window).load(function(e){
    jQuery('.js-hidden').removeClass('js-hidden');

    var svg = jQuery('.handfont');

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


    jQuery('.anim-item').each(function(i, item) {
        var $item = jQuery(item);

        var tlItems = new TimelineMax();

            tlItems.set($item, {
                opacity: 0,
                scale: 0.95
            });

        var delay = 200+(i*400);
        setTimeout(function() {

            tlItems.to($item, 1, {
                opacity: 1,
                scale: 1,
                ease: Power2.easeOut
            });

        }, delay);

    });

    // tilt();

    jQuery('body').mousemove( function(event){ tilt(event); }  );
    if(window.DeviceOrientationEvent) {
        window.ondeviceorientation = function(event){ tilt(event); };
    }






var initPhotoSwipeFromDOM = function(gallerySelector) {

    // parse slide data (url, title, size ...) from DOM elements
    // (children of gallerySelector)
    var parseThumbnailElements = function(el) {
        var thumbElements = el.querySelectorAll('a, .html'),
            numNodes = thumbElements.length,
            items = [],
            figureEl,
            linkEl,
            size,
            item;

        for(var i = 0; i < numNodes; i++) {

            // figureEl = thumbElements[i]; // <figure> element

            // // include only element nodes
            // if(figureEl.nodeType !== 1) {
            //     continue;
            // }

            // linkEl = figureEl.children[0]; // <a> element
                linkEl = thumbElements[i];
            // <a> element
            console.log('linkEl.classList.contains : ', linkEl.classList.contains('html'));
            if( ! linkEl.classList.contains('html') ) {

                size = linkEl.getAttribute('data-size').split('x');

                // create slide object
                item = {
                    src: linkEl.getAttribute('href'),
                    w: parseInt(size[0], 10),
                    h: parseInt(size[1], 10)
                };



                // if(linkEl.children.length > 1) {
                //     // <figcaption> content
                //     item.title = linkEl.children[1].innerHTML;
                // }

                if(linkEl.children.length > 0) {
                    // <img> thumbnail element, retrieving thumbnail url
                    item.msrc = linkEl.children[0].getAttribute('src');
                }

                item.el = figureEl; // save link to element for getThumbBoundsFn
            } else {
                item = {
                    html: linkEl.innerHTML
                }

            }
            items.push(item);
        }

        return items;
    };

    // find nearest parent element
    var closest = function closest(el, fn) {
        return el && ( fn(el) ? el : closest(el.parentNode, fn) );
    };

    // triggers when user clicks on thumbnail
    var onThumbnailsClick = function(e) {
        e = e || window.event;
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var eTarget = e.target || e.srcElement;
        // var clickedListItem = this;

        // find root element of slide
        // var clickedListItem = closest(eTarget, function(el) {
        //     return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
        // });

        // if(!clickedListItem) {
        //     return;
        // }

        // find index of clicked item by looping through all child nodes
        // alternatively, you may define index via data- attribute
        // var clickedGallery = clickedListItem.parentNode,
        //     childNodes = clickedListItem.parentNode.querySelectorAll('a'),
        //     numChildNodes = childNodes.length,
        //     nodeIndex = 0,
        //     index;

        // for (var i = 0; i < numChildNodes; i++) {
        //     console.log('childNodes[i] : ', childNodes[i]);
        //     if(childNodes[i].nodeType !== 1) {
        //         continue;
        //     }

        //     if(childNodes[i] === clickedListItem) {
        //         index = nodeIndex;
        //         break;
        //     }
        //     nodeIndex++;
        // }

        clickedGallery = this;
        index = 0;

        if(index >= 0) {
            // open PhotoSwipe if valid index found
            openPhotoSwipe( index, clickedGallery );
        }
        return false;
    };

    // parse picture index and gallery index from URL (#&pid=1&gid=2)
    var photoswipeParseHash = function() {
        var hash = window.location.hash.substring(1),
        params = {};

        if(hash.length < 5) {
            return params;
        }

        var vars = hash.split('&');
        for (var i = 0; i < vars.length; i++) {
            if(!vars[i]) {
                continue;
            }
            var pair = vars[i].split('=');
            if(pair.length < 2) {
                continue;
            }
            params[pair[0]] = pair[1];
        }

        if(params.gid) {
            params.gid = parseInt(params.gid, 10);
        }

        return params;
    };

    var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
        var pswpElement = document.querySelectorAll('.pswp')[0],
            gallery,
            options,
            items;

        items = parseThumbnailElements(galleryElement);

        // define options (if needed)
        options = {

            history: false,
            shareEl: false,

            // define gallery index (for URL)
            galleryUID: galleryElement.getAttribute('data-pswp-uid'),

            getThumbBoundsFn: function(index) {
                // See Options -> getThumbBoundsFn section of documentation for more info
                // var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                //     pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                //     rect = thumbnail.getBoundingClientRect();

                // return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
            }

        };

        // PhotoSwipe opened from URL
        if(fromURL) {
            if(options.galleryPIDs) {
                // parse real index when custom PIDs are used
                // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                for(var j = 0; j < items.length; j++) {
                    if(items[j].pid == index) {
                        options.index = j;
                        break;
                    }
                }
            } else {
                // in URL indexes start from 1
                options.index = parseInt(index, 10) - 1;
            }
        } else {
            options.index = parseInt(index, 10);
        }

        // exit if index not found
        if( isNaN(options.index) ) {
            return;
        }

        if(disableAnimation) {
            options.showAnimationDuration = 0;
        }

        // Pass data to PhotoSwipe and initialize it
        gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();
    };

    // loop through all gallery elements and bind events
    var galleryElements = document.querySelectorAll( gallerySelector );

    for(var i = 0, l = galleryElements.length; i < l; i++) {
        galleryElements[i].setAttribute('data-pswp-uid', i+1);
        // console.log('galleryElements[i].querySelectorAll(a) : ', galleryElements[i].querySelectorAll('a'));
        var galleryElementsTrigger = galleryElements[i].querySelector('.pswp-trigger');
        galleryElementsTrigger.onclick = onThumbnailsClick;

        // for(var j = 0, lA = galleryElementsA.length; j < lA; j++) {
        //     galleryElementsA[j].onclick = onThumbnailsClick;
        // }


    }

    // Parse URL and open gallery if it contains #&pid=3&gid=1
    // var hashData = photoswipeParseHash();
    // if(hashData.pid && hashData.gid) {
    //     openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
    // }
};



    initPhotoSwipeFromDOM('.pswp-gallery');



});


// history: false,
// shareEl: false
// index: currentIndex,
// focus: false,
// modal: false,
// showAnimationDuration: 0,
// hideAnimationDuration: 0,
// closeEl: false,
// captionEl: false,
// fullscreenEl: false,
// preloaderEl: false,
// bgOpacity: 0,
// zoomEl: false,
// counterEl: false,
// arrowKeys: false,
// tapToClose: false,
// tapToToggleControls: false,
// clickToCloseNonZoomable: false,
// spacing: 0,
// closeOnScroll: false,
// closeOnVerticalDrag: false


function tilt(event) {
    cx = Math.ceil(jQuery(window).width() / 2.0);
    cy = Math.ceil(jQuery(window).height() / 2.0);
    dx = event.pageX - cx;
    dy = event.pageY - cy;
    // mouseX = event.pageX;
    // wRecetas = Math.ceil((event.pageX*(jQuery(window).width()-1920))/jQuery(window).width());
    // minus = ((wRecetas)*(event.pageX))*-1;
    // moveX = ((mouseX*wRecetas)*-1);
    // console.log('wRecetas : ', wRecetas);
    tiltx = - (dy / cy) * 1.5;
    tilty = (dx / cx) * 1;
    radius = Math.sqrt(Math.pow(tiltx,2) + Math.pow(tilty,2));
    degree = (radius * 5);
  //   console.log('tiltx : ', tiltx);
  //   console.log('tilty : ', tilty);
  // console.log('degree : ', degree);

    TweenLite.set(".anim-tilt", {transform:'rotate3d(' + tiltx + ', ' + tilty + ', 0, ' + degree + 'deg)'});
    TweenLite.set(".anim-tilt-reverse", {transform:'rotate3d(' + (-tiltx) + ', ' + (-tilty) + ', 0, ' + degree + 'deg)'});
}




