<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
 
<nav class="flex-no-wrap relative flex w-full items-center justify-between bg-[#FBFBFB] py-2 shadow-md shadow-black/5 dark:bg-neutral-600 dark:shadow-black/10 lg:flex-wrap lg:justify-start lg:py-4">
  <div class="flex w-full flex-wrap items-center justify-between px-3">
    
    {{-- breadcrumb --}}
    <div class="">
      <x-breadcrumb :items="[
          ['name' => 'Home', 'url' => '/'],
          ['name' => 'Dashboard', 'url' => '/dashboard'],
          ['name' => 'Finances', 'url' => '/finances'],
          ['name' => 'HouseA', 'url' => '/house/a']
      ]" />
    </div>
  
    <!-- Right elements -->
    <div class="relative flex items-center">
      <div>
        <!-- First dropdown trigger -->
        <a class="hidden-arrow mr-4 flex items-center text-neutral-600 transition duration-200 hover:text-neutral-700 hover:ease-in-out focus:text-neutral-700 disabled:text-black/30 motion-reduce:transition-none dark:text-neutral-200 dark:hover:text-neutral-300 dark:focus:text-neutral-300 [&.active]:text-black/90 dark:[&.active]:text-neutral-400"
           href="#">
          <!-- Dropdown trigger icon -->
          <span class="[&>svg]:w-5">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-7 w-7">
              <path d="M5.25 9a6.75 6.75 0 0113.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 01-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 11-7.48 0 24.585 24.585 0 01-4.831-1.244.75.75 0 01-.298-1.205A8.217 8.217 0 005.25 9.75V9zm4.502 8.9a2.25 2.25 0 104.496 0 25.057 25.057 0 01-4.496 0z"
                    clip-rule="evenodd" />
            </svg>
          </span>
          <!-- Notification counter -->
          <span id="notification-counter" class="absolute -mt-4 ml-2.5 rounded-full bg-danger px-[0.35em] py-[0.15em] text-[0.6rem] font-bold leading-none text-white">
            1
          </span>
        </a>
      </div>

      <div>
        <a class="hidden-arrow flex items-center whitespace-nowrap transition duration-150 ease-in-out motion-reduce:transition-none"
           href="#">
          <!-- User avatar -->
          <img src="https://tecdn.b-cdn.net/img/new/avatars/2.jpg"
               class="rounded-full"
               style="height: 25px; width: 25px"
               alt=""
               loading="lazy" />
        </a>
      </div>
    </div>
  </div>
</nav>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const notificationCounter = document.getElementById('notification-counter');

    function updateNotificationCount() {
      fetch('/notifications/count')
        .then(response => response.json())
        .then(data => {
          notificationCounter.textContent = data.count;
        })
        .catch(error => console.error('Error fetching notification count:', error));
    }

    updateNotificationCount();
    setInterval(updateNotificationCount, 60000); 
  });
</script>
