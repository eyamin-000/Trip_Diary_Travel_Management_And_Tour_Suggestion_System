<?php
session_start();
require_once '../models/tripModel.php';

if (!isset($_SESSION['user'])) { 
    header("Location: login.php"); 
    exit(); 
}

$user_id = $_SESSION['user']['id'];
$my_plans = getUserPlannedTrips($user_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Plan Your Trip - Trip Diary</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background: #000; }
        .white-section { height: 30vh; background: #fff; position: relative; display: flex; align-items: center; justify-content: center; }
        .back-btn { position: absolute; top: 20px; left: 20px; padding: 10px 20px; cursor: pointer; background: #333; color: white; border: none; font-weight: bold; }
        .header-title { font-size: 35px; font-weight: bold; color: #000; }
        .black-section { min-height: 70vh; background: #000; color: #fff; display: flex; padding: 20px; box-sizing: border-box; }
        .form-area { flex: 0.8; padding: 0 20px; border-right: 1px solid #444; }
        .form-area input, .form-area textarea { width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #555; background: #1a1a1a; color: #fff; box-sizing: border-box; }
        .add-btn { width: 100%; background: #fff; color: #000; padding: 12px; border: none; font-weight: bold; cursor: pointer; font-size: 16px; }
        .table-area { flex: 1.5; padding: 0 20px; }
        .scroll-box { height: 400px; overflow-y: auto; background: #111; border: 1px solid #333; }
        table { width: 100%; border-collapse: collapse; color: #fff; font-size: 12px; }
        th, td { border: 1px solid #333; padding: 10px; text-align: left; }
        th { background: #222; position: sticky; top: 0; }
        .del-btn { background: #ff4d4d; color: white; border: none; padding: 5px 8px; cursor: pointer; border-radius: 3px; }
    </style>
</head>
<body>

    <div class="white-section">
        <button class="back-btn" onclick="location.href='dashboard.php'">BACK</button>
        <h1 class="header-title">PLAN YOUR TRIP</h1>
    </div>

    <div class="black-section">
        <div class="form-area">
            <input type="text" id="dest" placeholder="Destination">
            <input type="number" id="day" placeholder="Days">
            <input type="text" id="transport" placeholder="Transport">
            <textarea id="note" placeholder="Short Note"></textarea>
            <input type="text" id="location" placeholder="Departure Location">
            <input type="number" id="budget" placeholder="Budget">
            <button class="add-btn" onclick="savePlan()">Add To Plan</button>
        </div>

        <div class="table-area">
            <div class="scroll-box">
                <table>
                    <thead>
                        <tr>
                            <th>Destination</th><th>Day</th><th>Transport</th><th>Budget</th><th>Note</th><th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($my_plans)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['destination']); ?></td>
                                <td><?php echo $row['day']; ?></td>
                                <td><?php echo $row['transport']; ?></td>
                                <td><?php echo $row['budget']; ?></td>
                                <td><?php echo $row['note']; ?></td>
                                <td><button class="del-btn" onclick="deletePlan(<?php echo $row['id']; ?>)">Delete</button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../script.js"></script>
</body>
</html>