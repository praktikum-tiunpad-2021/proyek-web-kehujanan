<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="/css/form.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <script src="https://kit.fontawesome.com/2be75d9ff2.js" crossorigin="anonymous"></script>
</head>
<body>
    <aside class="sideWrapper" activeBtn="<?=$activeBtn?>">
        <header class="sidebar">
            <section class="sidebarBtn" id="index" tooltip="Daftar Tugas" page="/tugas/index">
                <i class="fas fa-list-ul"></i>
                <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Color_icon_black_%26_purple.svg/300px-Color_icon_black_%26_purple.svg.png" alt=" "> -->
            </section>
            <section class="sidebarBtn" id="create" tooltip="Tambah Tugas" page="/tugas/create">
                <i class="far fa-plus-square"></i>
            </section>
            <section class="sidebarBtn" id="filter" tooltip="Filter" onclick="toggleFilter();">
                <i class="fas fa-filter"></i>
            </section>
            <section class="sidebarBtn hidden" id="edit" tooltip="Edit Tugas" page="/tugas/edit/<?=$idTugas?>">
                <i class="fas fa-pen"></i>
            </section>
        </header>
        <footer class="sidefoot">    
            <section class="sidebarBtn image" id="profile" tooltip="Profile" page="/profile">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ17UrSrt1PEQmqQje4TLYndEF_VGKiw4HoSe8TL3CteEs_s-OP5xpnieI8weMGju6lQnc&usqp=CAU"/>
            </section>
            <section class="sidebarBtn child" tooltip="Logout" onclick="if(confirm('Yakin ingin Logout ?'))window.location.pathname ='/logout';">
                <i class="fas fa-sign-out-alt"></i>
            </section>
        </footer>
    </aside>
    <header id="notificationList" class="empty"></header>
    <section id="filterModal" class="modal hidden">
        <form id="filterForm" class="filterContainer" action="/tugas/index" method="post" autocomplete="off">
            <div class="item" >
                <h1 style="border-width: 0px;font-size:200%;font-weight:lighter;">Filter Menu</h1>
            </div>
            <div class="item">
                <input class="input" placeholder=" "  type="search" placeholder="Search" name="keyword" id="searchBar" value="">
                <label for="searchBar" class="label">Keyword</label>
            </div>
            <div class="item">
                <input class="input" placeholder=" " type="text" list="tagList" id="tagchoice" value="" oninput="addTag(this,document.getElementById('selectedTags'));">
                <label for="tagchoice" class="staticLabel">Pilih tag</label>
            </div>
            <div class="tags" id="selectedTags" style="min-height: 25px;padding:6px 10px;">
            </div>
            <div class="item">
                <button class="textButton" type="button" onclick="clearTags(document.getElementById('selectedTags'));">clear tag</button>
                <button class="textButton" style="right: -10px;" type="button" onclick="postForm(document.querySelector('#filterForm'));">Apply Filter</button>
            </div>
        </form>
    </section>
    <footer><div>by Team Kehujanan</div></footer>
    <section id="injectContainer"></section>
    <section class="overlay hidden"><i class="fas fa-spinner spinning"></i></section>
</body>
<script id="injectScipt" ></script>
<script src="/js/landing.js"></script>
</html>
