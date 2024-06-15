<?php ?>

<div class="container-fluid">
    <div class="row">
         
    </div>
    <br>
    <div class="row">
        <div class="card col-lg-12">
            <div class="card-body">
                <table class="table-striped table-bordered col-md-12">
                    <thead>
                        <tr>
                            <th class="text-center"><i class="fas fa-hashtag"></i></th>
                            <th class="text-center"><i class="fas fa-user"></i> Name</th>
                            <th class="text-center"><i class="fas fa-user-circle"></i> Username</th>
                            <th class="text-center"><i class="fas fa-user-tag"></i> Type</th>
                             
                             
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'db_connect.php';
                        $type = array("", "Admin", "Staff", "Alumnus/Alumna");
                        $users = $conn->query("SELECT * FROM users order by name asc");
                        $i = 1;
                        while ($row = $users->fetch_assoc()) :
                        ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo $i++ ?>
                                </td>
                                <td>
                                    <?php echo ucwords($row['name']) ?>
                                </td>
                                <td>
                                    <?php echo $row['username'] ?>
                                </td>
                                <td>
                                    <?php echo $type[$row['type']] ?>
                                </td>
                                
                                
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<script>
    $('table').dataTable();
    $('#new_user').click(function() {
        uni_modal('New User', 'manage_user.php')
    })
    $('.edit_user').click(function() {
        uni_modal('Edit User', 'manage_user.php?id=' + $(this).attr('data-id') + '&name=' + $(this).attr('data-name') + '&username=' + $(this).attr('data-username') + '&type=' + $(this).attr('data-type'))
    })
    $('.delete_user').click(function() {
        _conf("Are you sure to delete this user?", "delete_user", [$(this).attr('data-id')])
    })

    function delete_user($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_user',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }
</script>