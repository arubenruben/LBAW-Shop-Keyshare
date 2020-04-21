<section id="breadcrumbContainer">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i>Home</a></li>
    <?php
    for($i=0;$i<count($pages);$i++){
        $page=$pages[$i]; 
        $link=$links[$i];?>
        <li class="breadcrumb-item"><a href="<?=$link?>"><?=$page?></a></li>
    <?php } ?>
    </ol>
</section>