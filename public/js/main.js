// Mobile Navigation
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileNavClose = document.getElementById('mobileNavClose');
    const mobileNav = document.getElementById('mobileNav');
    
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileNav.classList.add('active');
        });
    }
    
    if (mobileNavClose) {
        mobileNavClose.addEventListener('click', function() {
            mobileNav.classList.remove('active');
        });
    }
    
    // Header scroll effect
    const header = document.querySelector('.header');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
    
    // Product tabs (if on product detail page)
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    if (tabBtns.length > 0) {
        tabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                
                // Remove active class from all tabs
                tabBtns.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Add active class to current tab
                this.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });
    }
    
    // Product quantity buttons (if on product detail page)
    const quantityPlus = document.querySelector('.quantity-btn.plus');
    const quantityMinus = document.querySelector('.quantity-btn.minus');
    const quantityInput = document.getElementById('quantity');
    
    if (quantityPlus && quantityMinus && quantityInput) {
        quantityPlus.addEventListener('click', function() {
            const max = parseInt(quantityInput.getAttribute('max'));
            let value = parseInt(quantityInput.value);
            
            if (value < max) {
                quantityInput.value = value + 1;
            }
        });
        
        quantityMinus.addEventListener('click', function() {
            let value = parseInt(quantityInput.value);
            
            if (value > 1) {
                quantityInput.value = value - 1;
            }
        });
    }
});