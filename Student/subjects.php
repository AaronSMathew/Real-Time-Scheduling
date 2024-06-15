<?php include('db_connect.php'); ?>

<style>
     @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

body {
    background: #f5f5f5;
    font-family: 'Poppins', sans-serif;
}

.card {
    background-color: #fff;
    border: 1px solid #ddd;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.card-header {
    background-color: #f5f5f5;
    color: #333;
    font-weight: 600;
    padding: 1rem;
}

/* Styles remain the same */

</style>

<div class="container-fluid">
    <!-- Table Panel -->
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-book"></i> Subject List
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center"><i class="fas fa-hashtag"></i></th>
                            <th class="text-center"><i class="fas fa-book-open"></i> Subject</th>
                             
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $subject = $conn->query("SELECT * FROM subjects order by id asc");
                        while ($row = $subject->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td class="">
                                    <p><i class="fas fa-book"></i> Subject: <b><?php echo $row['subject'] ?></b></p>
                                    <p><i class="fas fa-quote-left"></i> Description: <small><b><?php echo $row['description'] ?></b></small></p>
                                </td>
                                 
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Table Panel -->

    <!-- FORM Panel -->
     
    <!-- FORM Panel -->
</div>

<script>
    function _reset() {
        $('#manage-subject').get(0).reset()
        $('#manage-subject input,#manage-subject textarea').val('')
    }
    $('#manage-subject').submit(function(e) {
        e.preventDefault()
        start_load()
        $.ajax({
            url: 'ajax.php?action=save_subject',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully added", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                }
            }
        })
    })
    $('.edit_subject').click(function() {
        start_load()
        var cat = $('#manage-subject')
        cat.get(0).reset()
        cat.find("[name='id']").val($(this).attr('data-id'))
        cat.find("[name='subject']").val($(this).attr('data-subject'))
        cat.find("[name='description']").val($(this).attr('data-description'))
        end_load()
    })
    $('.delete_subject').click(function() {
        _conf("Are you sure to delete this subject?", "delete_subject", [$(this).attr('data-id')])
    })
    function delete_subject($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_subject',
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
    $('table').dataTable()
</script>