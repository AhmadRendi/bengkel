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

// Show error modal if there's an error message in the session
document.addEventListener('DOMContentLoaded', function () {
  const errorMessage = document.getElementById('hasModalError')?.value;

  console.log('Error message:', errorMessage);

  if (errorMessage) {
    // const modalBody = document.querySelector('#errorModal .modal-body');
    // modalBody.textContent = errorMessage;

    // const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
    // errorModal.show();

    Swal.fire(
      'Kesalahan!',
      errorMessage,
      'error'
    );
  }
});

document.addEventListener('DOMContentLoaded', function () {
  const errorMessage = document.getElementById('hasModalSuccess')?.value;

  if (errorMessage) {
    // const modalBody = document.querySelector('#successModal .modal-body');
    // modalBody.textContent = errorMessage;

    // const errorModal = new bootstrap.Modal(document.getElementById('successModal'));
    // errorModal.show();

    console.log('Success message:', errorMessage);
    Swal.fire(
      'Berhasil!',
      errorMessage,
      'success'
    );
  }
});

const tahunSelect = document.getElementById("tahun");
const tahunSekarang = new Date().getFullYear();
const tahunAwal = 2000;

for (let tahun = tahunSekarang; tahun >= tahunAwal; tahun--) {
  const option = document.createElement("option");
  option.value = tahun;
  option.textContent = tahun;
  tahunSelect.appendChild(option);
}

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

function openInvoiceModal(invoiceId) {
  console.log('Opening invoice modal for ID:', invoiceId);

  fetch(`/invoice/preview/${invoiceId}`)
    .then(res => res.json())
    .then(response => {
      if (response.error) {
        alert(response.message);
        return;
      }

      const invoice = response.invoice;

      // Set input values
      document.getElementById('namaPelanggan').value = invoice.namaPelanggan || '';
      document.getElementById('alamat').value = invoice.alamat || '';
      document.getElementById('catatan').value = invoice.catatan || '';

      // Clear table items
      const tableBody = document.getElementById('selectedItems');
      tableBody.innerHTML = '';

      let subtotal = 0;

      console.log('Invoice items:', invoice.items);

      // Loop item pesanan
      invoice.items.forEach(item => {
        const harga = parseFloat(item.produk.harga);
        const jumlah = parseInt(item.jumlah);
        const total = harga * jumlah;
        subtotal += total;

        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${item.produk.nama}
            <input type="hidden" name="produk_ids[]" value="${item.produk.id}">
          </td>
          <td class="text-center">Rp ${harga.toLocaleString()}</td>
          <td class="text-center">
            <input type="number" class="form-control text-center bg-light border-0"
                   name="jumlah[${item.produk.id}]" value="${jumlah}" min="1" readonly>
          </td>
          <td class="text-center">Rp ${total.toLocaleString()}</td>
        `;
        tableBody.appendChild(row);
      });

      // Hitung Pajak dan Total
      const tax = subtotal * 0.1;
      const grandTotal = subtotal + tax;

      document.getElementById('summarySubtotal').innerText = `Rp ${subtotal.toLocaleString()}`;
      document.getElementById('summaryTax').innerText = `Rp ${tax.toLocaleString()}`;
      document.getElementById('summaryTotal').innerText = `Rp ${grandTotal.toLocaleString()}`;

      // Show modal
      const modal = new bootstrap.Modal(document.getElementById('previewModal'));
      modal.show();
    })
    .catch(err => {
      console.error('Gagal mengambil data invoice:', err);
      alert('Terjadi kesalahan saat mengambil data invoice.');
    });
}

function editUser(id) {
  fetch(`/find/user/${id}`)
    .then(res => res.json())
    .then(response => {

      console.log('User data fetched:', response);

      // Set input values
      document.getElementById('editUserId').value = response.id;
      document.getElementById('editUserName').value = response.name;
      document.getElementById('editUserEmail').value = response.email;
      document.getElementById('editUserRole').value = response.role;

      // Show modal
      const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
      modal.show();
    })
    .catch(err => {
      console.error('Failed to fetch user data:', err);
      alert('Terjadi kesalahan saat mengambil data pengguna.');
    });
}

function resetPassword(id) {
  Swal.fire({
    title: 'Reset Password?',
    text: "Apakah Anda yakin ingin mereset password pengguna ini?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, reset!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      console.log('Resetting password for user ID:', id);
      fetch(`/reset-password/${id}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      })
        .then(res => res.json())
        .then(response => {
          if (response.message === 'Success') {
            Swal.fire(
              'Berhasil!',
              'Password telah direset.',
              'success'
            );
          } else {
            Swal.fire(
              'Gagal!',
              response.message || 'Gagal mereset password.',
              'error'
            );
          }
        })
        .catch(err => {
          Swal.fire(
            'Kesalahan!',
            'Terjadi kesalahan saat mereset password.',
            'error'
          );
        });
    }
  });
}


