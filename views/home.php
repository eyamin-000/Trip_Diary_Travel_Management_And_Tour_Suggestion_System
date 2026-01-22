<?php
require_once '../models/tripModel.php';
$popular_dests = getPopularDestinations(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Trip Diary Home</title>

    <style>

        body {
            margin-top: 20px;
            font-family: Arial, sans-serif;
            background-color: #eef2f5;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .homeContainer {
            width: 80%;
            max-width: 1100px;
            height: 500px;
            display: flex;
            background-color: white;
            border-radius: 20px;
        }

        .homeLeftSection {
            padding: 35px;
            background-color: #2c3e50;
            color: white;
            display: flex;
            flex-direction: column;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;

        }

        .CapitalLeter {
            color: coral;
            font-size: 52px;
            margin-bottom: 30px;
        }

        .leftCenter {
            padding-top: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }


        .homeAuthBtns {
            width: 100%;
            max-width: 280px;
            text-align: center;
        }

        .homeAuthBtns button {
            width: 100%;
            padding: 15px 0;
            margin-bottom: 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        .homeAuthBtns button:first-child {
            background-color: #3498db;
            color: white;
        }
        .homeAuthBtns button:last-child {
            background-color: #2ecc71;
            color: white;
        }
        .aboutLink {
            padding-top: 60px;
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
        }
        .homeRightSection {
            flex: 1;
            padding: 35px;
        }
        .homeScrollBox {
            height: 350px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }
        th {
            background-color: #eee;
            position: sticky;
            top: 0;
        }

        .exit {
            margin-top: 10px;
        }

        .exit-btn {
            display: inline-block;
            padding: 7px 50px;
            border: 2px solid #000000;
            border-radius: 25px;
            color: #000000;
            font-weight: bold;
            text-decoration: none;
        }

        .exit-btn:hover {
            background-color: #e74c3c;
            color: white;
        }
    </style>
</head>

<body>

<div class="homeContainer">

    <div class="homeLeftSection">
        <h1 class="CapitalLeter">TRIP DIARY</h1>

        <div class="leftCenter">
            <div class="homeAuthBtns">
                <button onclick="location.href='login.php'">Login</button>
                <button onclick="location.href='signup.php'">Signup</button>
            </div>
        </div>
        <a href="about.php" class="aboutLink">About Trip Diary</a>
    </div>
    <div class="homeRightSection">
        <h2>Popular Destinations</h2>
        <div class="homeScrollBox">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Destination Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($popular_dests as $dest): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo htmlspecialchars($dest['name']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="exit">
    <a href="javascript:window.close();" class="exit-btn">Exit</a>
</div>

</body>
</html>
