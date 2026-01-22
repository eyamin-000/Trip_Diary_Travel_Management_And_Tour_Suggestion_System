<?php
session_start();
require_once '../models/eventModel.php';
$domestic_events = getEventsByType('Domestic');
$abroad_events = getEventsByType('Abroad');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tour Events - Trip Diary</title>
    <style>
        body { 
            margin-top: 10px; 
            padding: 0; 
            font-family: Arial, sans-serif; 
            background-color: #eef2f5; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 600;
        }

        .Design {
            width: 900px;
            height: 550px;
            background-color: white;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .header-area {
            height: 80px;
            background: #2c3e50;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .back-btn { 
            position: absolute; 
            left: 20px; 
            padding: 7px 20px; 
            background: #fff; 
            color: #2c3e50; 
            border: none; 
            border-radius: 20px;
            font-weight: bold;
            font-size: 12px;
        }
        
        .back-btn:hover { 
            background: #e74c3c; 
            color: white; 
        }

        .header-title { 
            font-size: 24px; 
            font-weight: bold; 
            letter-spacing: 1px; }
        .header-title span { color: coral; }

        .content-body {
            flex: 1;
            padding: 25px;
            overflow-y: auto;
            background: #fff;
        }

        .create-btn { 
            float: right; 
            padding: 8px 15px; 
            background: #2ecc71; 
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 13px;
        }

        .category-title { 
            font-size: 18px; 
            font-weight: bold; 
            margin: 20px 0 10px 0; 
            clear: both; 
            color: #2c3e50;
            border-left: 4px solid coral;
            padding-left: 10px;
        }

        .scroll-wrapper { 
            display: flex; 
            gap: 15px; 
            padding: 10px 0;
            overflow-x: auto;
        }
        
        .event-card { 
            min-width: 200px; 
            height: 200px; 
            border: 1px solid #eee; 
            padding: 15px; 
            display: flex; 
            flex-direction: column; 
            justify-content: space-between; 
            text-align: center; 
            background: #f9f9f9; 
            border-radius: 10px;
        }

        .event-card h3 { margin: 0; color: #2c3e50; font-size: 16px; }
        .price { font-size: 18px; font-weight: bold; color: coral; }

        .enroll-btn { 
            padding: 8px; 
            background: #2c3e50; 
            color: #fff; 
            border: none; 
            border-radius: 4px;
            font-size: 13px;
        }

        .content-body::-webkit-scrollbar { width: 5px; }
        .content-body::-webkit-scrollbar-thumb { background: #ddd; border-radius: 10px; }
    </style>
</head>
<body>

    <div class="Design">
        <div class="header-area">
            <button class="back-btn" onclick="location.href='dashboard.php'">BACK</button>
            <div class="header-title">TOUR <span>EVENTS</span></div>
        </div>

        <div class="content-body">
            <button class="create-btn" onclick="location.href='create_event.php'">Create Event</button>

            <div class="category-title">Domestic</div>
            <div class="scroll-wrapper">
                <?php if($domestic_events && mysqli_num_rows($domestic_events) > 0) {
                    while($row = mysqli_fetch_assoc($domestic_events)) { ?>
                    <div class="event-card">
                        <div>
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <p style="font-size:12px; color:#777;"><?php echo htmlspecialchars($row['location'] ?? 'N/A'); ?></p>
                        </div>
                        <div class="price"><?php echo htmlspecialchars($row['price'] ?? '0'); ?> BDT</div>
                        <button class="enroll-btn" onclick="enrollNow(<?php echo $row['id']; ?>)">Enroll</button>
                    </div>
                <?php } } else { echo "<p>No events found.</p>"; } ?>
            </div>

            <div class="category-title">Abroad</div>
            <div class="scroll-wrapper">
                <?php if($abroad_events && mysqli_num_rows($abroad_events) > 0) {
                    while($row = mysqli_fetch_assoc($abroad_events)) { ?>
                    <div class="event-card">
                        <div>
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <p style="font-size:12px; color:#777;"><?php echo htmlspecialchars($row['location'] ?? 'N/A'); ?></p>
                        </div>
                        <div class="price"><?php echo htmlspecialchars($row['price'] ?? '0'); ?> BDT</div>
                        <button class="enroll-btn" onclick="enrollNow(<?php echo $row['id']; ?>)">Enroll</button>
                    </div>
                <?php } } else { echo "<p>No events found.</p>"; } ?>
            </div>
        </div>
    </div>

    <script>
        function enrollNow(id) {
            alert("Enrolling in Event ID: " + id);
        }
    </script>
</body>
</html>