<?php require_once 'inc/top.php'; ?>
<h3>Lisää uusi</h3>
<form action="save.php" method="post">
    <div>
        <label>Kuvaus</label>
    </div>
    <textarea name="task"></textarea>
    <div>
        <button type="button" onclick="window.location.href='index.php';">Peruuta</button>
        <button>Tallenna</button>
    </div>
</form>
<?php require_once 'inc/top.php'; ?>
<h3>Tallenna</h3>
<?php
try {
    $description = filter_input(INPUT_POST,'task',FILTER_SANITIZE_STRING);
    $query = $db->prepare("INSERT INTO task (description) VALUES (:description);");
    $query->bindvalue(':description', $description,PDO::PARAM_STR);
    $query->execute();
    print "<p>Tehtävä lisätty!</p>";
}
catch (PDOExpection $pdoex) {
    print "<p> Tietojen tallennus epäonnistui. " . $pdoex->getMessage() . "</p>";
}
?>
<a href="index.php">Tehtävälistaan</a>
<?php require_once 'inc/bottom.php'; ?>