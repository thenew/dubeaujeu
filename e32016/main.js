
window.addEventListener("resize", resizeThrottler, false);

  var resizeTimeout;
  function resizeThrottler() {
    // ignore resize events as long as an actualResizeHandler execution is in the queue
    if ( !resizeTimeout ) {
      resizeTimeout = setTimeout(function() {
        resizeTimeout = null;
        actualResizeHandler();

       // The actualResizeHandler will execute at a rate of 15fps
       }, 66);
    }
}


document.addEventListener('DOMContentLoaded', function() {

    document.querySelector('html').classList.toggle('no-js');
    document.querySelector('html').classList.add('js');

    window.setTimeout(function() {
      createGrid(100);
    }, 50);

    createCrosses();
})

function actualResizeHandler() {
    createGrid(100);
}

function createGrid(size) {

    // reset
    var grid = document.querySelector('.grid');
  if(grid) {
    grid.parentNode.removeChild(grid);
  }

    var ratioW = Math.ceil((window.innerWidth || document.documentElement.offsetWidth) / size),
        ratioH = Math.floor((document.documentElement.scrollHeight) / size);

  // ratioW even
  if( ratioW % 2 != 0 ) ratioW++;

  ratioH++;

    var parent = document.createElement('div');
    parent.className = 'grid';
    parent.style.width = (ratioW * size) + 'px';
    parent.style.height = (ratioH * size) + 'px';

    for (var i = 0; i < ratioH; i++) {
        for (var p = 0; p < ratioW; p++) {
            var cell = document.createElement('div');
            cell.style.height = (size) + 'px';
            cell.style.width = (size) + 'px';
            parent.appendChild(cell);
        }
    }

    document.body.insertBefore(parent, document.querySelector('.wrapper'));
}

function createCrosses() {
  var divs = document.querySelectorAll('.box');

  [].forEach.call(divs, function(div) {
    for (i = 0; i < 4; i++) {

     var cross = document.createElement('i');
     cross.className = 'cross';
      div.appendChild(cross);
    }

  });
}
