
function mobs() {

    var mobsBox = document.querySelector('.mobs-box');
    if(! mobsBox) return;

    var gameOn = true;
    var intervalId = false;

    var container = mobsBox;
    var mobModel = mobsBox.querySelector('.mob');
    mobModel.style.display = 'none';

    var counterInit = 8;
    var counter = counterInit;
    var counterEl = mobsBox.querySelector(".counter");
    counterEl.textContent = counter;

    var barEl = mobsBox.querySelector(".bar");

    var intro = document.querySelector('.content .intro');
    TweenMax.set(intro, {
        'opacity': 0,
        'height': 0
    });

    var chronoId = false;
    var chrono = 0;
    var chronoEl = mobsBox.querySelector(".chrono-nb");
    chronoEl.textContent = chrono;
    var setTime = function() {
        chrono += 10;
        chronoEl.textContent = chrono;
    }

    var counterUpdate = function() {
        if(counter) {
            counterEl.textContent = counter;
        }

        TweenMax.to(barEl, 2, {
            height: (100/counterInit) * (counterInit - counter) + '%',
            ease:Power2.easeOut,
        });
    }

    var gameover = function() {
        counterUpdate();
        gameOn = false;
        clearInterval(chronoId);
        $('body')
            .removeClass('gameon')
            .addClass('gameover');
        $('.mobs-box').trigger('gameover');

        TweenMax.set(intro, {
            height:'auto',
            opacity: 1
        });
        TweenMax.from(intro, 1, {
            height: 0,
            opacity: 0,
            ease: Power2.easeOut,
            delay: 1.5
        });

        if( typeof ga !== 'undefined' ) {
            ga('send', {
              'hitType': 'event',          // Required.
              'eventCategory': 'mobs',   // Required.
              'eventAction': 'gameover',      // Required.
              'eventLabel': 'score-'+getRandomInt(0, 999999999999),
              'eventValue': chrono
            });
        }
    }

    var pop = function() {

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
        clearInterval(intervalId);
        // if(delay <= 400) {
        //     delay -= 2;
        // } else if(delay <= 600) {
        //     delay -= 6;
        // } else {
        //     delay -= (delay/10);
        // }
        if(counter < 3) {
            delay = 600;
        } else if (counter < 6) {
            delay = 500;
        } else {
            delay -= (delay/10);
        }
        delay = Math.floor(delay);
        // console.log('delay : ', delay);
        // console.log('counter : ', counter);

        // update counter
        counter--;
        counterUpdate();

        if(counter > 0) {
            pop();
            intervalId = setInterval(update, delay);
        } else {
            gameover();
        }

    }

    // first kill = start game
    $('.mobs-box').on('kill', function(e) {
        if(intervalId !== false) return;

        update();
        // start chrono
        chronoId = setInterval(setTime, 10);

    })

    setTimeout(function() {
        pop();
    }, 400);

}


jQuery(document).ready(function(e){
    $('html').addClass('domready');
});

jQuery(window).load(function(e){
    $('html').removeClass('domready')
        .addClass('load');
    mobs();
});
