<?php 
$page_title = 'Notifications Demo'; 
include 'includes/header.php'; 
?>

<div class="container">
    <div class="card">
        <h1 style="color: #6dd6c2; margin-bottom: 2rem;">🔔 Notifications System Demo</h1>
        
        <!-- Setup Instructions -->
        <div style="background: #fff3cd; border: 2px solid #ffc107; padding: 1rem; border-radius: 10px; margin-bottom: 2rem;">
            <h3>📋 First, Set Up Database:</h3>
            <p>Run this SQL file to create notification tables:</p>
            <code style="background: #f8f9fa; padding: 0.5rem; border-radius: 5px; display: block; margin: 1rem 0;">
                Import: database/notifications_setup.sql
            </code>
        </div>
        
        <!-- Test Controls -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
            
            <!-- Create Notification -->
            <div style="background: #e8f5e8; padding: 1.5rem; border-radius: 10px;">
                <h3 style="color: #28a745;">📝 Create Notification</h3>
                <form id="create-notification-form">
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Title:</label>
                        <input type="text" id="notification-title" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 5px;" 
                               placeholder="Enter notification title">
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Message:</label>
                        <textarea id="notification-message" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 5px; height: 80px;" 
                                  placeholder="Enter notification message"></textarea>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Type:</label>
                        <select id="notification-type" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
                            <option value="info">Info</option>
                            <option value="success">Success</option>
                            <option value="warning">Warning</option>
                            <option value="danger">Danger</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Target:</label>
                        <select id="notification-target" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
                            <option value="all">All Users</option>
                            <option value="admins">Admins Only</option>
                            <option value="medical_centers">Medical Centers Only</option>
                            <option value="donors">Donors Only</option>
                        </select>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Priority:</label>
                        <select id="notification-priority" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
                            <option value="low">Low</option>
                            <option value="normal">Normal</option>
                            <option value="high">High</option>
                            <option value="critical">Critical</option>
                        </select>
                    </div>
                    
                    <button type="submit" style="background: #28a745; color: white; padding: 0.8rem 1.5rem; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
                        Create Notification
                    </button>
                </form>
            </div>
            
        
            <div style="background: #e3f2fd; padding: 1.5rem; border-radius: 10px;">
                <h3 style="color: #1976d2;">👤 Test User</h3>
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">User Type:</label>
                    <select id="test-user-type" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
                        <option value="admin">Admin</option>
                        <option value="medical_center">Medical Center</option>
                        <option value="donor">Donor</option>
                    </select>
                </div>
                
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: bold;">User ID:</label>
                    <input type="number" id="test-user-id" value="1" style="width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                
                <button onclick="fetchNotifications()" style="background: #1976d2; color: white; padding: 0.8rem 1.5rem; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; margin-bottom: 1rem;">
                    Get Notifications
                </button>
                
                <div id="unread-count" style="background: #ffebee; padding: 0.5rem; border-radius: 5px; margin-bottom: 1rem; text-align: center; font-weight: bold;">
                    Unread: 0
                </div>
            </div>
        </div>
        
        <!-- Notifications Display -->
        <div style="margin-bottom: 2rem;">
            <h3 style="color: #6dd6c2; margin-bottom: 1rem;">📨 Notifications</h3>
            <div id="notifications-container" style="background: #f8f9fa; padding: 1rem; border-radius: 10px; min-height: 200px;">
                <p style="text-align: center; color: #666; font-style: italic;">No notifications loaded. Select a user and click "Get Notifications".</p>
            </div>
        </div>
        
        <!-- API Response -->
        <div style="margin-bottom: 2rem;">
            <h3 style="color: #6dd6c2; margin-bottom: 1rem;">📡 API Response</h3>
            <div id="api-response" style="background: #212529; color: #00ff00; padding: 1rem; border-radius: 10px; font-family: monospace; font-size: 0.9rem; min-height: 100px; overflow-x: auto;">
                <div style="color: #666;">API responses will appear here...</div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div style="display: flex; gap: 1rem; margin-bottom: 2rem;">
            <button onclick="createSampleNotifications()" style="background: #6dd6c2; color: white; padding: 0.8rem 1.5rem; border: none; border-radius: 5px; cursor: pointer;">
                Create Sample Notifications
            </button>
            <button onclick="markAllAsRead()" style="background: #ffc107; color: #212529; padding: 0.8rem 1.5rem; border: none; border-radius: 5px; cursor: pointer;">
                Mark All as Read
            </button>
            <button onclick="clearResponse()" style="background: #6c757d; color: white; padding: 0.8rem 1.5rem; border: none; border-radius: 5px; cursor: pointer;">
                Clear Response
            </button>
        </div>
    </div>
