<?php
include('../../class/database.php');
include("../../class/form.php");

$config = include("../../class/config.php");

$db = new Database($config['host'], $config['username'], $config['password'], $config['latihan-1']);
$sql = 'SELECT * FROM data_barang';
$result = $db->query($sql);
?>

<?php require('../../template/header.php'); ?>
<div class="content">
    <h1>Data Barang</h1>
    <div class="main">
        <?php echo form::generateTable($result); ?>
    </div>
</div>
<?php require('../../template/footer.php'); ?>

<?php
$db->closeConnection();
?>