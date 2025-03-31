<header
    class="flex justify-between items-center px-8 py-4 bg-gradient-to-r from-[#2b2d42] to-[#4361ee] shadow-lg text-white sticky top-0 z-50 transition-all duration-300">
    <a href="index.php" class="flex items-center text-2xl font-bold hover:scale-105 transition-transform duration-300">
        <i class="fas fa-tools mr-3 text-3xl text-[#3a86ff] drop-shadow-md"></i>
        <span class="bg-clip-text text-transparent bg-gradient-to-r from-white to-[#a8dadc]">Quick Gear</span>
    </a>
    <nav class="flex gap-5">
        <a id="nav-browse" href="browse.php"
            class="nav-link bg-white/10 text-white border-none py-3 px-6 rounded-full font-semibold cursor-pointer transition-all duration-300 ease-in-out hover:bg-white/20 hover:-translate-y-0.5 hover:shadow-md flex items-center">
            <i class="fas fa-search mr-2 text-[#a8dadc]"></i>
            Browse
        </a>
        <a id="nav-home" href="index.php"
            class="nav-link bg-white/20 text-white border-none py-3 px-6 rounded-full font-semibold cursor-pointer transition-all duration-300 ease-in-out hover:bg-white/30 hover:-translate-y-0.5 shadow-lg shadow-white/10 flex items-center">
            <i class="fas fa-home mr-2 text-[#a8dadc]"></i>
            Home
        </a>
        <a id="nav-bookings" href="bookings.php"
            class="nav-link bg-white/10 text-white border-none py-3 px-6 rounded-full font-semibold cursor-pointer transition-all duration-300 ease-in-out hover:bg-white/20 hover:-translate-y-0.5 hover:shadow-md flex items-center">
            <i class="fas fa-calendar-alt mr-2 text-[#a8dadc]"></i>
            Bookings
        </a>
    </nav>
    <a id="nav-user" href="index.php"
        class="user-btn relative bg-[#3a86ff] text-white border-none py-3 px-6 rounded-full font-semibold cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#a8dadc] hover:text-[#2b2d42] hover:-translate-y-0.5 hover:shadow-lg flex items-center gap-2 overflow-hidden group">
        <span class="relative z-10">User</span>
        <span
            class="absolute inset-0 bg-gradient-to-r from-[#3a86ff] to-[#a8dadc] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
        <i class="fas fa-user relative z-10"></i>
    </a>
</header>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const header = document.querySelector('header');
        let lastScrollTop = 0;
        window.addEventListener('scroll', function () {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollTop > 100) {
                header.classList.add('py-2', 'shadow-xl');
                header.classList.remove('py-4');
            } else {
                header.classList.add('py-4');
                header.classList.remove('py-2', 'shadow-xl');
            }
            if (scrollTop > lastScrollTop && scrollTop > 300) {
                header.style.transform = 'translateY(-100%)';
            } else {
                header.style.transform = 'translateY(0)';
            }
            lastScrollTop = scrollTop;
        });
        const navLinks = document.querySelectorAll('.nav-link');
        const currentPage = window.location.pathname.split('/').pop();
        navLinks.forEach(link => {
            const linkPage = link.getAttribute('href');
            if (currentPage === linkPage || (currentPage === '' && linkPage === 'index.php')) {
                link.classList.add('bg-white/40');
                link.classList.remove('bg-white/20', 'hover:bg-white/30');
                link.classList.add('hover:bg-white/50');
            }
        });
    });
</script>