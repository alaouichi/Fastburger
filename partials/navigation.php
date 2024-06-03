<header class="header bg-yellow-500" style="background-color: #F2B33D;">
  <nav class="container mx-auto px-6 py-3">
    <div class="flex items-center justify-between">
      <div class="text-white font-bold text-xl">
        <img src="FastBurger.png" alt="Logo" style="height: 80px; width: auto;">
      </div>
      <div class="hidden md:block">
        <ul class="flex items-center space-x-8">
          <li><a href="<?= BASE_PATH ?>index" class="montsheading text-brown-custom hover:text-white">Home</a></li>
          <li><a href="<?= BASE_PATH ?>customers" class="montsheading text-brown-custom hover:text-white">Customers</a></li>
          <li><a href="<?= BASE_PATH ?>orders" class="montsheading text-brown-custom hover:text-white">Orders</a></li>
          <li><a href="<?= BASE_PATH ?>inventory" class="montsheading text-brown-custom hover:text-white">Inventory</a></li>
        </ul>
      </div>
      <div class="md:hidden">
        <button class="outline-none mobile-menu-button">
          <svg class="w-6 h-6 text-white" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>
    <div class="mobile-menu hidden md:hidden">
      <ul class="mt-4 space-y-4">
        <li><a href="<?= BASE_PATH ?>index" class="block px-4 py-2 text-brown-custom  rounded hover:text-white">Home</a></li>
        <li><a href="<?= BASE_PATH ?>customers" class="block px-4 py-2 text-brown-custom  rounded hover:text-white">Customers</a></li>
        <li><a href="<?= BASE_PATH ?>orders" class="block px-4 py-2 text-brown-custom  rounded hover:text-white">Orders</a></li>
        <li><a href="<?= BASE_PATH ?>inventory" class="block px-4 py-2 text-brown-custom  rounded hover:text-white">Inventory</a></li>
      </ul>
    </div>
  </nav>
</header>

<script>
  const mobileMenuButton = document.querySelector('.mobile-menu-button');
  const mobileMenu = document.querySelector('.mobile-menu');

  mobileMenuButton.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>