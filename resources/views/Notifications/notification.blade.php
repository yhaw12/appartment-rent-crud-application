<div class="alert alert-{{ $notification->read_at ? 'success' : 'info' }} alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ $notification->data['message'] }}
    <br>
    <small>{{ $notification->created_at->diffForHumans() }}</small>
</div>

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
    