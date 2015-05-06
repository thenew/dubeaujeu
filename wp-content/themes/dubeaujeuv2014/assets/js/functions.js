/*function popinTrigger(els) {
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
*/

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}

function mobs() {
    var mobsBox = document.querySelector('.mobs-box');
    if(! mobsBox) return;

    var gameOn = true;
    var intervalID = false;

    var container = mobsBox;
    var mobModel = mobsBox.querySelector('.mob');
    mobModel.style.display = 'none';

    var counter = 10;
    var counterEl = mobsBox.querySelector(".counter");
    counterEl.textContent = counter;

    var barEl = mobsBox.querySelector(".bar");

    // var bgColors = { start: "rgba(222, 222, 222, 0)", end: "rgba(222, 222, 222, 0.8)"};
    // var bgColorsRed = { start: "rgba(255, 192, 43, 0)", end: "rgba(255, 192, 43, 0.8)"};

    //   function updateColor( el, tween, direction ) {
    //         TweenMax.set(el, {
    //             backgroundImage:"radial-gradient("+tween.target["start"]+", "+tween.target["end"]+")"
    //         });
    //   }

      // var bgGradientRed = TweenMax.to(bgColors, 4, {
      //       colorProps:{start:bgColorsRed.start, end:bgColorsRed.end },
      //       ease: Quint.easeInOut,
      //       onUpdateParams:[ container, "{self}", "top"],
      //       onUpdate: updateColor,
      //       paused:true
      // });


    var counterUpdate = function() {
        if(counter) {
            counterEl.textContent = counter;
        }

        TweenMax.to(barEl, 2, {
            height: (10 - counter) * 10 + '%',
            ease:Power2.easeOut,
        });
    }

    var gameover = function() {
        // tl.stop();
        counterUpdate();
        gameOn = false;
        $('body')
            .removeClass('gameon')
            .addClass('gameover');
        $('.mobs-box').trigger('gameover');
        // container.trigger('gameover');
    }

    // var mobs = mobsBox.querySelectorAll('.mob');

    // for(var i = 0; i < mobs.length; i++){
        // var mob = mobs[i];

    var pop = function() {


        // accelerate delay
/*        delay -= (delay/4);
        delay = Math.floor(delay);
        console.log('delay : ' + delay);*/

        var mob = mobModel.cloneNode(true);
        var mobAlive = true;
        var lines = mob.querySelectorAll('.line');
        var circle = mob.querySelector('.circle');
        var disc = mob.querySelector('.disc');
        var hitbox = mob.querySelector('.hitbox');

        container.appendChild(mob);

        var topStart = getRandomInt(10, 90);
        var leftStart = getRandomInt(10, 90);
        var topEnd = topStart + getRandomInt(-10, 10);
        var leftEnd = leftStart + getRandomInt(-10, 10);

        TweenMax.set([lines], {
          drawSVG: '-50% 0%'
        })
        TweenMax.set(mob, {
            display: 'block',
            position: 'absolute',
            xPercent: '-50%',
            yPercent: '-50%',
            top: topStart+'%',
            left: leftStart+'%',
            opacity: 0
        })
        var mobMove = TweenMax.to(mob, 4, {
            top: topEnd+'%',
            left: leftEnd+'%',
            repeat: -1,
            yoyo: true
        });
        TweenMax.to(mob, 1, {
            opacity: 1,
        });

        mobMove.play();

        var tl = new TimelineMax({paused: true, yoyo:false});
        var animSpeed = 2;
        tl.timeScale(animSpeed);

        tl
          .to(disc, 0.2, {
            //scale:1.6,
            attr:{'r': 4},
            ease:Power2.easeOut
          })
            .add("boum")
          .to(disc, 0.8, {
            attr:{'r': 10},
            ease:Power2.easeOut
          })
          .to(circle, 1, {
            //scale:1.6,
            attr:{'r': 25},
            ease:Power2.easeOut,
              alpha:0
          }, '-=0.8')
          .to(disc, 1, {
            opacity:0,
            ease:Power2.easeOut,
          }, 'boum')
          .to(lines, 2, {
            drawSVG:'100% 150%',
            ease:Power2.easeOut,
            alpha:1
          }, '-=1')
          .to(lines, 1.6, {
            alpha:0
          }, '-=1');



        var kill = function(event) {
            event.preventDefault();
            // mob.css('pointer-events', 'none');
            mob.style.pointerEvents = 'none';
            if(mobAlive && gameOn) {
                mobMove.pause();
                tl.play();
                $('.mobs-box').trigger('kill');

                if(counter < 9) {
                    counter++;
                    counterUpdate();
                }

                if( ! $('body').hasClass('gameon') ) {
                    $('body').addClass('gameon');
                }
                mobAlive = false;
            }
        }
        // hitbox.addEventListener('mousedown', function(event) { kill(event) });
        hitbox.addEventListener('mouseover', function(event) { kill(event) });

        tl.eventCallback('onComplete', function(){
            mob.parentNode.removeChild(mob);
        });

        $('.mobs-box').on('gameover', function(e) {
            mobMove.pause();

            TweenMax.to('.mob', 1, {
                opacity: 0,
                ease:Power2.easeOut,
            });
        });

    }

    var delay = 1000;

    var update = function() {
        clearInterval(intervalID);
        delay -= (delay/75);
        delay = Math.floor(delay);
        console.log('delay : ', delay);

        // update counter
        counter--;
        counterUpdate();

        if(counter > 0) {
            pop();
            intervalID = setInterval(update, delay);
        } else {
            gameover();
        }

    }

    $('.mobs-box').on('kill', function(e) {
        if(intervalID !== false) return;

        update();
/*        intervalID = window.setInterval(function() {
        }, delay);*/

    })

    pop();


}
