// JavaScript for AGENT 24 INDIA Header & UI Interactions

document.addEventListener('DOMContentLoaded', () => {
    const siteHeader = document.getElementById('siteHeader');
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mainNav = document.getElementById('mainNav');
    const dropdownItems = document.querySelectorAll('.dropdown-item');

    // Sticky header shadow on scroll
    window.addEventListener('scroll', () => {
        if (siteHeader) {
            if (window.scrollY > 20) {
                siteHeader.classList.add('scrolled');
            } else {
                siteHeader.classList.remove('scrolled');
            }
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
    const mobileHeaderMenuBtn = document.getElementById('mobileHeaderMenuBtn');

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

    if (mobileHeaderMenuBtn) {
        mobileHeaderMenuBtn.addEventListener('click', (e) => {
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

    // Mobile dropdown toggle on click
    dropdownItems.forEach(item => {
        const link = item.querySelector('.nav-link');
        if (link) {
            link.addEventListener('click', (e) => {
                if (window.innerWidth <= 900) {
                    item.classList.toggle('open');
                }
            });
        }
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

    // Mobile Verified Agent Slider Track Controls
    const mAgentSliderTrack = document.getElementById('mAgentSliderTrack');
    const mAgentPrevBtn = document.getElementById('mAgentPrevBtn');
    const mAgentNextBtn = document.getElementById('mAgentNextBtn');

    if (mAgentSliderTrack && mAgentPrevBtn && mAgentNextBtn) {
        mAgentPrevBtn.addEventListener('click', () => {
            const cardWidth = mAgentSliderTrack.querySelector('.m-agent-slide-card')?.offsetWidth || 300;
            mAgentSliderTrack.scrollBy({
                left: -cardWidth,
                behavior: 'smooth'
            });
        });

        mAgentNextBtn.addEventListener('click', () => {
            const cardWidth = mAgentSliderTrack.querySelector('.m-agent-slide-card')?.offsetWidth || 300;
            mAgentSliderTrack.scrollBy({
                left: cardWidth,
                behavior: 'smooth'
            });
        });
    }

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

    // 1. Grid/List View Toggle on Listing page
    const viewListBtn = document.getElementById('viewListBtn');
    const viewGridBtn = document.getElementById('viewGridBtn');
    const agentsResultsContainer = document.getElementById('agentsResultsContainer');

    if (viewListBtn && viewGridBtn && agentsResultsContainer) {
        viewListBtn.addEventListener('click', () => {
            viewListBtn.classList.add('active');
            viewGridBtn.classList.remove('active');
            agentsResultsContainer.classList.remove('grid-view');
        });

        viewGridBtn.addEventListener('click', () => {
            viewGridBtn.classList.add('active');
            viewListBtn.classList.remove('active');
            agentsResultsContainer.classList.add('grid-view');
        });
    }

    // 2. Favorite Heart Button Toggle
    const heartButtons = document.querySelectorAll('.btn-favorite-heart');
    heartButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const svg = btn.querySelector('svg');
            const isSaved = btn.getAttribute('data-saved') === 'true';
            
            if (isSaved) {
                btn.setAttribute('data-saved', 'false');
                if (svg) {
                    svg.setAttribute('fill', 'none');
                    svg.setAttribute('stroke', '#94A3B8');
                }
            } else {
                btn.setAttribute('data-saved', 'true');
                if (svg) {
                    svg.setAttribute('fill', '#E11D48');
                    svg.setAttribute('stroke', '#E11D48');
                }
            }
        });
    });

    // 3. Header Search Action Capsule on Listing page
    const hscSearchBtn = document.getElementById('hscSearchBtn');
    if (hscSearchBtn) {
        hscSearchBtn.addEventListener('click', () => {
            const cat = document.getElementById('hscCategorySelect') ? document.getElementById('hscCategorySelect').value : '';
            const loc = document.getElementById('hscDistrictSelect') ? document.getElementById('hscDistrictSelect').value : '';
            
            let url = window.location.pathname;
            let params = new URLSearchParams(window.location.search);
            if (cat) params.set('category', cat); else params.delete('category');
            if (loc) params.set('location', loc); else params.delete('location');
            params.delete('page');
            window.location.href = url + '?' + params.toString();
        });
    }
});
