// JavaScript for AGENT 24 INDIA Header Interactions

document.addEventListener('DOMContentLoaded', () => {
    const siteHeader = document.getElementById('siteHeader');
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mainNav = document.getElementById('mainNav');
    const navItems = document.querySelectorAll('.nav-item');
    const dropdownItems = document.querySelectorAll('.dropdown-item');

    // Sticky header shadow on scroll
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            siteHeader.classList.add('scrolled');
        } else {
            siteHeader.classList.remove('scrolled');
        }
    });

    const rightDrawerMenu = document.getElementById('rightDrawerMenu');
    const rightDrawerOverlay = document.getElementById('rightDrawerOverlay');
    const drawerCloseBtn = document.getElementById('drawerCloseBtn');

    function openRightDrawer() {
        if (rightDrawerMenu) rightDrawerMenu.classList.add('active');
        if (rightDrawerOverlay) rightDrawerOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeRightDrawer() {
        if (rightDrawerMenu) rightDrawerMenu.classList.remove('active');
        if (rightDrawerOverlay) rightDrawerOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    const headerMenuBtn = document.getElementById('headerMenuBtn');

    if (hamburgerBtn) {
        hamburgerBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            openRightDrawer();
        });
    }

    if (headerMenuBtn) {
        headerMenuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            openRightDrawer();
        });
    }

    if (drawerCloseBtn) {
        drawerCloseBtn.addEventListener('click', closeRightDrawer);
    }

    if (rightDrawerOverlay) {
        rightDrawerOverlay.addEventListener('click', closeRightDrawer);
    }

    // Active state switching on click
    navItems.forEach(item => {
        item.addEventListener('click', (e) => {
            // Only switch active tab if not clicking inside a dropdown on desktop
            if (!item.classList.contains('dropdown-item') || window.innerWidth <= 900) {
                navItems.forEach(nav => nav.classList.remove('active'));
                
                // Remove existing active bar
                const existingBar = document.querySelector('.active-bar');
                if (existingBar) existingBar.remove();

                item.classList.add('active');
                
                // Append active bar
                const bar = document.createElement('span');
                bar.className = 'active-bar';
                item.appendChild(bar);
            }
        });
    });

    // Mobile dropdown toggle on click
    dropdownItems.forEach(item => {
        const link = item.querySelector('.nav-link');
        link.addEventListener('click', (e) => {
            if (window.innerWidth <= 900) {
                e.preventDefault();
                item.classList.toggle('open');
            }
        });
    });

    // Search Form Interactive Action
    const agentSearchForm = document.getElementById('agentSearchForm');
    const searchAgentBtn = document.getElementById('searchAgentBtn');

    if (agentSearchForm) {
        agentSearchForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const type = document.getElementById('agentTypeSelect').value;
            const city = document.getElementById('cityInput').value;
            const category = document.getElementById('categorySelect').value;

            // Visual feedback on button click
            const originalText = searchAgentBtn.innerHTML;
            searchAgentBtn.innerHTML = `
                <svg class="spin-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="2" x2="12" y2="6"></line>
                    <line x1="12" y1="18" x2="12" y2="22"></line>
                    <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
                    <line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
                    <line x1="2" y1="12" x2="6" y2="12"></line>
                    <line x1="18" y1="12" x2="22" y2="12"></line>
                    <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
                    <line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
                </svg>
                <span>Khoj Rahe Hain...</span>
            `;
            searchAgentBtn.style.opacity = '0.9';

            setTimeout(() => {
                searchAgentBtn.innerHTML = originalText;
                searchAgentBtn.style.opacity = '1';

                // Display success toast badge
                showToast(`Search for ${city} loaded! Verified Agents matching your criteria found.`);
            }, 800);
        });
    }

    // Category Card Click Interaction
    const categoryCards = document.querySelectorAll('.category-card');
    categoryCards.forEach(card => {
        card.addEventListener('click', (e) => {
            e.preventDefault();
            const catTitle = card.querySelector('.category-title').textContent;
            showToast(`Category Selected: "${catTitle}". Finding best Agents...`);
            
            // Smooth scroll to search form
            const searchForm = document.getElementById('agentSearchForm');
            if (searchForm) {
                searchForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    });

    // Top Verified Agents Carousel Controls
    const agentsSliderTrack = document.getElementById('agentsSliderTrack');
    const agentPrevBtn = document.getElementById('agentPrevBtn');
    const agentNextBtn = document.getElementById('agentNextBtn');

    if (agentsSliderTrack && agentPrevBtn && agentNextBtn) {
        agentPrevBtn.addEventListener('click', () => {
            const cardWidth = agentsSliderTrack.querySelector('.agent-card')?.offsetWidth || 230;
            agentsSliderTrack.scrollBy({
                left: -(cardWidth * 2),
                behavior: 'smooth'
            });
        });

        agentNextBtn.addEventListener('click', () => {
            const cardWidth = agentsSliderTrack.querySelector('.agent-card')?.offsetWidth || 230;
            agentsSliderTrack.scrollBy({
                left: cardWidth * 2,
                behavior: 'smooth'
            });
        });
    }

    // View Profile & Call Now click notifications
    const viewProfileBtns = document.querySelectorAll('.btn-agent-outlined');
    const callNowBtns = document.querySelectorAll('.btn-agent-filled');

    viewProfileBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const card = btn.closest('.agent-card');
            const name = card.querySelector('.agent-name').textContent;
            showToast(`Opening profile for ${name}...`);
        });
    });

    callNowBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const card = btn.closest('.agent-card');
            const name = card.querySelector('.agent-name').textContent;
            showToast(`Initiating call with ${name}...`);
        });
    });

    // Rajasthan Districts Carousel Controls
    const districtSliderTrack = document.getElementById('districtSliderTrack');
    const districtPrevBtn = document.getElementById('districtPrevBtn');
    const districtNextBtn = document.getElementById('districtNextBtn');

    if (districtSliderTrack && districtPrevBtn && districtNextBtn) {
        districtPrevBtn.addEventListener('click', () => {
            const cardWidth = districtSliderTrack.querySelector('.district-card')?.offsetWidth || 210;
            districtSliderTrack.scrollBy({
                left: -(cardWidth * 2),
                behavior: 'smooth'
            });
        });

        districtNextBtn.addEventListener('click', () => {
            const cardWidth = districtSliderTrack.querySelector('.district-card')?.offsetWidth || 210;
            districtSliderTrack.scrollBy({
                left: cardWidth * 2,
                behavior: 'smooth'
            });
        });
    }

    // District Explore button clicks
    const exploreDistrictBtns = document.querySelectorAll('.btn-explore-district');
    exploreDistrictBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const card = btn.closest('.district-card');
            const cityName = card.querySelector('.district-name').textContent;
            showToast(`Exploring Verified Agents in ${cityName}...`);
        });
    });

    // Testimonials Carousel Slider Controls
    const testimonialSliderTrack = document.getElementById('testimonialSliderTrack');
    const testimonialPrevBtn = document.getElementById('testimonialPrevBtn');
    const testimonialNextBtn = document.getElementById('testimonialNextBtn');

    if (testimonialSliderTrack && testimonialPrevBtn && testimonialNextBtn) {
        testimonialPrevBtn.addEventListener('click', () => {
            const cardWidth = testimonialSliderTrack.querySelector('.testimonial-card')?.offsetWidth || 320;
            testimonialSliderTrack.scrollBy({
                left: -cardWidth,
                behavior: 'smooth'
            });
        });

        testimonialNextBtn.addEventListener('click', () => {
            const cardWidth = testimonialSliderTrack.querySelector('.testimonial-card')?.offsetWidth || 320;
            testimonialSliderTrack.scrollBy({
                left: cardWidth,
                behavior: 'smooth'
            });
        });
    }

    // View All Districts button click
    const btnAllDistricts = document.querySelector('.btn-all-districts');
    if (btnAllDistricts) {
        btnAllDistricts.addEventListener('click', (e) => {
            e.preventDefault();
            showToast('Loading full directory of Rajasthan Districts & Cities...');
        });
    }

    // Yellow Register Button click
    const btnRegisterYellow = document.querySelector('.btn-register-yellow');
    if (btnRegisterYellow) {
        btnRegisterYellow.addEventListener('click', (e) => {
            window.location.href = 'register.html';
        });
    }

    // Helper function for quick toast notification
    function showToast(message) {
        let toast = document.querySelector('.search-toast');
        if (!toast) {
            toast = document.createElement('div');
            toast.className = 'search-toast';
            document.body.appendChild(toast);
        }
        toast.textContent = message;
        toast.classList.add('show');

        setTimeout(() => {
            toast.classList.remove('show');
        }, 3500);
    }
});