</div>

<script>
let currentNotifications = [];

// Log API responses
function logResponse(response, operation) {
    const responseDiv = document.getElementById('api-response');
    const timestamp = new Date().toLocaleTimeString();
    const formattedResponse = JSON.stringify(response, null, 2);
    responseDiv.innerHTML = `
        <div style="color: #ffc107; margin-bottom: 0.5rem;">[${timestamp}] ${operation}:</div>
        <div style="color: #00ff00;">${formattedResponse}</div>
    `;
}

// Create notification
document.getElementById('create-notification-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const title = document.getElementById('notification-title').value;
    const message = document.getElementById('notification-message').value;
    const type = document.getElementById('notification-type').value;
    const target_type = document.getElementById('notification-target').value;
    const priority = document.getElementById('notification-priority').value;
    
    if (!title || !message) {
        alert('Please fill in title and message');
        return;
    }
    
    const notificationData = {
        title: title,
        message: message,
        type: type,
        category: 'system',
        target_type: target_type,
        priority: priority,
        created_by: 1
    };
    
    fetch('api/create_notification.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(notificationData)
    })
    .then(response => response.json())
    .then(data => {
        logResponse(data, 'CREATE NOTIFICATION');
        if (data.success) {
            document.getElementById('create-notification-form').reset();
            fetchNotifications(); // Refresh notifications
        }
    })
    .catch(error => {
        console.error('Error:', error);
        logResponse({error: error.message}, 'CREATE NOTIFICATION ERROR');
    });
});

// Fetch notifications
function fetchNotifications() {
    const userType = document.getElementById('test-user-type').value;
    const userId = document.getElementById('test-user-id').value;
    
    fetch(`api/get_notifications.php?user_type=${userType}&user_id=${userId}&limit=20`)
    .then(response => response.json())
    .then(data => {
        logResponse(data, 'GET NOTIFICATIONS');
        if (data.success) {
            displayNotifications(data.data.notifications);
            document.getElementById('unread-count').innerHTML = `Unread: ${data.data.unread_count}`;
            currentNotifications = data.data.notifications;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        logResponse({error: error.message}, 'GET NOTIFICATIONS ERROR');
    });
}

// Display notifications
function displayNotifications(notifications) {
    const container = document.getElementById('notifications-container');
    
    if (notifications.length === 0) {
        container.innerHTML = '<p style="text-align: center; color: #666; font-style: italic;">No notifications found.</p>';
        return;
    }
    
    const html = notifications.map(notification => {
        const typeColors = {
            info: '#17a2b8',
            success: '#28a745',
            warning: '#ffc107',
            danger: '#dc3545',
            urgent: '#ff6b6b'
        };
        
        const priorityIcons = {
            low: '🟢',
            normal: '🟡',
            high: '🟠',
            critical: '🔴'
        };
        
        return `
            <div style="border-left: 4px solid ${typeColors[notification.type] || '#6c757d'}; background: white; padding: 1rem; margin-bottom: 1rem; border-radius: 0 5px 5px 0; position: relative;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="font-size: 0.8rem;">${priorityIcons[notification.priority]}</span>
                        <strong style="color: ${typeColors[notification.type] || '#6c757d'};">${notification.title}</strong>
                        ${notification.is_read == 0 ? '<span style="background: #dc3545; color: white; padding: 0.2rem 0.5rem; border-radius: 10px; font-size: 0.7rem;">NEW</span>' : ''}
                    </div>
                    <div style="display: flex; gap: 0.5rem;">
                        ${notification.is_read == 0 ? `<button onclick="markAsRead(${notification.id})" style="background: #28a745; color: white; border: none; padding: 0.3rem 0.5rem; border-radius: 3px; cursor: pointer; font-size: 0.7rem;">Mark Read</button>` : ''}
                        <button onclick="deleteNotification(${notification.id})" style="background: #dc3545; color: white; border: none; padding: 0.3rem 0.5rem; border-radius: 3px; cursor: pointer; font-size: 0.7rem;">Delete</button>
                    </div>
                </div>
                <p style="margin-bottom: 0.5rem; color: #333;">${notification.message}</p>
                <div style="font-size: 0.8rem; color: #666; display: flex; justify-content: space-between;">
                    <span>Category: ${notification.category}</span>
                    <span>Created: ${new Date(notification.created_at).toLocaleString()}</span>
                </div>
            </div>
        `;
    }).join('');
    
    container.innerHTML = html;
}

// Mark notification as read
function markAsRead(notificationId) {
    const userType = document.getElementById('test-user-type').value;
    const userId = document.getElementById('test-user-id').value;
    
    fetch('api/mark_notification_read.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            notification_id: notificationId,
            user_type: userType,
            user_id: userId
        })
    })
    .then(response => response.json())
    .then(data => {
        logResponse(data, 'MARK AS READ');
        if (data.success) {
            fetchNotifications(); // Refresh notifications
        }
    })
    .catch(error => {
        console.error('Error:', error);
        logResponse({error: error.message}, 'MARK AS READ ERROR');
    });
}

