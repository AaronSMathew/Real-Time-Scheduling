<!-- topbar.php -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

    .topbar {
        font-family: 'Poppins', sans-serif;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        background-color: #343a40;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 1rem;
    }

    .topbar-left {
        display: flex;
        align-items: center;
    }

    .topbar-brand {
        font-weight: 600;
        font-size: 1.2rem;
        margin-right: 1rem;
    }

    .topbar-time {
        font-size: 0.9rem;
    }

    .topbar-right {
        display: flex;
        align-items: center;
    }

    .dropdown-toggle {
        background-color: transparent;
        border: none;
        color: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .dropdown-toggle:focus {
        outline: none;
    }

    .dropdown-toggle-icon {
        font-size: 1.2rem;
        margin-right: 0.5rem;
    }

    .dropdown-menu {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        border: none;
        font-size: 0.9rem;
    }

    .dropdown-item {
        transition: background-color 0.3s ease;
        display: flex;
        align-items: center;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
    }

    .dropdown-item-icon {
        font-size: 1rem;
        margin-right: 0.5rem;
    }
</style>
<?php
     
    include 'db_connect.php';
    $type = array("", "Admin", "Staff", "Alumnus/Alumna");

?>
<div class="topbar">
    <div class="topbar-left">
        <span class="topbar-brand">School Faculty Scheduling System</span>
        <span class="topbar-time"><i class="fas fa-clock"></i> <span id="current-time"></span></span>
    </div>
    <div class="topbar-right">
        <button class="dropdown-toggle" type="button" id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle dropdown-toggle-icon"></i>
            <?php echo $_SESSION['login_name'] ?>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="account_settings">
            <a class="dropdown-item" href="javascript:void(0)" id="manage_my_account">
                <i class="fas fa-cog dropdown-item-icon"></i>
                Manage Account
            </a>
            <a class="dropdown-item" href="../login.php">
                <i class="fas fa-sign-out-alt dropdown-item-icon"></i>
                Logout
            </a>
        </div>
    </div>
</div>

<script>
    // Ensure the document is ready before attaching event handlers
    $(document).ready(function() {
        // DataTable initialization
        $('table').dataTable();

        // Click event handler for the "Manage Account" button
        $('#manage_my_account').click(function() {
            // Retrieve the user type
            var typeValue = "<?php echo $_SESSION['login_type']; ?>";

            // Construct the URL with the user type
            var url = "manage_user2.php?id=<?php echo $_SESSION['login_id']; ?>&type=" + typeValue;

            // Call the uni_modal function with the constructed URL
            uni_modal("Manage Account", url);
        });

        // Update the time every second
        function updateTime() {
            const currentTime = new Date();
            const hours = currentTime.getHours();
            const minutes = currentTime.getMinutes();
            const ampm = hours >= 12 ? 'PM' : 'AM';
            const formattedHours = hours % 12 || 12;
            const formattedMinutes = minutes < 10 ? '0' + minutes : minutes;
            const formattedTime = `${formattedHours}:${formattedMinutes} ${ampm}`;

            document.getElementById('current-time').textContent = formattedTime;
        }

        // Update the time immediately on page load
        updateTime();

        // Update the time every second
        setInterval(updateTime, 1000);
    });
</script>
