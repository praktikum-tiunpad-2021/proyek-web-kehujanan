
<main>
  <h2>Detail Tugas</h2>
  <div>
    <p> ID Tugas : <?= $tugas['id_tugas']; ?></p>
    <p> Nama Tugas : <?= $tugas['nama_tugas']; ?></p>
    <p> Deskripsi : <?= $tugas['deskripsi']; ?></p>
    <p> Deadline : <?= $tugas['deadline']; ?></p>
    <p> ID User : <?= $tugas['id_user']; ?></p>
    <p> ID Matkul : <?= $tugas['id_matkul']; ?></p>
  </div>
  <a onclick="aactivate(this);" page="/tugas/edit/<?= $tugas['id_tugas']; ?>">Edit</a><br>
  <button onclick="deleteTugas(this);"  action="/tugas/<?= $tugas['id_tugas']; ?>" method="DELETE">DELETE</button><br>
  <a onclick="aactivate(this);" page="/tugas">-Kembali</a>
</main>
