(function(){
  var menuLink = document.getElementById('toggle-menu');
  var toggleMenu = function() {
    if (document.body.className == 'menu-close') {
      document.body.className = 'menu-open';
      menuLink.innerHTML = 'Fermer';
    } else {
      document.body.className = 'menu-close';
      menuLink.innerHTML = 'Menu';
    }
  };
  menuLink.onclick = toggleMenu;
})();

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-49208263-1', 'Acmepaysage.fr');
ga('send', 'pageview');
