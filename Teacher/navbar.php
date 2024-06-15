<!-- navbar.php -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
    .collapse a {
        text-indent: 10px;
    }
    nav#sidebar {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }
    nav#sidebar .sidebar-list {
        padding: 20px;
    }
    nav#sidebar .sidebar-list a {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        text-decoration: none;
        color: #343a40;
        border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    nav#sidebar .sidebar-list a:hover,
    nav#sidebar .sidebar-list a.active {
        background-color: #007bff;
        color: #fff;
    }
    nav#sidebar .sidebar-list a .icon-field {
        margin-right: 10px;
        font-size: 18px;
    }
    nav#sidebar .sidebar-list a .nav-text {
        flex-grow: 1;
        font-weight: 600;
    }
</style>
<nav id="sidebar" class="mx-lt-5">
    <div class="sidebar-list">
        <a href="index.php?page=home" class="nav-item nav-home">
            <span class='icon-field'><i class="fas fa-home"></i></span>
            <span class="nav-text">Home</span>
        </a>
        <a href="index.php?page=courses" class="nav-item nav-courses">
            <span class='icon-field'><i class="fas fa-list"></i></span>
            <span class="nav-text">Course List</span>
        </a>
        <a href="index.php?page=subjects" class="nav-item nav-subjects">
            <span class='icon-field'><i class="fas fa-book"></i></span>
            <span class="nav-text">Subject List</span>
        </a>
        <a href="index.php?page=faculty" class="nav-item nav-faculty">
            <span class='icon-field'><i class="fas fa-user-tie"></i></span>
            <span class="nav-text">Faculty List</span>
        </a>
        <a href="index.php?page=schedule" class="nav-item nav-schedule">
            <span class='icon-field'><i class="fas fa-calendar-day"></i></span>
            <span class="nav-text">Schedule</span>
        </a>
        <a href="index.php?page=users" class="nav-item nav-users">
            <span class='icon-field'><i class="fas fa-users"></i></span>
            <span class="nav-text">Users</span>
        </a>
        <a href="index5.html" target="_blank" class="nav-item nav-users">
            <span class='icon-field'><i class="fas fa-users"></i></span>
            <span class="nav-text">Navigation</span>
        </a>
        <a href="navi.html" target="_blank" class="nav-item nav-users">
            <span class='icon-field'><i class="fas fa-users"></i></span>
            <span class="nav-text">Rooms And Locations</span>
        </a>
    </div>
</nav>
<script>
    $('.nav_collapse').click(function() {
        console.log($(this).attr('href'))
        $($(this).attr('href')).collapse()
    })
    $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>