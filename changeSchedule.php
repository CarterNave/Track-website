<?php
include 'main.php';
// Default input account values
$account = array(
    'username' => '',
    'password' => '',
    'email' => '',
    'activation_code' => '',
    'rememberme' => '',
    'role' => 'Athlete',
    'event_name'=> ''
);
$roles = array('Coach', 'Athlete');
$eventss = array('PV', 'Multi', ' Jav');
if (isset($_GET['id'])) {
    // Get the account from the database
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE id = ?');
    $stmt->execute([ $_GET['id'] ]);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);
    // ID param exists, edit an existing account
    $page = 'Edit';
    if (isset($_POST['submit'])) {
        // Update the account
        $stmt = $pdo->prepare('UPDATE accounts SET username = ?, password = ?, email = ?, activation_code = ?, rememberme = ?, role = ?, event_name = ?, workout_desc=? WHERE id = ?');
        $password = $account['password'] != $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $account['password'];
        $stmt->execute([ $_POST['username'], $password, $_POST['email'], $_POST['activation_code'], $_POST['rememberme'], $_POST['role'], $_POST['event_name'],$_POST['workout_desc'], $_GET['id'] ]);
        header('Location: index.php');
        exit;
    }
    if (isset($_POST['delete'])) {
        // Delete the account
        $stmt = $pdo->prepare('DELETE FROM accounts WHERE id = ?');
        $stmt->execute([ $_GET['id'] ]);
        header('Location: index.php');
        exit;
    }
} else {
    // Create a new account
    $page = 'Create';
    if (isset($_POST['submit'])) {
        $stmt = $pdo->prepare('INSERT IGNORE INTO accounts (username,password,email,activation_code,rememberme,role,event_name,workout_desc) VALUES (?,?,?,?,?,?,?,?)');
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt->execute([ $_POST['username'], $password, $_POST['email'], $_POST['activation_code'], $_POST['rememberme'], $_POST['role'], $_POST['event_name'], $_POST['workout_desc']]);
        header('Location: index.php');
        exit;
    }
}
?>




<?=template_admin_header($page.'Schedule')?>

<h2>Schedule</h2>


<div class="content-block">
      <form action="" method="post" class="form responsive-width-100">
        <label for = "PV"> PV</label>
        <input type="text" id="PV" name="PV" value="workout" required> <br><br>
        <label for = "Jav"> Jav</label>
        <input type="text" id="Jav" name="Jav"><br><br>
        <label for = "Multi"> Multi</label>
        <input type="text" id="Multi" name="Multi"><br><br>
        <div class="submit-btns">
            <input type="submit" name="submit" value="Submit">
            <?php if ($page == 'Edit'): ?>
            <?php endif; ?>
            </div>
    </div>
</div>

<?=template_admin_footer()?>
