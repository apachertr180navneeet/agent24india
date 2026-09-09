/*
Template Name: ClassiGrids - Classified Ads and Listing Website Template.
Author: GrayGrids
*/

(function () {

	"use strict";

	//===== Prealoder
	window.onload = function () {
		window.setTimeout(fadeout, 200);
	}

    function fadeout() {
        const preloader = document.querySelector('.preloader');
        if (preloader) {
            preloader.style.opacity = '0';
            preloader.style.display = 'none';
        }
    }
    
})();

const tabButtons = document.querySelectorAll(".tab-btn");
const cards = document.querySelectorAll(".single-grid");

if (tabButtons.length > 0) {
    tabButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            tabButtons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");

            const filter = btn.getAttribute("data-filter");

            cards.forEach(card => {
                const category = card.getAttribute("data-category");
                if (category && category.includes(filter)) {
                    if (card.parentElement) card.parentElement.style.display = "block";
                } else {
                    if (card.parentElement) card.parentElement.style.display = "none";
                }
            });
        });
    });
}

const slides = document.querySelectorAll(".slide");
const prev = document.querySelector(".prev");
const next = document.querySelector(".next");
const dotsContainer = document.querySelector(".dots");

let index = 0;
let interval;

/* Create dots */
if (slides && slides.length > 0 && dotsContainer) {
    slides.forEach((_, i) => {
        const dot = document.createElement("span");
        if (i === 0) dot.classList.add("active");
        dot.addEventListener("click", () => goToSlide(i));
        dotsContainer.appendChild(dot);
    });
}

function showSlide(i) {
    if (!slides || slides.length === 0) return;
    const dots = document.querySelectorAll(".dots span");
    slides.forEach(slide => slide.classList.remove("active"));
    dots.forEach(dot => dot.classList.remove("active"));
    if (slides[i]) slides[i].classList.add("active");
    if (dots[i]) dots[i].classList.add("active");
    index = i;
}

function nextSlide() {
    if (!slides || slides.length === 0) return;
    showSlide((index + 1) % slides.length);
}

function prevSlide() {
    if (!slides || slides.length === 0) return;
    showSlide((index - 1 + slides.length) % slides.length);
}

function goToSlide(i) {
    showSlide(i);
    resetAuto();
}

/* Auto slide */
function startAuto() {
    if (slides && slides.length > 1) {
        interval = setInterval(nextSlide, 4000);
    }
}

function resetAuto() {
    clearInterval(interval);
    startAuto();
}

if (next) {
    next.addEventListener("click", () => {
        nextSlide();
        resetAuto();
    });
}

if (prev) {
    prev.addEventListener("click", () => {
        prevSlide();
        resetAuto();
    });
}

if (next && prev && slides && slides.length > 1) {
    startAuto();
}

const toggle = document.getElementById("menuToggle");
const sideMenu = document.getElementById("sideMenu");
const overlay = document.getElementById("menuOverlay");
const closeBtn = document.getElementById("closeMenu");

function closeMenu() {
    if (sideMenu) sideMenu.classList.remove("active");
    if (overlay) overlay.classList.remove("active");
}

if (toggle && sideMenu && overlay) {
    toggle.addEventListener("click", () => {
        sideMenu.classList.add("active");
        overlay.classList.add("active");
    });
}

if (overlay) {
    overlay.addEventListener("click", closeMenu);
}

if (closeBtn) {
    closeBtn.addEventListener("click", closeMenu);
}

document.addEventListener("DOMContentLoaded", () => {
    initAuthPopup();
});

function initAuthPopup() {
    const overlay = document.getElementById("authOverlay");
    if (!overlay) return;

    // Open popup
    document.querySelectorAll(".open-signin").forEach(btn => {
        btn.addEventListener("click", () => {
            overlay.style.display = "flex";
        });
    });

    // Close button
    const closeBtn1 = document.querySelector(".close-btn1");
    if (closeBtn1) {
        closeBtn1.addEventListener("click", () => {
            overlay.style.display = "none";
        });
    }

    // Close on outside click
    overlay.addEventListener("click", (e) => {
        if (e.target === overlay) {
            overlay.style.display = "none";
        }
    });

    // Tabs switch
    document.querySelectorAll(".tab").forEach(tab => {
        tab.addEventListener("click", () => {
            document.querySelectorAll(".tab, .auth-form").forEach(el => el.classList.remove("active"));
            tab.classList.add("active");
            const target = document.getElementById(tab.dataset.tab);
            if (target) {
                target.classList.add("active");
            }
        });
    });
}
