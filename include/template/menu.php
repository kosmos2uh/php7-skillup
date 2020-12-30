<div class="navbar-nav">
    <a class="nav-link active" aria-current="page" href="/">Home</a>
    <a class="nav-link" href="/list.php">List</a>
    <a class="nav-link" href="/detail.php">Detail</a>
    <a class="nav-link" href="/info.php">Info</a>
    <a class="nav-link" href="/contacts.php">Contacts</a>
    <?php if(isAuthorizedUser()) { ?>
        <a class="nav-link fw-bold" href="/profile.php"><?php echo $_SESSION['user']['name']; ?></a>
        <a class="nav-link" href="/logout.php">[Logout]</a>
    <?php } else { ?>
        <a class="nav-link" href="/auth.php">Profile</a>
    <?php } ?>
</div>