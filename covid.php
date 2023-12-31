






<?php if ($_GET['action'] == 'edit'): ?>
<div class="content profile">
  <h2>Edit Profile Page</h2>
  <div class="block">
    <form action="profile.php?action=edit" method="post">
      <label for="username">Username</label>
      <input type="text" value="<?=$_SESSION['name']?>" name="username" id="username" placeholder="Username">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="Password">
      <label for="cpassword">Confirm Password</label>
      <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password">
      <label for="email">Email</label>
      <input type="email" value="<?=$account['email']?>" name="email" id="email" placeholder="Email">
      <br>
      <input class="profile-btn" type="submit" value="Save">
      <p><?=$msg?></p>
    </form>
  </div>
</div>
<?php endif; ?>
</body>
</html>
