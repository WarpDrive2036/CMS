<?php require base_path('admin/partials_admin/header.php') ?>
<?php require base_path('admin/partials_admin/nav.php') ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <?php require base_path('admin/partials_admin/page_heading.php') ?>

                <style>
                    table {
                        border-collapse: collapse;
                        width: 100%;
                        max-width: 1200px;
                        margin: auto;
                    }

                    th,
                    td {
                        text-align: center;
                        padding: 8px;
                        border: 1px solid black;
                    }

                    th {
                        background-color: #ddd;
                    }

                    tr:nth-child(even) {
                        background-color: #f2f2f2;
                    }

                    .approve-btn,
                    .unapprove-btn,
                    .delete-btn,
                    .edit-btn {
                        background-color: #33a71c;
                        color: white;
                        border: none;
                        padding: 8px 16px;
                        border-radius: 4px;
                        cursor: pointer;
                        margin-bottom: 10px;
                        display: block;
                        width: 100%;
                    }

                    .approve-btn:hover,
                    .unapprove-btn:hover,
                    .delete-btn:hover,
                    .edit-btn:hover {
                        background-color: #1a73e8;
                    }
                </style>

                <table>
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>email</th>
                        <th>Role</th>
                        <th>Profile-Picture</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['firstname']) ?></td>
                            <td><?= htmlspecialchars($user['lastname']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td>



                                <form method="post">
                                    <select name="user_role" onchange="setUserRole(<?= $user['id'] ?>, this)">
                                        <option value="subscriber" <?= $user['role'] == 'subscriber' ? 'selected' : '' ?>>Subscriber</option>
                                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                    </select>
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                </form>

                            </td>
                            <td>
                                <img src="<?= file_exists('images/'.$user['user_image']) ? 'images/'.$user['user_image'] : $user['user_image'] ?>" style="width: 100px; height: 100px; object-fit: cover;">
                            </td>
                            <td>
                                <form style="display: inline-block;" name="update_role_<?= $user['id'] ?>" action="/Admin_users-add" method="post">
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                    <input type="hidden" name="status" value="Approved">
                                    <input type="hidden" name="user_role" id="user_role_<?= $user['id'] ?>" value="<?= $user['role'] ?>">
                                    <button class="approve-btn" type="submit" onclick="return confirm('Are you sure you want to change the role?')">Approve</button>
                                </form>


                                <!-- This script is used to set the selected value from the drop-down list to the hidden input field named "user_role_input".

                    When the "Approve" button is clicked, the "setUserRole()" function is called, which retrieves the selected value from the drop-down list by using its name attribute and index (in this case, the first and only one), and sets it as the value of the hidden input field.

                    Then, the script submits the form named "update_role", which includes the hidden input field with the selected value, to the specified action URL for processing.-->
                                <script>
                                    function setUserRole(userId, selectElement) {
                                        var userRoleInput = document.getElementById("user_role_" + userId);
                                        userRoleInput.value = selectElement.value;
                                    }
                                </script>


                                <form style="display: inline-block;" action="/User/delete" method="post">
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="delete-btn" type="submit" onclick="return confirm('Are you sure you want to delete this User?')">Delete</button>
                                </form>

                                <form style="display: inline-block;" action="/User_update" method="post">
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                    <input type="hidden" name="_method" value="PATCH">
                                    <button class="edit-btn" type="submit">Update Credentials</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<!-- /#wrapper -->

<?php require base_path('admin/partials_admin/footer.php')?>
