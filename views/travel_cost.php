<!DOCTYPE html>
<html>
<head>
    <title>Travel Cost Calculator</title>
    <style>
        body { margin: 0; background: #fff; font-family: Arial, sans-serif; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .back-btn { position: absolute; top: 20px; left: 20px; padding: 10px 20px; cursor: pointer; background: #000; color: #fff; border: none; font-weight: bold; }
        
        .cost-box { width: 420px; background: #000; color: #fff; padding: 35px; border-radius: 15px; text-align: center; }
        .cost-box h2 { margin-bottom: 10px; }
        
        input, select { width: 100%; padding: 12px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #444; background: #fff; color: #000; box-sizing: border-box; }
        .calc-btn { width: 100%; padding: 12px; background: #28a745; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; font-size: 16px; }
        
        #result_box { margin-top: 20px; padding: 15px; background: #222; border: 1px solid #444; border-radius: 8px; display: none; }
        #result_box p { margin: 8px 0; font-size: 16px; font-weight: bold; }
    </style>
</head>
<body>

    <button class="back-btn" onclick="location.href='dashboard.php'">BACK</button>

    <div class="cost-box">
        <h2>Travel Cost Estimator</h2>
        <p style="color: #bbb; margin-bottom: 25px;">Choose your Destination and Location</p>
        
        <input type="text" id="from_loc" placeholder="From District">
        <input type="text" id="to_loc" placeholder="To District">
        
        <select id="transport_type">
            <option value="Bus">Bus</option>
            <option value="Train">Train</option>
            <option value="Air">Air</option>
        </select>
        
        <button class="calc-btn" onclick="calculateTravelCost()">Calculate</button>

        <div id="result_box"></div>
    </div>

    <script src="../script.js"></script>
</body>
</html>