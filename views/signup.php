<!DOCTYPE html>
<html>
<head>
    <title>Signup - Trip Diary</title>
    <link rel="stylesheet" href="../style.css">
    <style>
body {
    margin: 40px;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 500px;
    background-color: #ffffff;
}

.signup-container {
    width: 420px;
    padding: 25px;
    border-radius: 10px;
    background-color: #608bb8;   
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Signup</h2>
        <div id="msg" style="font-weight: bold;"></div><br>

        <label>Role:</label>
        <select id="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br><br>

        <input type="text" id="name" placeholder="Name"><br><br>
        <input type="text" id="username" placeholder="Username"><br><br>
        
        <label>Gender:</label>
        <input type="radio" name="gender" value="Male" checked> Male
        <input type="radio" name="gender" value="Female"> Female
        <input type="radio" name="gender" value="Others"> Others<br><br>

        <input type="text" id="location" placeholder="Location"><br><br>
        <input type="number" id="age" placeholder="Age"><br><br>
        <input type="password" id="password" placeholder="Password"><br><br>
        <input type="password" id="re_password" placeholder="Re-password"><br><br>

        <button onclick="signupProcess()">Signup</button>
        <br><br>
        <button onclick="location.href='home.php'">Back</button>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>

    <script>
    function signupProcess() {
        var data = {
            action: 'signup',
            role: document.getElementById('role').value,
            name: document.getElementById('name').value,
            username: document.getElementById('username').value,
            gender: document.querySelector('input[name="gender"]:checked').value,
            location: document.getElementById('location').value,
            age: document.getElementById('age').value,
            password: document.getElementById('password').value,
            re_password: document.getElementById('re_password').value
        };

        if(data.name == "" || data.username == "" || data.password == "") {
            alert("Please fill all fields.");
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../controllers/authControl.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = JSON.parse(this.responseText);
                var msgDiv = document.getElementById('msg');
                
                if(res.status === 'success') {
                    msgDiv.style.color = "green";
                    msgDiv.innerHTML = res.msg;
                    setTimeout(function(){ window.location = "login.php"; }, 2000);
                } else {
                    msgDiv.style.color = "red";
                    msgDiv.innerHTML = res.msg;
                }
            }
        };

        var params = Object.keys(data).map(key => key + '=' + data[key]).join('&');
        xhr.send(params);
    }
    </script>
</body>
</html>