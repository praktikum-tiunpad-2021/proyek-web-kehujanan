# buat ui

- landing.php = pas pertama kali user masuk webnya
- login.php = dari landing page bisa login
- register.php = kalo blom punya akun register dulu baru login
- dashboard.php = page default (harusnya) kalo user udah login
- profile.php = cek profile user kalo udah login
- tugas/index.php = list tugas user
- tugas/create.php = form tambah tugas
- tugas/detail.php = lihat detail tugas
- tugas/edit.php = form edit/update tugas
- tugas/history.php = kalo sempet, bikin index.php cuma nampilin tugas yg belum deadline. terus history.php ini buat nampilin semua tugas
- layout/base.php = jadi dasar dari setiap page, udah termasuk navbar.php dan footer.php
- layout/navbar.php = navbarnya
- layout/footer.php = footer
- pagers/tugas+pagination.php = kalo tugasnya ada lebih dari 5, bakal muncul link angka 2 dan seterusnya di bawah tabel. ini tempat ngecustomize style linknya. kebagi jadi go to first, go to last, go to page <angka>, go to next, go to previous
