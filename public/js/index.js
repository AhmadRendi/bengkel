// Toggle password visibility
const toggleButtons = document.querySelectorAll('.password-toggle');
toggleButtons.forEach(button => {
  button.addEventListener('click', () => {
    const input = button.parentNode.querySelector('input');
    const icon = button.querySelector('i');

    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  });
});

window.addEventListener('scroll', function () {
  const nav = document.querySelector('.floating-nav');
  if (window.scrollY > 100) {
    nav.classList.add('scrolled');
  } else {
    nav.classList.remove('scrolled');
  }
});

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const targetId = this.getAttribute('href');
    if (targetId === '#') return;

    const targetElement = document.querySelector(targetId);
    if (targetElement) {
      window.scrollTo({
        top: targetElement.offsetTop - 100,
        behavior: 'smooth'
      });

      const navbarCollapse = document.getElementById('navbarNav');
      if (navbarCollapse.classList.contains('show')) {
        const bsCollapse = new bootstrap.Collapse(navbarCollapse);
        bsCollapse.hide();
      }
    }
  });
});

document.querySelectorAll('.video-play-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    alert('Video akan diputar di sini');
  });
});

document.querySelectorAll('.popular-destination').forEach(dest => {
  dest.addEventListener('click', function () {
    alert('Informasi tentang ' + this.querySelector('span').textContent + ' akan ditampilkan');
  });
});


// Batas Admin

const toggleBtn = document.getElementById('toggleBtn');
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');
const sidebarOverlay = document.getElementById('sidebarOverlay');

toggleBtn.addEventListener('click', function () {
  // 768
  if (window.innerWidth <= 768) {
    // Mobile behavior
    sidebar.classList.toggle('show');
    sidebarOverlay.classList.toggle('show');
  } else {
    // Desktop behavior
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('expanded');
  }
});

// Close sidebar when clicking overlay (mobile)
sidebarOverlay.addEventListener('click', function () {
  sidebar.classList.remove('show');
  sidebarOverlay.classList.remove('show');
});

// Handle window resize
window.addEventListener('resize', function () {
  if (window.innerWidth > 768) {
    sidebar.classList.remove('show');
    sidebarOverlay.classList.remove('show');
  }
});

document.addEventListener('DOMContentLoaded', function () {
  const dropdownToggle = document.getElementById('usersMenuToggle');

  dropdownToggle.addEventListener('click', function () {
    // Hapus 'active' dari semua nav-link lain (opsional)
    document.querySelectorAll('.nav-link').forEach(link => {
      link.classList.remove('active');
    });

    // Tambahkan class active ke menu dropdown yang diklik
    this.classList.add('active');
  });
});

// Smooth animations for stats cards
const observerOptions = {
  threshold: 0.1,
  rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function (entries) {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = '1';
      entry.target.style.transform = 'translateY(0)';
    }
  });
}, observerOptions);

document.querySelectorAll('.stats-card').forEach(card => {
  card.style.opacity = '0';
  card.style.transform = 'translateY(20px)';
  card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
  observer.observe(card);
});

