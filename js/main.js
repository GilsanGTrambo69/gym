(function($) {
    "use strict";

    // Preloader
    $(window).on('load', function() {
        $("#preloader").fadeOut(500);
    });

    // Sticky Header
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 100) {
            $('.header').addClass('sticky');
        } else {
            $('.header').removeClass('sticky');
        }
    });

    // Mobile Menu Toggle
    $('.mobile-menu-toggle').on('click', function() {
        $('.mobile-menu').addClass('active');
    });

    $('.close-btn').on('click', function() {
        $('.mobile-menu').removeClass('active');
    });

    // Search Modal
    $('.search-btn').on('click', function(e) {
        e.preventDefault();
        $('.search-modal').addClass('active');
    });

    $('.search-close').on('click', function() {
        $('.search-modal').removeClass('active');
    });

    // Hero Slider
    let currentSlide = 0;
    const slides = $('.hero-slide');
    const slideCount = slides.length;
    
    function showSlide(index) {
        slides.css('display', 'none');
        slides.eq(index).css('display', 'flex');
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % slideCount;
        showSlide(currentSlide);
    }
    
    function prevSlide() {
        currentSlide = (currentSlide - 1 + slideCount) % slideCount;
        showSlide(currentSlide);
    }
    
    // Initialize slider
    showSlide(currentSlide);
    
    // Auto slide
    setInterval(nextSlide, 5000);
    
    // Control buttons
    $('.next-btn').on('click', function() {
        nextSlide();
    });
    
    $('.prev-btn').on('click', function() {
        prevSlide();
    });

    // Gallery Popup
    $('.gallery-popup').on('click', function(e) {
        e.preventDefault();
        const imageUrl = $(this).attr('href');
        
        // Create modal
        const modal = $('<div class="gallery-modal"></div>');
        const closeBtn = $('<div class="gallery-close"><i class="fa-solid fa-xmark"></i></div>');
        const image = $('<img src="' + imageUrl + '" alt="Gallery Image">');
        
        modal.append(closeBtn);
        modal.append(image);
        $('body').append(modal);
        
        // Show modal
        setTimeout(function() {
            modal.addClass('active');
        }, 100);
        
        // Close modal
        closeBtn.on('click', function() {
            modal.removeClass('active');
            setTimeout(function() {
                modal.remove();
            }, 300);
        });
    });

    // Add gallery modal styles
    const galleryModalStyles = `
        .gallery-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .gallery-modal.active {
            opacity: 1;
            visibility: visible;
        }
        
        .gallery-close {
            position: absolute;
            top: 30px;
            right: 30px;
            color: #fff;
            font-size: 30px;
            cursor: pointer;
        }
        
        .gallery-modal img {
            max-width: 90%;
            max-height: 90%;
            border: 5px solid #fff;
        }
    `;
    
    $('<style>').text(galleryModalStyles).appendTo('head');

    // Smooth scroll for anchor links
    $('a[href^="#"]').on('click', function(e) {
        const target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 70
            }, 1000);
        }
    });

    // Team slider controls
    let currentTeamPage = 0;
    const teamCards = $('.team-card');
    const cardsPerPage = 4;
    const totalPages = Math.ceil(teamCards.length / cardsPerPage);
    
    function showTeamPage(page) {
        teamCards.hide();
        for (let i = page * cardsPerPage; i < (page + 1) * cardsPerPage && i < teamCards.length; i++) {
            teamCards.eq(i).show();
        }
    }
    
    // Initialize team slider
    showTeamPage(currentTeamPage);
    
    // Team slider controls
    $('.team-controls .next-btn').on('click', function() {
        currentTeamPage = (currentTeamPage + 1) % totalPages;
        showTeamPage(currentTeamPage);
    });
    
    $('.team-controls .prev-btn').on('click', function() {
        currentTeamPage = (currentTeamPage - 1 + totalPages) % totalPages;
        showTeamPage(currentTeamPage);
    });

})(window.jQuery);