function editProduct(id) {
  fetch(`/find/product/${id}`)
    .then(res => res.json())
    .then(response => {

      console.log('User data fetched:', response);

      // // Set input values
      document.getElementById('editProdukId').value = response.id;
      document.getElementById('editNamaProduk').value = response.nama;
      document.getElementById('editSKUProduk').value = response.sku;
      document.getElementById('editDeskripsiProduk').value = response.deskripsi;
      document.getElementById('editKategoriProduk').value = response.kategori;
      document.getElementById('editHargaProduk').value = response.harga;
      document.getElementById('editStokProduk').value = response.stok;

      // Show modal
      const modal = new bootstrap.Modal(document.getElementById('editProdukModal'));
      modal.show();
    })
    .catch(err => {
      Swal.fire(
        'Kesalahan!',
        'Terjadi kesalahan saat Mengambil data.',
        'error'
      );
    });
}

function deleteUser(id) {
  console.log('Deleting user with ID:', id);
  Swal.fire({
    title: 'Hapus Pengguna?',
    text: "Apakah Anda yakin ingin menghapus pengguna ini?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, hapus!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(`delete/user/${id}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      })
        .then(res => res.json())
        .then(response => {
          if (response.message === 'Success') {
            Swal.fire(
              'Berhasil!',
              response.message,
              'success'
            );
          } else {
            Swal.fire(
              'Gagal!',
              response.message || 'Gagal menghapus pengguna.',
              'error'
            );
          }
        })
        .catch(err => {
          Swal.fire(
            'Kesalahan!',
            err.message,
            'error'
          );
        });
    }
  });
}

function deleteProduk(id) {
  console.log('Deleting product with ID:', id);
  Swal.fire({
    title: 'Hapus Produk?',
    text: "Apakah Anda yakin ingin menghapus produk ini?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, hapus!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(`delete/product/${id}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      })
        .then(res => res.json())
        .then(response => {
          if (response.message === 'Success') {
            Swal.fire(
              'Berhasil!',
              response.message,
              'success'
            );
          } else {
            Swal.fire(
              'Gagal!',
              response.message || 'Gagal menghapus produk.',
              'error'
            );
          }
        })
        .catch(err => {
          Swal.fire(
            'Kesalahan!',
            err.message,
            'error'
          );
        });
    }
  });
}

document.getElementById('tanggal').valueAsDate = new Date();

function exportTableToPDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF('p', 'pt', 'a4');

  html2canvas(document.getElementById('tableProducts')).then(canvas => {
    const imgData = canvas.toDataURL('image/png');
    const imgProps = doc.getImageProperties(imgData);
    const pdfWidth = doc.internal.pageSize.getWidth();
    const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

    doc.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
    doc.save('laporan-analitik.pdf');
  });
}

// function updateFilterYearsAnalitik() {
//   const year = document.getElementById('tahun').value;
//   const baseUrl = "analitik";

