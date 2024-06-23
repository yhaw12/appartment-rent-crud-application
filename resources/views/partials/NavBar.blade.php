<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
 
<nav class="bg-white dark:bg-gray-700 shadow-md py-4">
  <div class="container mx-auto flex justify-between items-center px-4">
      <!-- Breadcrumb and other navigation items -->
      <div class="flex items-center space-x-4">
          <x-breadcrumb :items="[
              ['name' => 'Home', 'url' => '/'],
              ['name' => 'Dashboard', 'url' => '/dashboard'],
              ['name' => 'Finances', 'url' => '/finances'],
              ['name' => 'Tenants', 'url' => '/tennants'],
              ['name' => 'HouseA', 'url' => '/house/a'],
              ['name' => 'HouseB', 'url' => '/house/b'],
              ['name' => 'HouseC', 'url' => '/house/c'],
              ['name' => 'HouseS', 'url' => '/house/s'],
          ]" />
      </div>
      <!-- Right elements -->
      <div class="flex items-center space-x-4">
          <!-- Notification Dropdown -->
          <div class="relative">
              <button id="notificationButton" class="relative text-gray-700 dark:text-gray-200 focus:outline-none">
                  <i class="fa fa-bell"></i>
                  <span id="notification-count" class="absolute top-0 right-0 inline-block w-3 h-3 bg-red-600 rounded-full text-xs text-white text-center" style="display: none;"></span>
              </button>
              <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg z-50">
                  <div class="py-2">
                      <div class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200">Notifications</div>
                      <div id="notification-list">
                          <!-- Notifications will be dynamically inserted here -->
                      </div>
                      <div class="border-t border-gray-200 dark:border-gray-700"></div>
                      <a href="#" id="mark-all-read" class="block px-4 py-2 text-sm text-center text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                          Mark all as read
                      </a>
                  </div>
              </div>
          </div>

          <!-- User Avatar -->
          <div>
              <a href="#" class="flex items-center focus:outline-none">
                  <img src="https://tecdn.b-cdn.net/img/new/avatars/2.jpg" class="rounded-full h-6 w-6" alt="User Avatar">
              </a>
          </div>
      </div>
  </div>
</nav>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    function fetchNotifications() {
    $.ajax({
      url: '/notifications',
      method: 'GET',
      success: function(response) {
        var unreadCount = response.length;
        $('#notification-count').text(unreadCount);
        $('#notification-count').toggle(unreadCount > 0);
        
        var notificationList = $('#notification-list');
        notificationList.empty();
        
        if (unreadCount > 0) {
          response.forEach(function(notification) {
            var message = '';
            if (notification.data.reminder_type) {
              switch(notification.data.reminder_type) {
                case 'three_months':
                  message = `${notification.data.tenant_name}'s lease expires in 3 months`;
                  break;
                case 'one_month':
                  message = `${notification.data.tenant_name}'s lease expires in 1 month`;
                  break;
                case 'one_week':
                  message = `${notification.data.tenant_name}'s lease expires in 1 week`;
                  break;
                default:
                  message = `${notification.data.tenant_name}'s lease is expiring soon`;
              }
            } else {
              message = notification.data.message || 'Lease expiration notification';
            }
            
            notificationList.append(`
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                ${message}
                <small class="block text-gray-500 dark:text-gray-400">${moment(notification.created_at).fromNow()}</small>
              </a>
            `);
          });
        } else {
          notificationList.append('<div class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200">No unread notifications.</div>');
        }
      }
    });
    }

    // Toggle dropdown menu
    $('#notificationButton').click(function(e) {
      e.stopPropagation();
      $('#notificationDropdown').toggleClass('hidden');
    });

    // Close the dropdown if clicked outside
    $(document).click(function(e) {
      if (!$(e.target).closest('#notificationDropdown, #notificationButton').length) {
        $('#notificationDropdown').addClass('hidden');
      }
    });

    // Mark all as read
    $('#mark-all-read').click(function(e) {
    e.preventDefault();
    $.ajax({
      url: '/notifications/mark-all-read', // Updated URL
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        if (response.success) {
          fetchNotifications(); // Refresh notifications after marking all as read
          console.log('All notifications marked as read');
        } else {
          console.error('Failed to mark notifications as read');
        }
      },
      error: function(xhr, status, error) {
        console.error('Error marking notifications as read:', error);
      }
    });
  });

    // Fetch notifications on page load and every 5 minutes
    fetchNotifications();
    setInterval(fetchNotifications, 300000);
  });
</script>