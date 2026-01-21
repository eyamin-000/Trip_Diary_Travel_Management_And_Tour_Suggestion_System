// 1. Login Process Function
function loginProcess() {
    var role = document.getElementById('role').value;
    var user = document.getElementById('username').value;
    var pass = document.getElementById('password').value;
    var remember = document.getElementById('remember').checked ? 1 : 0; 

    var errorDiv = document.getElementById('error-msg');
    if(errorDiv) errorDiv.innerHTML = "";

    if(user == "" || pass == "") {
        if(errorDiv) errorDiv.innerHTML = "Please fill all fields!";
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../controllers/authControl.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                var res = JSON.parse(this.responseText);
                if(res.status === 'success') {
                    if(res.role === 'admin') {
                        window.location = "adminDashboard.php";
                    } else {
                        window.location = "dashboard.php";
                    }
                } else {
                    if(errorDiv) errorDiv.innerHTML = res.msg;
                }
            } catch(e) {
                console.error("Server syntax error:", this.responseText);
            }
        }
    };

    xhr.send("action=login&username=" + encodeURIComponent(user) + 
             "&password=" + encodeURIComponent(pass) + 
             "&role=" + role + 
             "&remember=" + remember);
}

// 2. Plan Save Function
function savePlan() {
    var dest = document.getElementById('dest').value;
    var budget = document.getElementById('budget').value;

    if(dest == "" || budget == "") {
        alert("Destination and Budget are required!");
        return;
    }

    var data = "action=add_plan&destination=" + encodeURIComponent(dest) +
               "&day=" + encodeURIComponent(document.getElementById('day').value) +
               "&transport=" + encodeURIComponent(document.getElementById('transport').value) +
               "&note=" + encodeURIComponent(document.getElementById('note').value) +
               "&location=" + encodeURIComponent(document.getElementById('location').value) +
               "&budget=" + encodeURIComponent(budget);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../controllers/tripControl.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                var res = JSON.parse(this.responseText);
                if(res.status === 'success') {
                    alert("Plan Added!");
                    location.reload();
                } else { alert(res.msg); }
            } catch(e) { alert("Server error."); }
        }
    };
    xhr.send(data);
}

// 3. Plan Delete Function
function deletePlan(id) {
    if(confirm("Are you sure you want to delete this plan?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../controllers/tripControl.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = JSON.parse(this.responseText);
                if(res.status === 'success') {
                    alert("Plan Deleted!");
                    location.reload();
                } else { alert(res.msg); }
            }
        };
        xhr.send("action=delete_plan&id=" + id);
    }
}

// 4. Past Trip Save Function
function savePastTrip() {
    var data = "action=save_past_trip" +
               "&destination=" + encodeURIComponent(document.getElementById('p_dest').value) +
               "&trip_type=" + document.getElementById('p_type').value +
               "&trip_date=" + document.getElementById('p_date').value +
               "&country=" + encodeURIComponent(document.getElementById('p_country').value) +
               "&title=" + encodeURIComponent(document.getElementById('p_title').value) +
               "&description=" + encodeURIComponent(document.getElementById('p_desc').value);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../controllers/pastTripControl.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var res = JSON.parse(this.responseText);
            if(res.status === 'success') {
                alert("Past Trip Saved!");
                location.reload();
            } else { alert(res.msg); }
        }
    };
    xhr.send(data);
}

// 5. Toggle Dropdown Function
function toggleDetails(id) {
    var detailsDiv = document.getElementById('details_' + id);
    if (detailsDiv.style.display === "none") {
        detailsDiv.style.display = "block";
    } else {
        detailsDiv.style.display = "none";
    }
}

// 6. Calculating Travel Cost
function calculateTravelCost() {
    var from = document.getElementById('from_loc').value;
    var to = document.getElementById('to_loc').value;
    var transport = document.getElementById('transport_type').value;

    if(from == "" || to == "") {
        alert("Please fill both locations!");
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../controllers/costControl.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var res = JSON.parse(this.responseText);
            var resultBox = document.getElementById('result_box');
            if(res.status === 'success') {
                resultBox.style.display = "block";
                var output = '<p style="color:#fff; font-size:14px;">Distance: ' + res.distance + ' KM</p>';
                output += '<p>Min: ' + res.min + ' TK</p>';
                output += '<p>Max: ' + res.max + ' TK</p>';
                output += '<p style="color:yellow;">Average: ' + res.avg + ' TK</p>';
                resultBox.innerHTML = output;
            } else {
                alert(res.msg);
                resultBox.style.display = "none";
            }
        }
    };
    xhr.send("action=calculate_cost&from=" + encodeURIComponent(from) + "&to=" + encodeURIComponent(to) + "&transport=" + transport);
}

// 7. Update Profile Function
function updateProfile() {
    var name = document.getElementById('new_name').value;
    var loc = document.getElementById('new_loc').value;
    var age = document.getElementById('new_age').value;
    var pass = document.getElementById('new_pass').value;
    var repass = document.getElementById('re_pass').value;

    if(name == "") { alert("Name cannot be empty!"); return; }

    var data = "action=update_profile&name=" + encodeURIComponent(name) +
               "&location=" + encodeURIComponent(loc) +
               "&age=" + age +
               "&pass=" + encodeURIComponent(pass) +
               "&repass=" + encodeURIComponent(repass);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../controllers/userControl.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var res = JSON.parse(this.responseText);
            if(res.status === 'success') {
                alert("Profile Updated Successfully!");
                window.location.href = "dashboard.php";
            } else { alert(res.msg); }
        }
    };
    xhr.send(data);
}

// 8. Admin Event Handle (Accept/Delete)
function handleEvent(id, action) {
    if(!confirm("Are you sure you want to perform this action?")) return;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../controllers/adminControl.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                var res = JSON.parse(this.responseText);
                if(res.status === 'success') {
                    location.reload();
                } else { alert(res.msg); }
            } catch(e) { console.error("Error parsing response", this.responseText); }
        }
    };
    xhr.send("action=" + action + "&id=" + id);
}

// 9. Admin Dashboard Section Toggle
function showAdminSection(sectionId) {
    // Shob table section age hide kora
    var sections = ['manage-events', 'manage-users', 'manage-destinations'];
    sections.forEach(function(id) {
        var el = document.getElementById(id);
        if(el) el.style.display = 'none';
    });
    
    // Target section show kora
    var target = document.getElementById(sectionId);
    if(target) target.style.display = 'block';
}

// 10. User Enrollment Function
function enrollNow(eventId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../controllers/eventControl.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                var res = JSON.parse(this.responseText);
                alert(res.msg);
            } catch(e) { alert("Successfully Enrolled!"); }
        }
    };
    xhr.send("action=enroll&event_id=" + eventId);
}

// ১১. Admin User Delete Function
function handleUserDelete(id) {
    if(!confirm("Are you sure you want to delete this user?")) return;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../controllers/adminControl.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                var res = JSON.parse(this.responseText);
                if(res.status === 'success') {
                    alert("User deleted successfully!");
                    location.reload();
                } else {
                    alert(res.msg);
                }
            } catch(e) {
                console.error("Delete Error:", this.responseText);
            }
        }
    };
    xhr.send("action=delete_user&id=" + id);
}