//   if (year === "") {
//     window.location.href = baseUrl;
//   } else {
//     window.location.href = baseUrl + '?year=' + year;
//   }
// }

// function updateFilterMountAnalitik() {
//   const month = document.getElementById('monthFilter').value;
//   // const year = document.getElementById('tahun').value;
//   const baseUrl = "analitik";

//   // if( month !== "" && year !== "") {
//   //   if(year != ""){
//   //     window.location.href = baseUrl + '?month=' + month + '&year=' + year;
//   //   }else {
//   //     window.location.href = baseUrl + '?month=' + month + '&year=' + year;
//   //   }
//   // }else {
//   //   window.location.href = baseUrl;
//   // }
//   if (month === "") {
//     window.location.href = baseUrl;
//   } else {
//     window.location.href = baseUrl + '?month=' + month;
//   }
// }

function updateFilterMountAnalitik() {
  const month = document.getElementById('monthFilter').value;
  const year = document.getElementById('tahun').value;
  const baseUrl = "analitik";
  let queryParams = [];

  if (month !== "") {
    queryParams.push("month=" + month);
  }

  if (year !== "") {
    queryParams.push("year=" + year);
  }

  console.log('Query parameters:', queryParams);
  const finalUrl = queryParams.length > 0 ? baseUrl + "?" + queryParams.join("&") : baseUrl;

  window.location.href = finalUrl;
}

function exportNota() {
  const table = $('#tableUsers').DataTable({
    destroy: true,
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'pdfHtml5',
        text: 'Export ke PDF',
        title: '', // Kosongkan agar tidak double judul
        orientation: 'portrait',
        pageSize: 'A4',
        exportOptions: {
          columns: ':visible:not(:last-child)'
        },
        customize: function (doc) {
          // Ubah margin halaman
          doc.pageMargins = [40, 100, 40, 40];

          // Tambahkan header instansi di atas halaman
          doc.content.unshift({
            stack: [
              { text: 'BENGKEL SINAR MOTOR', style: 'header' },
              { text: 'KECAMATAN ENREKANG', style: 'subheader' },
              { text: 'KABUPATEN ENREKANG', style: 'subheader' },
              { text: 'Jl. KEMAKMURAN No. 24  Tlp. (0404) ...... ENREKANG', style: 'small' },
              { text: ' ', margin: [0, 4] },
              { text: 'LAPORAN NOTA PENJUALAN', style: 'title' },
              { text: ' ', margin: [0, 8] }
            ],
            alignment: 'center'
          });

          // Atur lebar kolom (opsional jika perlu)
          doc.content[1].table.widths = ['15%', '45%', '40%'];

          // Tambahkan garis pada semua sel tabel
          var objLayout = {};
          objLayout['hLineWidth'] = function () { return 0.5; };
          objLayout['vLineWidth'] = function () { return 0.5; };
          objLayout['hLineColor'] = function () { return '#aaa'; };
          objLayout['vLineColor'] = function () { return '#aaa'; };
          objLayout['paddingLeft'] = function () { return 8; };
          objLayout['paddingRight'] = function () { return 8; };
          doc.content[1].layout = objLayout;

          // Tambahkan style
          doc.styles = {
            header: {
              fontSize: 14,
              bold: true,
              alignment: 'center'
            },
            subheader: {
              fontSize: 12,
              bold: true,
              alignment: 'center'
            },
            small: {
              fontSize: 10,
              alignment: 'center'
            },
            title: {
              fontSize: 12,
              bold: true,
              alignment: 'center',
              decoration: 'underline'
            },
            tableHeader: {
              bold: true,
              fontSize: 11,
              color: 'black',
              fillColor: '#f2f2f2',
              alignment: 'center'
            }
          };
        }
      }
    ],
    ordering: false,
    paging: false,
    searching: false,
    info: false
  });

  table.button('.buttons-pdf').trigger();
}
