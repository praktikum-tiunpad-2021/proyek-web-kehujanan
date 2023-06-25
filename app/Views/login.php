<head>
  <script src="https://kit.fontawesome.com/2be75d9ff2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="/css/landing.css">
</head>
<body>
  <form action="/" class="container" method="POST" autocomplete="off">
  <div class="item" >
                <h1 style="border-width: 0px;font-size:200%;font-weight:lighter;margin-bottom:30px">App Tugas</h1>
            </div>
<div class="item"><input type="email" id="email" name="email" class="input" placeholder=" " autocomplete="off">
    <label class="label" for="email">Email</label></div>

    <div class="item"><input type="password" id="password" name="password" class="input" placeholder=" " autocomplete="off">
    <label class="label" for="password">Password</label></div>
    <div class="item errors">
    <?php if (isset($validation)) : ?>
      <div class="errors">
        <?= $validation->listErrors(); ?>
      </div>
    <?php endif; ?>
    </div>
    <div class="item">
      <a href="/register" class="textButton" text="register"><span>belum punya akun?</span></a>
      <button type="submit" class="buttonText" text="login"><i class="fas fa-sign-in-alt"></i></button></div>
  </section>
</body>