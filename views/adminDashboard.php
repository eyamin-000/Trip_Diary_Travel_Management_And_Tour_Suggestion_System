<?php
session_start();
require_once '../models/eventModel.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php"); 
    exit();
}

$all_events = getAllEventsForAdmin();
$all_users = getAllUsers();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Trip Diary</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background: #fff; padding-bottom: 100px; }
        .top-nav { height: 100px; background: #000; color: #fff; display: flex; align-items: center; justify-content: center; gap: 50px; }
        .nav-item { cursor: pointer; font-weight: bold; padding: 10px 20px; transition: 0.3s; text-transform: uppercase; }
        .nav-item:hover { background: #333; color: #4CAF50; border-radius: 5px; }
        .content-area { padding: 40px; min-height: 400px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background: #f4f4f4; }
        .btn-accept { background: #28a745; color: #fff; border: none; padding: 8px 15px; cursor: pointer; border-radius: 3px; }
        .btn-delete { background: #dc3545; color: #fff; border: none; padding: 8px 15px; cursor: pointer; border-radius: 3px; }
        #manage-users, #manage-destinations { display: none; }
        .exit-container { text-align: center; margin-top: 50px; }
        .btn-exit { padding: 12px 40px; background: #000; color: #fff; border: 2px solid #333; cursor: pointer; font-weight: bold; text-transform: uppercase; }
        .btn-exit:hover { background: #dc3545; border-color: #dc3545; }
    </style>
</head>
<body>

    <div class="top-nav">
        <div class="nav-item" onclick="showAdminSection('manage-events')">MANAGE EVENTS</div>
        <div class="nav-item" onclick="showAdminSection('manage-users')">MANAGE USERS</div>
        <div class="nav-item" onclick="showAdminSection('manage-destinations')">MANAGE DESTINATIONS</div>
    </div>

    <div class="content-area">
        <div id="manage-events">
            <h2>Manage User Events</h2>
            <table>
                <thead>
                    <tr><th>No</th><th>Event Name</th><th>Status</th><th>Action</th></tr>
                </thead>
                <tbody>
                    <?php if($all_events) { $i = 1; while($row = mysqli_fetch_assoc($all_events)) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td style="font-weight:bold; color: <?php echo ($row['is_accepted'] == 1) ? 'green' : 'orange'; ?>">
                                <?php echo ($row['is_accepted'] == 1) ? 'Accepted' : 'Pending'; ?>
                            </td>
                            <td>
                                <?php if($row['is_accepted'] == 0) { ?>
                                    <button class="btn-accept" onclick="handleEvent(<?php echo $row['id']; ?>, 'accept_event')">Accept</button>
                                <?php } ?>
                                <button class="btn-delete" onclick="handleEvent(<?php echo $row['id']; ?>, 'delete_event')">Delete</button>
                            </td>
                        </tr>
                    <?php } } ?>
                </tbody>
            </table>
        </div>

        <div id="manage-users">
            <h2>Manage Users</h2>
            <table>
                <thead>
                    <tr><th>No</th><th>Name</th><th>Role</th><th>Action</th></tr>
                </thead>
                <tbody>
                    <?php if($all_users) { $k = 1; while($u = mysqli_fetch_assoc($all_users)) { ?>
                        <tr>
                            <td><?php echo $k++; ?></td>
                            <td><?php echo htmlspecialchars($u['username']); ?></td>
                            <td><?php echo htmlspecialchars($u['role']); ?></td>
                            <td>
                                <?php if($u['role'] !== 'admin') { ?>
                                    <button class="btn-delete" onclick="handleUserDelete(<?php echo $u['id']; ?>)">Delete</button>
                                <?php } else { echo "System Admin"; } ?>
                            </td>
                        </tr>
                    <?php } } ?>
                </tbody>
            </table>
        </div>

        <div id="manage-destinations"><h2>Manage Destinations Section</h2><p>Destinations management here...</p></div>
    </div>

    <div class="exit-container">
        <button class="btn-exit" onclick="location.href='dashboard.php'">EXIT PANEL</button>
    </div>

    <script src="../script.js"></script>
</body>
</html>