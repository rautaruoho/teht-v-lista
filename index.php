<?php require_once 'inc/top.php'; ?>
<?php
if (isset($_GET['id'])) {
    try {
        $id = filter_input(INPUT_GET, 'id' ,FILTER_SANITIZE_NUMBER_INT);
        $query = $db->prepare("UPDATE task SET done = true WHERE id = :id;");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }
    catch (PDOException $pdoex) {
        print "<p> Tietojen päivittäminen epäonnistui. " . $pdoex->getMessage() . "</p>";
    }
}
?>

<h3>Tehtävälista</h3>
<a href="add.php">Lisää uusi</a>
<form action="delete.php" method="post">
    <div id="poista_valitut">
        <button>Poista valitut</button>
    </div>
<table>
<?php
try {
    $sql = "SELECT * FROM task ORDER BY id";
    $query = $db->query($sql);
    $query->setFetchMode(PDO::FETCH_OBJ);
    $i = 1;
    while ($row = $query->fetch()) {
        print "<tr>";
        print "<td>$i.</td>";
        print "<td";
        if ($row->done) {
            print "class='done'";
        }
        print "><a href='" . $_SERVER['PHP_SELF'] . "?id=" . $row->id . "'>" . $row->description - "</a></td>";
        print "<td>" .date('d.mY h.i',strtotime($row->added)) . "</td>";
        print "<td><input name='id[]' type='checkbox' value='" . $row->id . "'><td>";
        print "</tr>";
        $i++;
    }

}
catch (PDOException $pdoex) {
    print "<p>Tietojen hakeminen epäonnistui. " . $pdoex->getMessage() . "</p>";
}
?>
</table>
</form>