<?php /* Template Name: 27 */
function fon_scripts_27() {
    wp_enqueue_script( 'tween', ASSETS_URL.'/js/vendor/tween.min.js', '', '14', false );
    wp_enqueue_script( 'three', ASSETS_URL.'/js/vendor/three.js', '', '71', false );
    wp_enqueue_script( 'Projector', ASSETS_URL.'/js/vendor/three/Projector.js', '', '1', false );
    wp_enqueue_script( 'CanvasRenderer', ASSETS_URL.'/js/vendor/three/CanvasRenderer.js', '', '1', false );
}
add_action( 'wp_enqueue_scripts', 'fon_scripts_27' );

get_header();
?>
<script>

    var container, stats;
    var camera, scene, renderer;
    var particleMaterial;

    var raycaster;
    var mouse;

    var objects = [];

    init();
    animate();

    function init() {

        container = document.createElement( 'div' );
        document.body.appendChild( container );

        // var info = document.createElement( 'div' );
        // info.style.position = 'absolute';
        // info.style.top = '10px';
        // info.style.width = '100%';
        // info.style.textAlign = 'center';
        // info.innerHTML = '<a href="http://threejs.org" target="_blank">three.js</a> - clickable objects';
        // container.appendChild( info );

        camera = new THREE.PerspectiveCamera( 70, window.innerWidth / window.innerHeight, 1, 10000 );
        camera.position.set( 0, 300, 500 );

        scene = new THREE.Scene();

        // var geometry = new THREE.BoxGeometry( 100, 100, 100 );

        // for ( var i = 0; i < 10; i ++ ) {


        // }


        addObject();
        addObject();
        addObject();
        addObject();
        addObject();

        var PI2 = Math.PI * 2;
        particleMaterial = new THREE.SpriteCanvasMaterial( {

            color: 0x000000,
            program: function ( context ) {

                context.beginPath();
                context.arc( 0, 0, 0.5, 0, PI2, true );
                context.fill();

            }

        } );

        //

        raycaster = new THREE.Raycaster();
        mouse = new THREE.Vector2();

        renderer = new THREE.CanvasRenderer();
        renderer.setClearColor( 0xf0f0f0 );
        renderer.setPixelRatio( window.devicePixelRatio );
        renderer.setSize( window.innerWidth-20, window.innerHeight-20 );
        container.appendChild( renderer.domElement );

        // stats = new Stats();
        // stats.domElement.style.position = 'absolute';
        // stats.domElement.style.top = '0px';
        // container.appendChild( stats.domElement );

        document.addEventListener( 'mousedown', onDocumentMouseDown, false );
        document.addEventListener( 'touchstart', onDocumentTouchStart, false );

        //

        window.addEventListener( 'resize', onWindowResize, false );

    }

    function addObject() {
        var geometry = new THREE.BoxGeometry( 100, 100, 100 );

        var object = new THREE.Mesh( geometry, new THREE.MeshBasicMaterial( {
            color: Math.random() * 0xffffff,
            wireframe: (Math.random() >= 0.5),
            opacity: 0.9
        } ) );
        object.position.x = Math.random() * 800 - 400;
        object.position.y = Math.random() * 800 - 400;
        object.position.z = Math.random() * 800 - 400;

        object.scale.x = Math.random() * 2 + 1;
        object.scale.y = Math.random() * 2 + 1;
        object.scale.z = Math.random() * 2 + 1;

        object.rotation.x = Math.random() * 2 * Math.PI;
        object.rotation.y = Math.random() * 2 * Math.PI;
        object.rotation.z = Math.random() * 2 * Math.PI;

        scene.add( object );

        objects.push( object );
    }

function createFish(){

  fish = new THREE.Group();

  var bodyGeom = new THREE.BoxGeometry(100, 100, 100);
    var bodyMat = new THREE.MeshLambertMaterial({
    color: getRandomColor(),
//    shading: THREE.FlatShading,
  //  shading: THREE.NoShading,
    wireframe: (Math.random() >= 0.5)
  });
  bodyFish = new THREE.Mesh(bodyGeom, bodyMat);

  fish.add(bodyFish);

  fish.rotation.z = 1;

  return fish;
}

function getRandomColor(){
  var col = hexToRgb(colors[Math.floor(Math.random()*colors.length)]);
  var threecol = new THREE.Color("rgb("+col.r+","+col.g+","+col.b+")");
  return threecol;
}

function hexToRgb(hex) {
  var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
  return result ? {
    r: parseInt(result[1], 16),
    g: parseInt(result[2], 16),
    b: parseInt(result[3], 16)
  } : null;
}

    function onWindowResize() {

        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();

        renderer.setSize( window.innerWidth - 20, window.innerHeight - 20 );

    }

    function onDocumentTouchStart( event ) {

        event.preventDefault();

        event.clientX = event.touches[0].clientX;
        event.clientY = event.touches[0].clientY;
        onDocumentMouseDown( event );

    }

    function onDocumentMouseDown( event ) {

        event.preventDefault();

        mouse.x = ( event.clientX / renderer.domElement.width ) * 2 - 1;
        mouse.y = - ( event.clientY / renderer.domElement.height ) * 2 + 1;

        raycaster.setFromCamera( mouse, camera );

        var intersects = raycaster.intersectObjects( objects );

        if ( intersects.length > 0 ) {

            var target = intersects[ 0 ];
            // target.object.scale.set( 1, Math.abs( Math.sin( time * 0.0002 ) ), 1 );

    // TWEEN.removeAll();
    // new TWEEN.Tween( { x: 0, y: 0 } )
    // .to( { x: 400 }, 2000 )
    // .easing( TWEEN.Easing.Elastic.InOut )
    // .onUpdate( render )
    // .start();

            intersects[ 0 ].object.material.color.setHex( Math.random() * 0xffffff );

            var particle = new THREE.Sprite( particleMaterial );
            particle.position.copy( intersects[ 0 ].point );
            particle.scale.x = particle.scale.y = 16;
            scene.add( particle );

        }

        /*
        // Parse all the faces
        for ( var i in intersects ) {

            intersects[ i ].face.material[ 0 ].color.setHex( Math.random() * 0xffffff | 0x80000000 );

        }
        */
    }

    //

    function animate() {
        var time = (new Date()).getTime();
        // var newScale = Math.abs( Math.sin( time * 0.0002 ) );
        // console.log(newScale);
        requestAnimationFrame( animate );
        TWEEN.update();

        // objects[0].scale.set( 1, newScale, 1 );

        // render();
        renderer.render( scene, camera );
        // stats.update();

    }

    var radius = 600;
    var theta = 0;

    function render() {

        // theta += 0;

        // camera.position.x = radius * Math.sin( THREE.Math.degToRad( theta ) );
        // camera.position.y = radius * Math.sin( THREE.Math.degToRad( theta ) );
        // camera.position.z = radius * Math.cos( THREE.Math.degToRad( theta ) );
        // camera.lookAt( scene.position );

        renderer.render( scene, camera );

    }

</script>



<?php
get_footer();