<?php if (\helper\Visitor::isAftaa()): ?>
    <header>
        <a href="/" data-uri="/">home page</a>
        <a href="/expert.php" data-uri="expert.php">expert mode</a>
        <a href="/admin.php" data-uri="admin.php">admin panel</a>
        <?php if (\helper\Visitor::isLogIn()): ?>
            <a href="/logout.php" data-uri="logout.php">logout</a>
        <?php else: ?>
            <a href="/login.php" data-uri="login.php">login</a>
        <?php endif ?>
    </header>
<?php endif ?>
