<!DOCTYPE html>
<html>
<head>
    <title>Login - Trip Diary</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .login-container {
    width: 350px;
    margin: 80px auto;
    padding: 25px;
    background: #ffffff;
    border-radius: 8px;
}

.login-container h2 {
    text-align: center;
    margin-bottom: 20px;
    font-weight: bold;
}


.login-container input,
.login-container select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
}

.login-container button {
    width: 100%;
    padding: 10px;
    background: #2e8b57;
    color: #fff;
    border: none;
}

.login-container button:hover {
    background: #246b45;
}

.login-container p {
    text-align: center;
    margin-top: 15px;
}

.error-msg {
    color: red;
    margin-bottom: 10px;
    text-align: center;
}

.login-page {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f2f6ff;
}

.login-box {
    display: flex;
    width: 850px;
    height: 450px;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;

}

.login-left {
    width: 50%;
    background: linear-gradient(to bottom, #1e8f6f, #145a45);
    color: white;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.login-left h1 {
    font-size: 32px;
    margin-bottom: 10px;
}

.login-left p {
    font-size: 16px;
    opacity: 0.9;
}

.login-right {
    width: 50%;
    padding: 40px;
}

.login-right .login-container {
    box-shadow: none;
    margin: 0;
    padding: 0;
    width: 100%;
}
    </style>
</head>
<body>
     
    <div class="login-container"
        <h2>Login</h2>
        <div id="error-msg" class="error-msg"></div>

        <label>Role:</label>
        <select id="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <br><br>

        <input type="text" id="username" placeholder="Username"><br><br>
        <input type="password" id="password" placeholder="Password"><br><br>
        <!--Eta Pore Thik Korbo-->
        <input type="checkbox" name="remember"> Remember Me <br><br>

        <button onclick="loginProcess()">Login</button>
        
        <p>Don't have an account? <a href="signup.php">Signup</a></p>
    </div>

    <script>
    function loginProcess() {
        var role = document.getElementById('role').value;
        var user = document.getElementById('username').value;
        var pass = document.getElementById('password').value;

        if(user == "" || pass == "") {
            document.getElementById('error-msg').innerHTML = "Please fill all fields!";
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../controllers/authControl.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // JSON ডেটা পার্স করা
                var res = JSON.parse(this.responseText);
                
                
                if(res.status === 'success') {
                    if(res.role === 'admin') {
                        window.location = "adminDashboard.php";
                    } else {
                        window.location = "dashboard.php";
                    }
                } else {
                    document.getElementById('error-msg').innerHTML = res.msg;
                }
            }
        };
        // AJAX এর মাধ্যমে ডেটা পাঠানো
        xhr.send("action=login&username=" + user + "&password=" + pass + "&role=" + role);
    }
    </script>
</body>
</html>