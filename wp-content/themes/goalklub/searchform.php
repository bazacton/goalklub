<?php 
/**
 * The template for displaying Search Form
 */
 global $cs_theme_options
?>
 

<div class="cs-search-area">
    <form  method="get" action="<?php echo home_url()?>"  role="search">
        <input  class="form-control"name="s" placeholder="<?php  _e('Search here','goalklub');?>"  value="" type="text" />
        <label class="search-submit"><input value="<?php  _e('Search','goalklub');?>" id="searchsubmit" type="submit"></label>
    </form>
</div>
