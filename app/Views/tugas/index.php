

<ul class="listWrapper">
  <?php
  // var_dump($selectedTags);
  // var_dump($query);
  // var_dump($tags);
  ?>
<?php $i = 1 ?>

<?php foreach ($tugas as $t) : ?>
    <li class="dbRow" onclick="this.classList.toggle('selected')" page="/tugas/<?= $t['id_tugas']; ?>" data="<?= $t['id_tugas']; ?>">
        <div class="index"><?= $i++ ?></div>
        <div class="nama"><?= $t['nama_tugas']; ?></div>
        <div class="deadline"><?= $t['deadline']; ?></div>
        <div class="tags">
          <?php foreach ($t['nama_tag'] as $nt) : ?>
            <div class="tag"><?=$nt?></div>
          <?php endforeach; ?>
        </div>
        <div class="edit" onclick="event.stopPropagation();editTugas(this)" page="/tugas/edit/<?= $t['id_tugas']; ?>"><i class="fas fa-pen"></i></div>
        <div class="delete" onclick="event.stopPropagation();deleteTugas(this);"  action="/tugas/<?= $t['id_tugas']; ?>" method="DELETE"><i class="fas fa-trash"></i></div>
        <div class="mark<?php if ($t['status'] == 0) {
                      echo "";
                    } else {
                      echo " selesai";
                    } ?>" onclick="event.stopPropagation();markTugas(this);"  action="/tugas/mark/<?= $t['id_tugas']; ?>" method="GET"><i class="fas fa-check"></i></div>
    </li>
    <div class="detail">
      <div class="name">ID :</div><div class="index"><?= $t['id_tugas'];?></div>
      <div class="name">Time left :</div><div class="timeLeft"><?=$t['timeLeft'];?></div>
      <div class="name">Desc :</div><div class="desc"><?= $t['deskripsi'];?></div>
    </div>
    <?php endforeach; ?>
      
      
      
      <!-- <button type="button" onclick="addTag(document.getElementById('tagchoice'),document.getElementById('selectedTags'));">Add tag</button> -->
      
      
    <!-- <div><button onclick="document.getElementById('keyword').value = '';">clear search</button></div> -->
</ul>
<script class="inject once">
  appendNotification('<?=session()->get('pesan')?>'<?php if(session()->get('isError'))echo',true';?>);
  <?php if(!$isPost) : ?>
    if(document.getElementById('tagList'))
    document.getElementById('tagList').remove();
    let tagList = document.createElement('datalist');
    let selectedList = document.getElementById('selectedTags');
    let searchBar = document.getElementById('searchBar');
    tagList.id = "tagList";
    <?php foreach ($tags as $t2) : ?>
      tagList.appendChild(htmlToElement(" <option value=\"<?=$t2?>\" id=\"<?="tagOption_".$t2?>\"<?php if(in_array($t2,$selectedTags))echo "disabled" ?>></option>"));
    <?php endforeach; ?>
    document.getElementById('filterForm').appendChild(tagList);
    searchBar.value = "<?=$keyword?>";
    <?php foreach ($selectedTags as $st) : ?>
      selectedList.appendChild(htmlToElement("<input type=\"checkbox\" class=\"tag\" value=\"<?=$st?>\" checked name=\"selectedTags[]\" onclick=\"clearTag(this);\"></input>"))
    <?php endforeach; ?>
<?php endif; ?>
</script>