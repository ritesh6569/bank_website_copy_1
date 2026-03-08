  </div><!-- /.adm-content -->
</div><!-- /.adm-main -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function(){
  // Clock
  function tick() {
    var el = document.getElementById('admClock');
    if (!el) return;
    var now = new Date();
    el.textContent = now.toLocaleDateString('en-IN',{day:'2-digit',month:'short',year:'numeric'})
      + ' ' + now.toLocaleTimeString('en-IN',{hour:'2-digit',minute:'2-digit'});
  }
  tick(); setInterval(tick, 30000);

  // Sidebar toggle (mobile)
  var ham     = document.getElementById('admHamburger');
  var sidebar = document.getElementById('admSidebar');
  var overlay = document.getElementById('admOverlay');
  function openSidebar()  { sidebar.classList.add('open');    overlay.classList.add('show'); }
  function closeSidebar() { sidebar.classList.remove('open'); overlay.classList.remove('show'); }
  if (ham)     ham.addEventListener('click', function(){ sidebar.classList.contains('open') ? closeSidebar() : openSidebar(); });
  if (overlay) overlay.addEventListener('click', closeSidebar);
})();
</script>
</body>
</html>
