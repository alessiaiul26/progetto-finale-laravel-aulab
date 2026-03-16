import "./bootstrap";
import "bootstrap/dist/js/bootstrap.min.js";
import "./main.js";
// import Swiper bundle with all modules installed
import Swiper from 'swiper/bundle';

// Gestione degli alert nella pagina join-team
document.addEventListener('DOMContentLoaded', function() {
    // Controlla se siamo nella pagina join-team
    if (document.querySelector('.join-team-page')) {
        // Trova tutti gli alert
        const alerts = document.querySelectorAll('.join-team-page .alert');
        
        // Per ogni alert, imposta un timer per farlo scomparire dopo 5 secondi
        alerts.forEach(alert => {
            setTimeout(() => {
                // Aggiungi la classe fade-out
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                
                // Rimuovi l'elemento dopo la transizione
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }, 5000);
        });
    }
});

// Theme Toggle
document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('themeToggle');
    const lightIcon = document.getElementById('lightIcon');
    const darkIcon = document.getElementById('darkIcon');

    // Carica il tema salvato
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
    updateIcons(savedTheme);

    themeToggle.addEventListener('click', function() {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateIcons(newTheme);
    });

    function updateIcons(theme) {
        if (theme === 'dark') {
            lightIcon.classList.add('d-none');
            darkIcon.classList.remove('d-none');
        } else {
            lightIcon.classList.remove('d-none');
            darkIcon.classList.add('d-none');
        }
    }
});

// Inizializza Swiper
document.addEventListener('DOMContentLoaded', function() {
    var swiper1 = new Swiper(".mySwiper1", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    var swiper2 = new Swiper(".mySwiper2", {
        effect: "slide",
        grabCursor: true,
        centeredSlides: false,
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
});
