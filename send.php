<html>
<head>
    <title>Sinau</title>
</head>
<body>
    <?php
    include_once "koneksi.php";
    $namaTombol = "tambah";
    if(isset($_POST["tambah"])){
        // input data mahasiswa baru
        $namaMhs    = mysql_real_escape_string($_POST["jeneng"]);
        $alamatMhs  = $_POST["omah"];
        $teleponMhs = $_POST["telpon"];
        $emailMhs   = $_POST["surat"];
        mysql_query("INSERT INTO mahasiswa VALUES ('', '$namaMhs', '$alamatMhs', '$teleponMhs', '$emailMhs')");
        echo "<script>location.href='index.php';</script>";
    }elseif(isset($_POST["edit"])){
        $kodeMhsUntukEdit = $_GET["editMhs"];
        // ubah data mahasiswa -----------------------------------------------------
        $namaMhs    = mysql_real_escape_string($_POST["jeneng"]);
        $alamatMhs  = $_POST["omah"];
        $teleponMhs = $_POST["telpon"];
        $emailMhs   = $_POST["surat"];
        mysql_query("UPDATE dbmahasiswa SET namamhs = '$jeneng', alamatMhs = '$omah', teleponMhs = '$telpon', emailMhs = 'surat' WHERE kode_mhs = '$kodeMhsUntukEdit'");
        echo "<script>location.href='index.php';</script>";
    }
    if(isset($_GET["deleteMhs"]) AND trim($_GET["deleteMhs"])!=""){
        // jika terdapat query string (URL) deleteMhs & isi deleteMhs tidak kosong, maka dibawah ini ---------------------------
        $tampungKodeMhs = mysql_real_escape_string($_GET["deleteMhs"]);
        // query hapus data menggunakan "DELETE" -------------------------------------------------------------------
        mysql_query("DELETE FROM mahasiswa WHERE kode_mhs = '$tampungKodeMhs'");
        echo "<script>location.href='index.php';</script>";
    }
    if(isset($_GET["editMhs"]) AND trim($_GET["editMhs"])!=""){
        $namaTombol = "edit";
        $queryTampilkanEdit = mysql_query("SELECT * FROM mahasiswa WHERE kode_mhs = '$_GET[editMhs]'");
        $dataEdit = mysql_fetch_array($queryTampilkanEdit);
    }
    ?>
    <!-- Form tambah / edit data mahasiswa -->
    <form method="post" action="">
        Nama : <input type="text" value="<?php echo $dataEdit["nama_mhs"]; ?>" name="jeneng" /><br/>
        Alamat : <input type="text" value="<?php echo $dataEdit["alamat"]; ?>" name="omah" /><br/>
        Telepon : <input type="text" value="<?php echo $dataEdit["telepon"]; ?>" name="telpon" /><br/>
        Email : <input type="text" value="<?php echo $dataEdit["email"]; ?>" name="surat" /><br/>
        <input type="submit" name="<?php echo $namaTombol; ?>" value="simpan"/>
    </form>
    <hr/>
    <p></p>
    <!-- Tampilkan hasil semua yang ada di tabel mahasiswa -->
    <table cellpadding="3" cellspacing="1" border="1">
        <tr>
            <th>Kode</th>
            <th>Nama Mahasiswa</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Opsi</th>
        </tr>
        <?php
        // perintah menampilkan data "SELECT"
        $perintahTampil = "SELECT * FROM mahasiswa";
        $eksekusiSql = mysql_query($perintahTampil);
        while($tampilkan = mysql_fetch_array($eksekusiSql)){
            print "
                <tr>
                    <td>$tampilkan[kode_mhs]</td>
                    <td>$tampilkan[nama_mhs]</td>
                    <td>$tampilkan[alamat]</td>
                    <td>$tampilkan[telepon]</td>
                    <td>$tampilkan[email]</td>
                    <td>
                        <a href='index.php?deleteMhs=$tampilkan[kode_mhs]'>Hapus</a> |
                        <a href='index.php?editMhs=$tampilkan[kode_mhs]'>Edit</a>
                    </td>
                </tr>";
        }
        ?>
    </table>
</body>
</html>