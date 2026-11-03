/**
 * IndiaSteel Interactive Engine
 * Handles Hero Image Slider, Ribbon Quick Quote, Category Filters & WhatsApp Dispatch
 */

document.addEventListener('DOMContentLoaded', function () {
  const WHATSAPP_PHONE = '919876543210';

  // 1. Hero Image Slider Logic
  const slider = document.querySelector('.steel-hero-slider-wrap');
  if (slider) {
    const slides = slider.querySelectorAll('.steel-slide');
    const dots = slider.querySelectorAll('.slider-dot');
    const prevBtn = slider.querySelector('.slider-arrow.prev');
    const nextBtn = slider.querySelector('.slider-arrow.next');
    let currentIndex = 0;
    let autoSlideTimer = null;
    const SLIDE_DURATION = 5500; // 5.5 seconds

    function goToSlide(index) {
      if (index < 0) {
        index = slides.length - 1;
      } else if (index >= slides.length) {
        index = 0;
      }

      slides.forEach((slide, i) => {
        if (i === index) {
          slide.classList.add('active');
        } else {
          slide.classList.remove('active');
        }
      });

      dots.forEach((dot, i) => {
        if (i === index) {
          dot.classList.add('active');
        } else {
          dot.classList.remove('active');
        }
      });

      currentIndex = index;
    }

    function nextSlide() {
      goToSlide(currentIndex + 1);
    }

    function prevSlide() {
      goToSlide(currentIndex - 1);
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', function () {
        nextSlide();
        resetAutoSlide();
      });
    }

    if (prevBtn) {
      prevBtn.addEventListener('click', function () {
        prevSlide();
        resetAutoSlide();
      });
    }

    dots.forEach((dot, i) => {
      dot.addEventListener('click', function () {
        goToSlide(i);
        resetAutoSlide();
      });
    });

    function startAutoSlide() {
      if (!autoSlideTimer) {
        autoSlideTimer = setInterval(nextSlide, SLIDE_DURATION);
      }
    }

    function stopAutoSlide() {
      if (autoSlideTimer) {
        clearInterval(autoSlideTimer);
        autoSlideTimer = null;
      }
    }

    function resetAutoSlide() {
      stopAutoSlide();
      startAutoSlide();
    }

    slider.addEventListener('mouseenter', stopAutoSlide);
    slider.addEventListener('mouseleave', startAutoSlide);

    // Initial start
    startAutoSlide();
  }

  // 2. Mobile Navigation Toggle
  const navToggle = document.querySelector('.mobile-nav-toggle');
  const mainNav = document.querySelector('.indiasteel-nav');
  if (navToggle && mainNav) {
    navToggle.addEventListener('click', function () {
      mainNav.classList.toggle('is-open');
    });
  }

  // 3. Product Category Filter Tabs
  const filterBtns = document.querySelectorAll('.tab-filter-btn');
  const productCards = document.querySelectorAll('.steel-product-card');

  if (filterBtns.length > 0 && productCards.length > 0) {
    filterBtns.forEach(btn => {
      btn.addEventListener('click', function () {
        filterBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const targetCategory = this.getAttribute('data-filter');

        productCards.forEach(card => {
          const cardType = card.getAttribute('data-category');
          if (targetCategory === 'all' || cardType === targetCategory) {
            card.style.display = 'flex';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  }

  // 3b. Showcase Gallery Filter Tabs
  const showcaseTabs = document.querySelectorAll('.showcase-tab-btn');
  const showcaseItems = document.querySelectorAll('.showcase-item-card');

  if (showcaseTabs.length > 0 && showcaseItems.length > 0) {
    showcaseTabs.forEach(btn => {
      btn.addEventListener('click', function () {
        showcaseTabs.forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const target = this.getAttribute('data-filter');

        showcaseItems.forEach(card => {
          const cardCat = card.getAttribute('data-category');
          if (target === 'all' || cardCat === target) {
            card.style.display = 'flex';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  }

  // 3c. Bento Gallery Filter Tabs & Interactive Lightbox Modal
  const bentoFilterPills = document.querySelectorAll('.bento-filter-pill');
  const bentoCards = document.querySelectorAll('.bento-card');
  const bentoLightbox = document.getElementById('bentoLightbox');

  if (bentoFilterPills.length > 0 && bentoCards.length > 0) {
    bentoFilterPills.forEach(pill => {
      pill.addEventListener('click', function () {
        bentoFilterPills.forEach(p => p.classList.remove('active'));
        this.classList.add('active');

        const target = this.getAttribute('data-filter');

        bentoCards.forEach(card => {
          const cardCat = card.getAttribute('data-category');
          if (target === 'all' || cardCat === target) {
            card.style.display = '';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  }

  // Bento Lightbox Preview Logic
  if (bentoLightbox && bentoCards.length > 0) {
    const lightboxImg = document.getElementById('lightboxImg');
    const lightboxTitle = document.getElementById('lightboxTitle');
    const lightboxDesc = document.getElementById('lightboxDesc');
    const lightboxClose = bentoLightbox.querySelector('.bento-lightbox-close');
    const lightboxBackdrop = bentoLightbox.querySelector('.bento-lightbox-backdrop');

    function openLightbox(card) {
      const imgSrc = card.getAttribute('data-img') || card.querySelector('.bento-img')?.src;
      const title = card.getAttribute('data-title') || '';
      const desc = card.getAttribute('data-desc') || '';

      if (lightboxImg) lightboxImg.src = imgSrc;
      if (lightboxTitle) lightboxTitle.innerHTML = title;
      if (lightboxDesc) lightboxDesc.textContent = desc;

      bentoLightbox.classList.add('is-active');
      document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
      bentoLightbox.classList.remove('is-active');
      document.body.style.overflow = '';
      if (lightboxImg) lightboxImg.src = '';
    }

    bentoCards.forEach(card => {
      card.addEventListener('click', function (e) {
        // If clicking on direct WhatsApp or phone link, allow navigation without opening modal
        if (e.target.closest('.bento-cta-btn')) {
          return;
        }
        openLightbox(this);
      });
    });

    if (lightboxClose) {
      lightboxClose.addEventListener('click', closeLightbox);
    }
    if (lightboxBackdrop) {
      lightboxBackdrop.addEventListener('click', closeLightbox);
    }
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && bentoLightbox.classList.contains('is-active')) {
        closeLightbox();
      }
    });
  }

  // 4. Quick Enquiry Ribbon & Interactive Forms Submission
  const enquiryForms = document.querySelectorAll('.indiasteel-interactive-form, .ribbon-form');
  enquiryForms.forEach(form => {
    form.addEventListener('submit', function (e) {
      e.preventDefault();

      const type = form.querySelector('[name="deal_type"]')?.value || 
                   form.querySelector('input[name="deal_type"]:checked')?.value || 'General Trade Enquiry';
      const name = form.querySelector('[name="client_name"]')?.value || 'Buyer/Seller';
      const phone = form.querySelector('[name="client_phone"]')?.value || '';
      const category = form.querySelector('[name="material_category"]')?.value || 'Steel/Scrap';
      const qty = form.querySelector('[name="estimated_tonnage"]')?.value || 'Standard Bulk';
      const location = form.querySelector('[name="client_location"]')?.value || 'India';

      const messageText = `*IndiaSteel Trade Inquiry*%0A` +
        `----------------------------%0A` +
        `*Deal Type:* ${encodeURIComponent(type)}%0A` +
        `*Name/Company:* ${encodeURIComponent(name)}%0A` +
        `*Phone:* ${encodeURIComponent(phone)}%0A` +
        `*Material Required:* ${encodeURIComponent(category)}%0A` +
        `*Quantity:* ${encodeURIComponent(qty)}%0A` +
        `*Delivery/Yard Location:* ${encodeURIComponent(location)}%0A` +
        `----------------------------%0A` +
        `Please confirm today's spot rate and availability.`;

      const waUrl = `https://wa.me/${WHATSAPP_PHONE}?text=${messageText}`;

      // Open WhatsApp in new tab
      window.open(waUrl, '_blank');

      // Visual Confirmation on button
      const submitBtn = form.querySelector('button[type="submit"]');
      if (submitBtn) {
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fa-solid fa-check"></i> Dispatched to WhatsApp Desk!';
        submitBtn.style.background = '#25d366';
        submitBtn.style.color = '#000000';
        setTimeout(() => {
          submitBtn.innerHTML = originalText;
          submitBtn.style.background = '';
          submitBtn.style.color = '';
        }, 4000);
      }
    });
  });

  // 5. Product Card "Enquire Rate" Button
  const enquireButtons = document.querySelectorAll('.btn-enquire-card');
  enquireButtons.forEach(btn => {
    btn.addEventListener('click', function () {
      const productName = this.getAttribute('data-product');
      const ribbon = document.querySelector('.quick-enquiry-ribbon');
      if (ribbon) {
        const select = ribbon.querySelector('[name="material_category"]');
        if (select) {
          select.value = productName;
        }
        ribbon.scrollIntoView({ behavior: 'smooth', block: 'center' });
      } else {
        const text = encodeURIComponent(`Hello IndiaSteel, I would like to enquire about bulk prices for: ${productName}`);
        window.open(`https://wa.me/${WHATSAPP_PHONE}?text=${text}`, '_blank');
      }
    });
  });
});
