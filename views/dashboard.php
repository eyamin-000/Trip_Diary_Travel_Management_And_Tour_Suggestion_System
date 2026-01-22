<?php
session_start();
require_once '../models/tripModel.php';
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }
$user = $_SESSION['user'];
$suggestions = getAllSuggestions();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Trip Diary Dashboard</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            background-color: #eef2f5; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 550px;
        }

        .dashboard-container { 
            width: 90%; 
            max-width: 1200px; 
            height: 600px; 
            display: flex; 
            background-color: white; 
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .sidebar { 
            width: 300px; 
            background-color: #2c3e50; 
            color: white; 
            display: flex; 
            flex-direction: column; 
            padding: 40px 20px;
        }

        .profile-box { 
            text-align: center; 
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 30px;
            margin-bottom: 30px;
        }

        .profile-box h3 { 
            color: coral;
            font-size: 24px;
            margin: 15px 0 5px 0;
            text-transform: uppercase;
        }
        
        .profile-footer { 
            display: flex; 
            justify-content: center; 
            gap: 20px;
            margin-top: 15px; 
        }
        
        .profile-footer a { 
            color: #ffffff; 
            text-decoration: none; 
            font-size: 12px; 
            font-weight: bold;
            padding: 5px 10px;
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 4px;
        }

        .profile-footer a:hover {
            background-color: white;
            color: #2c3e50;
        }

        .menu-bar a { 
            display: block; 
            padding: 15px; 
            color: white; 
            text-decoration: none; 
            font-weight: bold; 
            border-radius: 6px;
            margin-bottom: 10px;
            transition: 0.3s;
            text-align: center;
            font-size: 14px;
            letter-spacing: 1px;
            background-color: rgba(255,255,255,0.05);
        }

        .menu-bar a:hover { 
            background-color: #3498db;
        }

        .main-content { 
            flex: 1; 
            padding: 40px; 
            position: relative; 
            background-color: white;
            display: flex;
            flex-direction: column;
        }
        
        .search-section { 
            width: 300px; 
            align-self: center;
            margin-bottom: 20px;
        }

        .search-section input { 
            width: 100%; 
            padding: 12px; 
            border: 1px solid #ddd;
            border-radius: 25px;
            outline: none;
            padding-left: 20px;
        }

        .suggestion-box h4 { 
            margin-top: 30px;
            margin-bottom: 10px;
            color: #2c3e50;
            font-size: 18px;
        }
        
        .scroll-box { 
            height: 250px; 
            overflow-y: auto; 
            border: 1px solid #eee;
            border-radius: 10px;
        }

        table { width: 100%; border-collapse: collapse; }
        td { 
            padding: 12px; 
            border-bottom: 1px solid #eee; 
            font-size: 18px;
            text-align: center;
            letter-spacing: 5px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .exit-btn { 
            position: absolute; 
            bottom: 20px; 
            right: 300px; 
            display: inline-block;
            padding: 7px 40px;
            border: 2px solid #000000;
            border-radius: 25px;
            color: #000000;
            font-weight: bold;
            text-decoration: none;
            font-size: 14px;
        }

        .exit-btn:hover {
            background-color: #e74c3c;
            color: white;
            border-color: #e74c3c;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <div class="sidebar">
        <div class="profile-box">
            <!--<img src="../resources/user_icon.png" width="80" style="border-radius: 50%; border: 3px solid coral;">-->
            <h3><?php echo htmlspecialchars($user['name']); ?></h3>
            <div class="profile-footer">
                <a href="edit_profile.php">EDIT</a>
                <a href="logout.php">LOGOUT</a>
            </div>
        </div>
        <nav class="menu-bar">
            <a href="dashboard.php">DASHBOARD</a>
            <a href="plan_trip.php">PLAN A TRIP</a>
            <a href="events.php">EVENTS</a>
            <a href="travel_cost.php">TRAVEL COSTS</a>
            <a href="past_trip.php">PAST TRIPS</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="search-section">
            <input type="text" id="searchBar" placeholder="Search destination..." onkeyup="liveSearch()">
            <div id="searchResult" style="background:white; border:1px solid #ccc; position:absolute; width:300px; display:none; z-index:100; border-radius: 10px;"></div>
        </div>

        <div class="suggestion-box">
            <h4>Recommended for You</h4>
            <div class="scroll-box">
                <table>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($suggestions)) { ?>
                        <tr><td><?php echo htmlspecialchars($row['name']); ?></td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <a href="javascript:void(0);" onclick="forceExit()" class="exit-btn">Exit</a>
    </div>
</div>

<script>
function liveSearch() {
    var q = document.getElementById('searchBar').value;
    var resDiv = document.getElementById('searchResult');
    if(q == "") { resDiv.style.display = "none"; return; }

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../controllers/tripControl.php?action=search&q=" + q, true);
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            var html = "";
            data.forEach(function(item) {
                html += "<div style='padding:10px; border-bottom:1px solid #eee; cursor:pointer;' onclick='selectDest(\""+item.name+"\")'>" + item.name + "</div>";
            });
            resDiv.innerHTML = html;
            resDiv.style.display = "block";
        }
    };
    xhr.send();
}
function selectDest(name) {
    document.getElementById('searchBar').value = name;
    document.getElementById('searchResult').style.display = "none";
}
</script>
</body>
</html>