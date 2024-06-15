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

.form-control {
    background-color: #fff;
    border: 1px solid #ddd;
    color: #333;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.form-control:focus {
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.btn {
    background-color: #fff;
    border: 1px solid #ddd;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.btn-primary {
    color: #007bff;
}

.btn-danger {
    color: #dc3545;
}

.btn:hover {
    background-color: #f5f5f5;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    transform: translateY(-2px);
}

.btn-primary:hover {
    background-color: #007bff;
    color: #fff;
}

.btn-danger:hover {
    background-color: #dc3545;
    color: #fff;
}

.btn-default:hover {
    background-color: #dc3545;
    color: #fff;
}

.table {
    background-color: #fff;
    color: #333;
    border: 2px solid #ffb3c6; /* Pink border for the table */
}

.table th,
.table td {
    border-color: #ddd;
}

/* Pink shade for the form */
#manage-course {
    background-color: #ffb3c6;
    color: #333;
}

#manage-course .card-header {
    background-color: #ff99b3;
    color: #333;
}

 

#manage-course .form-control:focus {
    background-color: #ffd9e6;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

#manage-course .btn {
    background-color: #ffd9e6;
    color: #333;
    border: 1px solid #ff99b3;
}

#manage-course .btn:hover {
    background-color: #ff99b3;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
</style>

<div class="container-fluid">
    <!-- Table Panel -->
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-list"></i> Course List
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center"><i class="fas fa-hashtag"></i></th>
                            <th class="text-center"><i class="fas fa-book"></i> Course</th>
                            <th class="text-center"><i class="fas fa-cog"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $course = $conn->query("SELECT * FROM courses order by id asc");
                        while ($row = $course->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td class="">
                                    <p><i class="fas fa-book-open"></i> Course: <b><?php echo $row['course'] ?></b></p>
                                    <p><i class="fas fa-quote-left"></i> Description: <small><b><?php echo $row['description'] ?></b></small></p>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-primary edit_course" type="button" data-id="<?php echo $row['id'] ?>" data-course="<?php echo $row['course'] ?>" data-description="<?php echo $row['description'] ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-danger delete_course" type="button" data-id="<?php echo $row['id'] ?>">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
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
    <div class="col-12">
        <form action="" id="manage-course">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-list"></i> Course Form
                </div>
                <div class="card-body">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label class="control-label">Course</label>
                        <input type="text" class="form-control" name="course">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Description</label>
                        <textarea class="form-control" cols="30" rows='3' name="description"></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary">
                                <i class="fas fa-save"></i> Save
                            </button>
                            <button class="btn btn-default" type="button" onclick="_reset()">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- FORM Panel -->
</div>

<script>
    function _reset() {
        $('#manage-course').get(0).reset()
        $('#manage-course input,#manage-course textarea').val('')
    }
    $('#manage-course').submit(function(e) {
        e.preventDefault()
        start_load()
        $.ajax({
            url: 'ajax.php?action=save_course',
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
    $('.edit_course').click(function() {
        start_load()
        var cat = $('#manage-course')
        cat.get(0).reset()
        cat.find("[name='id']").val($(this).attr('data-id'))
        cat.find("[name='course']").val($(this).attr('data-course'))
        cat.find("[name='description']").val($(this).attr('data-description'))
        end_load()
    })
    $('.delete_course').click(function() {
        _conf("Are you sure to delete this course?", "delete_course", [$(this).attr('data-id')])
    })
    function delete_course($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_course',
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