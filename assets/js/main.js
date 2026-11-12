function loadScriptsSequentially(scripts) {
  function loadNext(i) {
    if (i >= scripts.length) return;
    let s = document.createElement('script');
    s.src = scripts[i];
    s.onload = () => loadNext(i + 1); // load next only after current finishes
    document.head.appendChild(s);
  }
  loadNext(0);
}




function loadScriptsSequentially(scripts, index = 0) {
    if (index >= scripts.length) return;
    var script = document.createElement('script');
    script.src = scripts[index];
    script.onload = function() {
        loadScriptsSequentially(scripts, index + 1);
    };
    document.head.appendChild(script);
}

loadScriptsSequentially([
    '/assets/js/jquery-1.12.4.min.js',
    '/assets/js/plugins.js',
    '/assets/js/jquery.min.phatvideobg.js',
    '/assets/js/jquery.imagesloaded.min.js',
    '/assets/js/jquery.isotope.min.js',
    '/assets/js/jquery.lightcase.min.js',
    '/assets/js/script.js'
]);

document.addEventListener('DOMContentLoaded', function() {
    console.log("All scripts loaded!");
});