// Delete notification
function deleteNotification(notificationId) {
    if (!confirm('Are you sure you want to delete this notification?')) return;
    
    fetch('api/delete_notification.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            notification_id: notificationId,
            permanent_delete: false
        })
    })
    .then(response => response.json())
    .then(data => {
        logResponse(data, 'DELETE NOTIFICATION');
        if (data.success) {
            fetchNotifications(); // Refresh notifications
        }
    })
    .catch(error => {
        console.error('Error:', error);
        logResponse({error: error.message}, 'DELETE NOTIFICATION ERROR');
    });
}

// Create sample notifications
function createSampleNotifications() {
    const samples = [
        {
            title: "Low Blood Inventory Alert",
            message: "O- blood type is running critically low. Current inventory: 5 units.",
            type: "danger",
            category: "inventory",
            target_type: "medical_centers",
            priority: "critical"
        },
        {
            title: "System Maintenance",
            message: "BloodHero will be under maintenance tonight from 2:00 AM to 4:00 AM.",
            type: "warning",
            category: "system",
            target_type: "all",
            priority: "normal"
        },
        {
            title: "Donation Drive Success",
            message: "Thank you! Our blood drive collected 50 units of blood today.",
            type: "success",
            category: "donation",
            target_type: "all",
            priority: "low"
        }
    ];
    
    samples.forEach((sample, index) => {
        setTimeout(() => {
            fetch('api/create_notification.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({...sample, created_by: 1})
            })
            .then(response => response.json())
            .then(data => {
                if (index === samples.length - 1) {
                    logResponse(data, 'CREATE SAMPLE NOTIFICATIONS');
                    fetchNotifications(); // Refresh after last sample
                }
            });
        }, index * 500);
    });
}

// Mark all as read
function markAllAsRead() {
    if (currentNotifications.length === 0) {
        alert('No notifications to mark as read');
        return;
    }
    
    const userType = document.getElementById('test-user-type').value;
    const userId = document.getElementById('test-user-id').value;
    
    const promises = currentNotifications.filter(n => n.is_read == 0).map(notification => {
        return fetch('api/mark_notification_read.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                notification_id: notification.id,
                user_type: userType,
                user_id: userId
            })
        }).then(response => response.json());
    });
    
    Promise.all(promises).then(results => {
        logResponse({message: `Marked ${results.length} notifications as read`}, 'MARK ALL AS READ');
        fetchNotifications(); // Refresh notifications
    });
}

// Clear response
function clearResponse() {
    document.getElementById('api-response').innerHTML = '<div style="color: #666;">API responses will appear here...</div>';
}

// Auto-refresh every 30 seconds
setInterval(() => {
    if (currentNotifications.length > 0) {
        fetchNotifications();
    }
}, 30000);
</script>

<?php include 'includes/footer.php'; ?> 