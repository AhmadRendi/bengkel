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

// Image upload
const imageUpload = document.getElementById('productImage');
const uploadArea = document.querySelector('.image-upload-area');

if (imageUpload && uploadArea) {
  uploadArea.addEventListener('click', () => imageUpload.click());
  imageUpload.addEventListener('change', (e) => handleImageUpload(e));

  console.log('Image upload initialized');
  // Drag and drop
  uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('dragover');
  });

  uploadArea.addEventListener('dragleave', () => {
    uploadArea.classList.remove('dragover');
  });

  uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
    const files = e.dataTransfer.files;
    if (files.length > 0) {
      handleImageUpload({ target: { files } });
    }
  });
}

function handleImageUpload(e) {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = (e) => {
      const preview = document.querySelector('.image-preview');
      const uploadArea = document.querySelector('.image-upload-area');

      if (preview) {
        preview.src = e.target.result;
        preview.style.display = 'block';
        uploadArea.style.display = 'none';
      }
    };
    reader.readAsDataURL(file);
  }
}

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

document.addEventListener('DOMContentLoaded', function () {
  const dropdownToggle = document.getElementById('invoiceMenuToggle');

  dropdownToggle.addEventListener('click', function () {
    // Hapus 'active' dari semua nav-link lain (opsional)
    document.querySelectorAll('.nav-link').forEach(link => {
      link.classList.remove('active');
    });

    // Tambahkan class active ke menu dropdown yang diklik
    this.classList.add('active');
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const dropdownToggle = document.getElementById('produkMenuToggle');

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

document.addEventListener('DOMContentLoaded', function () {
  console.log('Initializing DataTable for products');
  new DataTable('#tableProducts');
  new DataTable('#tableUsers');
});

// Show error modal if there's an error message in the session
document.addEventListener('DOMContentLoaded', function () {
  const errorMessage = document.getElementById('hasModalError')?.value;

  if (errorMessage) {
    const modalBody = document.querySelector('#errorModal .modal-body');
    modalBody.textContent = errorMessage;

    const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
    errorModal.show();
  }
});

document.addEventListener('DOMContentLoaded', function () {
  const errorMessage = document.getElementById('hasModalSuccess')?.value;

  if (errorMessage) {
    const modalBody = document.querySelector('#successModal .modal-body');
    modalBody.textContent = errorMessage;

    const errorModal = new bootstrap.Modal(document.getElementById('successModal'));
    errorModal.show();
  }
});

// Add Invoice functionality
// This script handles the addition of products to the invoice form dynamically

const selectElement = document.getElementById('produkSelect');
const selectedItemsContainer = document.getElementById('selectedItems');
const addedProducts = {};

selectElement.addEventListener('change', function () {
  const selectedOption = this.options[this.selectedIndex];
  const productId = selectedOption.value;
  const productName = selectedOption.getAttribute('data-nama');
  const productPrice = parseFloat(selectedOption.getAttribute('data-harga'));

  if (!productId) return;

  if (addedProducts[productId]) {
    const qtyInput = document.querySelector(`#qty-${productId}`);
    qtyInput.value = parseInt(qtyInput.value) + 1;
    updateTotal(productId, productPrice);
  } else {
    addedProducts[productId] = true;

    const row = document.createElement('tr');
row.setAttribute('id', `row-${productId}`);
row.innerHTML = `
    <td>
        ${productName}
        <input type="hidden" name="produk_ids[]" value="${productId}">
    </td>
    <td class="text-center">
        Rp <span id="price-${productId}">${parseInt(productPrice).toLocaleString()}</span>
    </td>
    <td class="text-center">
        <input type="number" 
               name="jumlah[${productId}]" 
               value="1" 
               min="1"
               class="form-control text-center mx-auto border-0 bg-light"
               id="qty-${productId}" 
               onchange="updateTotal('${productId}', ${productPrice})">
    </td>
    <td class="text-center">
        Rp <span id="total-${productId}">${parseInt(productPrice).toLocaleString()}</span>
    </td>
    <td class="text-center">
        <button type="button" onclick="removeItem('${productId}')" 
                class="btn btn-sm btn-outline-danger d-flex align-items-center mx-auto">
            <i class="fas fa-trash me-1"></i> Hapus
        </button>
    </td>
`;

    selectedItemsContainer.appendChild(row);

    calculateTotals();
  }

  this.value = '';
});

function updateTotal(productId, price) {
  const qtyInput = document.getElementById(`qty-${productId}`);
  const qty = parseInt(qtyInput.value) || 0;
  const total = price * qty;
  document.getElementById(`total-${productId}`).textContent = total.toLocaleString();

  calculateTotals();
}

function removeItem(productId) {
  const row = document.getElementById(`row-${productId}`);
  if (row) row.remove();
  delete addedProducts[productId];

  calculateTotals();
}

function calculateTotals() {
  let subtotal = 0;

  Object.keys(addedProducts).forEach(id => {
    const qty = parseInt(document.getElementById(`qty-${id}`).value) || 0;
    const price = parseFloat(document.getElementById(`price-${id}`)?.textContent.replace(/[^0-9.-]+/g, "")) || 0;
    subtotal += qty * price;
  });

  const pajak = subtotal * 0.10;
  const grandTotal = subtotal + pajak;

  document.getElementById('summarySubtotal').textContent = subtotal.toLocaleString();
  document.getElementById('summaryTax').textContent = pajak.toLocaleString();
  document.getElementById('summaryTotal').textContent = grandTotal.toLocaleString();
}

    document.addEventListener('DOMContentLoaded', function () {
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0'); // bulan dari 0-11
        const dd = String(today.getDate()).padStart(2, '0');

        const formattedToday = `${yyyy}-${mm}-${dd}`;
        document.getElementById('invoiceDate').value = formattedToday;
        document.getElementById('invoiceDueDate').value = formattedToday;
    });