var ticking = false;
var sTop = window.scrollY;
window.addEventListener('scroll', function(){
    sTop = window.scrollY;
    if(!ticking) {
        requestAnimationFrame(function(){
            /* ... */
            ticking = false;
        });
    }
    ticking = true;
}, false);