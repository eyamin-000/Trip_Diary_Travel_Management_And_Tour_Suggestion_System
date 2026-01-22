<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <style>
        body { 
            margin: 10px; 
            padding: 20px;
            font-family: 'Segoe UI', Arial, sans-serif; 
            background-color: #eef2f5; 
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .Design {
            width: 80%;
            height: 530px;
            display: flex;
            background-color: white;
            border-radius: 20px;
            overflow: hidden;
        }

        .left-sidebar { 
            width: 50%; 
            background: #2c3e50; 
            color: #fff; 
            position: relative; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }
        .back-btn { 
            position: absolute; 
            top: 30px; 
            left: 30px; 
            padding: 10px 30px; 
            background: #ffffff; 
            color: #2c3e50; 
            border: none; 
            border-radius: 25px;
            font-size: 12px;
        }
        
        .back-btn:hover {
            background-color: #e74c3c;
            color: white;
        }

        .sidebar-text { 
            font-size: 38px; 
            font-weight: bold; 
            text-align: center; 
            letter-spacing: 5px;
        }
        .sidebar-text span { 
            color: coral; 
        }

        .main-content { 
            width: 50%;
            padding: 20px; 
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #ffffff;
        }

        .edit-box h2 { 
            padding-bottom: 5px;
            color: #2c3e50; 
            font-size: 20px;
            text-align: center;
        }
        
        .form-group { margin-bottom: 18px; }
        
        label { 
            display: block; 
            font-size: 12px; 
            color: #888; 
            letter-spacing: 1px;
        }

        input { 
            width: 100%; 
            padding: 12px 15px; 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            font-size: 14px;
            background-color: #fcfcfc;
        }

        input:focus {
            border-color: #3498db;
            background-color: #fff;
        }
        
        .save-btn { 
            width: 100%; 
            padding: 15px; 
            background: #2ecc71; 
            color: #fff; 
            border: none; 
            border-radius: 8px; 
            font-size: 16px; 
            letter-spacing: 1px;
        }

        .save-btn:hover { 
            background: #27ae60; 
        }
    </style>
</head>
<body>

    <div class="Design">
        <div class="left-sidebar">
            <button class="back-btn" onclick="location.href='dashboard.php'">BACK</button>
            <div class="sidebar-text">PROFILE<br><span>SETTINGS</span></div>
        </div>

        <div class="main-content">
            <div class="edit-box">
                <h2>Edit Your Profile</h2>
                
                <div class="form-group">
                    <label>New Name</label>
                    <input type="text" id="new_name" value="<?php echo htmlspecialchars($user['name']); ?>">
                </div>
                
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" id="new_loc" value="<?php echo htmlspecialchars($user['location'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label>Age</label>
                    <input type="number" id="new_age" value="<?php echo htmlspecialchars($user['age'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" id="new_pass" placeholder="Leave blank to keep current">
                </div>
                
                <div class="form-group">
                    <label>Re-type Password</label>
                    <input type="password" id="re_pass" placeholder="Confirm new password">
                </div>
                
                <button class="save-btn" onclick="updateProfile()">Save Changes</button>
            </div>
        </div>
    </div>

    <script src="../script.js"></script>
</body>
</html>