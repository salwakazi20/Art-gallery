document.addEventListener('DOMContentLoaded', () => {
  const tabs = document.querySelectorAll('.sidebar ul li');
  const contents = document.querySelectorAll('.tab-content');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      // Hide all contents
      contents.forEach(c => c.style.display = 'none');
      
      // Remove active class from all tabs
      tabs.forEach(t => t.classList.remove('active-tab'));

      // Show clicked tab's content
      const activeId = tab.getAttribute('data-tab');
      document.getElementById(activeId).style.display = 'block';
      
      // Highlight active tab
      tab.classList.add('active-tab');
    });
  });

  // Show first tab by default
  tabs[0].click();
});
