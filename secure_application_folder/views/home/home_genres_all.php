<div style="margin:0px 5px 0px 0px;"></div>
<div class="index_container">
<div class="heading_text">
<h1>Genres</h1>
</div>
<?php foreach($genres_all as $row_genre){ ?>
<div class="category_item"> <a href="<?php echo base_url(); ?>genre/<?php echo strtolower($row_genre['genre_name']); ?>"><?php echo $row_genre['genre_name']; ?></a> ( <?php echo $row_genre['no_of_count']; ?> Movies ) </div><?php } ?>
<div class="clearer"></div>
</div>
</div>