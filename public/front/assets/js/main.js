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
        document.querySelector('.preloader').style.opacity = '0';
        document.querySelector('.preloader').style.display = 'none';
    }
    
})();


const tabButtons = document.querySelectorAll(".tab-btn");
const cards = document.querySelectorAll(".single-grid");

function applyTabFilter(btn) {
    // Active tab
    tabButtons.forEach(b => b.classList.remove("active"));
    btn.classList.add("active");

    const filter = btn.getAttribute("data-filter");

    // Filter cards
    cards.forEach(card => {
        const category = card.getAttribute("data-category");
        card.parentElement.style.display = (category && category.includes(filter)) ? "block" : "none";
    });
}

tabButtons.forEach(btn => {
    btn.addEventListener("click", () => applyTabFilter(btn));
});

// Apply default tab on first load (Premium button is marked active in Blade).
if (tabButtons.length && cards.length) {
    const defaultTab = document.querySelector(".tab-btn.active") || tabButtons[0];
    applyTabFilter(defaultTab);
}

const slides = document.querySelectorAll(".slide");
const prev = document.querySelector(".prev");
const next = document.querySelector(".next");
const dotsContainer = document.querySelector(".dots");

let index = 0;
let interval;

/* Create dots */
if(slides){
slides.forEach((_, i) => {
    const dot = document.createElement("span");
    if (i === 0) dot.classList.add("active");
    dot.addEventListener("click", () => goToSlide(i));
    dotsContainer.appendChild(dot);
});}

const dots = document.querySelectorAll(".dots span");

function showSlide(i) {
    slides.forEach(slide => slide.classList.remove("active"));
    dots.forEach(dot => dot.classList.remove("active"));
    slides[i].classList.add("active");
    dots[i].classList.add("active");
    index = i;
}

function nextSlide() {
    showSlide((index + 1) % slides.length);
}

function prevSlide() {
    showSlide((index - 1 + slides.length) % slides.length);
}

function goToSlide(i) {
    showSlide(i);
    resetAuto();
}

/* Auto slide */
function startAuto() {
    interval = setInterval(nextSlide, 4000);
}

function resetAuto() {
    clearInterval(interval);
    startAuto();
}

if(next){
    next.addEventListener("click", () => {
        nextSlide();
        resetAuto();
    });
}

if(prev){
    prev.addEventListener("click", () => {
        prevSlide();
        resetAuto();
    });
}

if(next && prev){
    startAuto();
}


const toggle = document.getElementById("menuToggle");
const sideMenu = document.getElementById("sideMenu");
const overlay = document.getElementById("menuOverlay");
const closeBtn = document.getElementById("closeMenu");


toggle.addEventListener("click", () => {
    sideMenu.classList.add("active");
    overlay.classList.add("active");
});
function closeMenu() {
    sideMenu.classList.remove("active");
    overlay.classList.remove("active");
}
overlay.addEventListener("click", closeMenu);
closeBtn.addEventListener("click", closeMenu);


document.addEventListener("DOMContentLoaded", () => {

//   fetch("signin-up.html")
//     .then(res => res.text())
//     .then(html => {
//       document.body.insertAdjacentHTML("beforeend", html);
//       initAuthPopup(); // 🔥 important
//     });
initAuthPopup();

});

function initAuthPopup(){

  const overlay = document.getElementById("authOverlay");

  // Open popup
  document.querySelectorAll(".open-signin").forEach(btn => {
    btn.addEventListener("click", () => {
      overlay.style.display = "flex";
    });
  });

  // ✅ FIXED CLOSE BUTTON
  document.querySelector(".close-btn1").addEventListener("click", () => {
    overlay.style.display = "none";
  });

  // ✅ CLOSE ON OUTSIDE CLICK (BONUS)
  overlay.addEventListener("click", (e) => {
    if (e.target === overlay) {
      overlay.style.display = "none";
    }
  });

  // Tabs switch
  document.querySelectorAll(".tab").forEach(tab => {
    tab.addEventListener("click", () => {

      document.querySelectorAll(".tab, .auth-form")
        .forEach(el => el.classList.remove("active"));

      tab.classList.add("active");
      document.getElementById(tab.dataset.tab).classList.add("active");
    });
  });

}


