<?php
require_once (get_template_directory() . '/include/global_variables.php');

function cs_comment_tut_fields() {
    if (is_user_logged_in())
        $cs_msg_class = ' ';
    $cs_msg_class = isset($cs_msg_class) ? $cs_msg_class : '';
    $you_may_use = __('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'goalklub');
    $cs_comment_opt_array = array(
        'std' => '',
        'id' => '',
        'classes' => 'commenttextarea',
        'extra_atr' => ' rows="55" cols="15"',
        'cust_id' => 'comment_mes',
        'cust_name' => 'comment',
        'return' => true,
        'required' => false
    );
    $req = isset($req) ? $req : '';
        $html = '<p class="comment-form-comment">'.
                ''.__( '', 'goalklub'). ''.( $req ? __( '', 'goalklub') : '' ) .'' .
                '<label><i class="icon-quote3"></i></label><textarea placeholder="Message" id="comment_mes" name="comment"  class="commenttextarea" rows="4" cols="39"></textarea>' .
                '</p>';
   

    echo force_back($html);
}

function cs_filter_comment_form_field_comment($field) {

    return '';
}

// add the filter
//add_filter('comment_form_field_comment', 'cs_filter_comment_form_field_comment', 10, 1);

//add_action('comment_form_logged_in_after', 'cs_comment_tut_fields');
//add_action('comment_form_after_fields', 'cs_comment_tut_fields');

if(function_exists('cs_remove_filters')){
    cs_remove_filters('the_title_rss', 'strip_tags');
}

//Custom Width Height Settings (Gallery)
add_filter('wp_get_attachment_link', 'cs_remove_img_width_height', 10, 4);
add_filter('wp_get_attachment_link', 'cs_add_lighbox_rel');
add_filter('wp_get_attachment_url', 'cs_add_lighbox_rel');
add_filter('shortcode_atts_gallery', 'cs_default_gallery_atts', 10, 3);
add_filter('media_view_settings', 'cs_gallery_default_type_set_link');

function cs_gallery_default_type_set_link($settings) {
    $settings['galleryDefaults']['link'] = 'file';
    return $settings;
}

function cs_remove_img_width_height($html, $post_id, $post_image_id, $post_thumbnail) {
    if ($post_thumbnail == 'gallery') {
        $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    }
    return $html;
}

/* function cs_add_lighbox_rel( $attachment_link ) {
  if( strpos( $attachment_link , 'a href') != false && strpos( $attachment_link , 'img src') != false )
  $attachment_link = str_replace( 'a href' , 'a data-rel="prettyPhoto" href' , $attachment_link );
  return $attachment_link;
  } */

function cs_add_lighbox_rel($attachment_link) {
    $attachment_link = str_replace('a href', 'a data-rel="prettyPhoto" href', $attachment_link);
    return $attachment_link;
}

function cs_default_gallery_atts($out, $pairs, $atts) {
    $atts = shortcode_atts(array(
        'columns' => '4',
        'size' => 'cs_media_8',
            ), $atts);

    $out['columns'] = $atts['columns'];
    $out['size'] = $atts['size'];

    return $out;
}

add_filter('post_gallery', 'cs_custom_gallery', 10, 2);

function cs_custom_gallery($output, $attr) {
    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'include' => '',
        'exclude' => ''
                    ), $attr));

    $id = intval($id);
    if ('RAND' == $order)
        $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }
  
    if (empty($attachments))
        return '';

    // Here's your actual output, you may customize it to your need

    $output .= "<div id=\"gallery-1\" class=\"gallery galleryid-367 gallery-columns-4 gallery-size-cs_media_8\">\n";
    // Now you loop through each attachment
    foreach ($attachments as $id => $attachment) {
        $img_full = wp_get_attachment_image_src($id, 'full');
        $img = wp_get_attachment_image_src($id, 'cs_media_3');


        $output .= "<dl class=\"gallery-item\">\n";
        $output .= "<dt class=\"gallery-icon landscape\">\n";
        $output .= "<a   rel=\"prettyPhoto[pp_gal]\"   href=\"{$img[0]}\" data-rel=\"prettyPhoto".$post->ID."\">\n";
        $output .= "<img src=\"{$img[0]}\" alt=\"\" />\n";
        $output .= "</a>\n";
        $output .= "</dt>\n";
        $output .= "</dl>\n";
    }
      ?>
<script type="text/javascript" charset="utf-8">
 
  jQuery(document).ready(function(){
      jQuery('.gallery-item').find('a').has('img').addClass('prettyPhoto');
    jQuery("a[class^='prettyPhoto']").prettyPhoto();
  });

</script>
<?php
    ?>

    <?php
    $output .= "</div>\n";

    return $output;
}

function cs_get_google_init_arrays() {
    $font_list_init = array
        (
        'ABeeZee' => 'ABeeZee',
        'Abel' => 'Abel',
        'Abril Fatface' => 'Abril Fatface',
        'Aclonica' => 'Aclonica',
        'Acme' => 'Acme',
        'Actor' => 'Actor',
        'Adamina' => 'Adamina',
        'Advent Pro' => 'Advent Pro',
        'Aguafina Script' => 'Aguafina Script',
        'Akronim' => 'Akronim',
        'Aladin' => 'Aladin',
        'Aldrich' => 'Aldrich',
        'Alegreya' => 'Alegreya',
        'Alegreya SC' => 'Alegreya SC',
        'Alex Brush' => 'Alex Brush',
        'Alfa Slab One' => 'Alfa Slab One',
        'Alice' => 'Alice',
        'Alike' => 'Alike',
        'Alike Angular' => 'Alike Angular',
        'Allan' => 'Allan',
        'Allerta' => 'Allerta',
        'Allerta Stencil' => 'Allerta Stencil',
        'Allura' => 'Allura',
        'Almendra' => 'Almendra',
        'Almendra Display' => 'Almendra Display',
        'Almendra SC' => 'Almendra SC',
        'Amarante' => 'Amarante',
        'Amaranth' => 'Amaranth',
        'Amatic SC' => 'Amatic SC',
        'Amethysta' => 'Amethysta',
        'Anaheim' => 'Anaheim',
        'Andada' => 'Andada',
        'Andika' => 'Andika',
        'Angkor' => 'Angkor',
        'Annie Use Your Telescope' => 'Annie Use Your Telescope',
        'Anonymous Pro' => 'Anonymous Pro',
        'Antic' => 'Antic',
        'Antic Didone' => 'Antic Didone',
        'Antic Slab' => 'Antic Slab',
        'Anton' => 'Anton',
        'Arapey' => 'Arapey',
        'Arbutus' => 'Arbutus',
        'Arbutus Slab' => 'Arbutus Slab',
        'Architects Daughter' => 'Architects Daughter',
        'Archivo Black' => 'Archivo Black',
        'Archivo Narrow' => 'Archivo Narrow',
        'Arimo' => 'Arimo',
        'Arizonia' => 'Arizonia',
        'Armata' => 'Armata',
        'Artifika' => 'Artifika',
        'Arvo' => 'Arvo',
        'Asap' => 'Asap',
        'Asset' => 'Asset',
        'Astloch' => 'Astloch',
        'Asul' => 'Asul',
        'Atomic Age' => 'Atomic Age',
        'Aubrey' => 'Aubrey',
        'Audiowide' => 'Audiowide',
        'Autour One' => 'Autour One',
        'Average' => 'Average',
        'Average Sans' => 'Average Sans',
        'Averia Gruesa Libre' => 'Averia Gruesa Libre',
        'Averia Libre' => 'Averia Libre',
        'Averia Sans Libre' => 'Averia Sans Libre',
        'Averia Serif Libre' => 'Averia Serif Libre',
        'Bad Script' => 'Bad Script',
        'Balthazar' => 'Balthazar',
        'Bangers' => 'Bangers',
        'Basic' => 'Basic',
        'Battambang' => 'Battambang',
        'Baumans' => 'Baumans',
        'Bayon' => 'Bayon',
        'Belgrano' => 'Belgrano',
        'Belleza' => 'Belleza',
        'BenchNine' => 'BenchNine',
        'Bentham' => 'Bentham',
        'Berkshire Swash' => 'Berkshire Swash',
        'Bevan' => 'Bevan',
        'Bigelow Rules' => 'Bigelow Rules',
        'Bigshot One' => 'Bigshot One',
        'Bilbo' => 'Bilbo',
        'Bilbo Swash Caps' => 'Bilbo Swash Caps',
        'Bitter' => 'Bitter',
        'Black Ops One' => 'Black Ops One',
        'Bokor' => 'Bokor',
        'Bonbon' => 'Bonbon',
        'Boogaloo' => 'Boogaloo',
        'Bowlby One' => 'Bowlby One',
        'Bowlby One SC' => 'Bowlby One SC',
        'Brawler' => 'Brawler',
        'Bree Serif' => 'Bree Serif',
        'Bubblegum Sans' => 'Bubblegum Sans',
        'Bubbler One' => 'Bubbler One',
        'Buda' => 'Buda',
        'Buenard' => 'Buenard',
        'Butcherman' => 'Butcherman',
        'Butterfly Kids' => 'Butterfly Kids',
        'Cabin' => 'Cabin',
        'Cabin Condensed' => 'Cabin Condensed',
        'Cabin Sketch' => 'Cabin Sketch',
        'Caesar Dressing' => 'Caesar Dressing',
        'Cagliostro' => 'Cagliostro',
        'Calligraffitti' => 'Calligraffitti',
        'Cambo' => 'Cambo',
        'Candal' => 'Candal',
        'Cantarell' => 'Cantarell',
        'Cantata One' => 'Cantata One',
        'Cantora One' => 'Cantora One',
        'Capriola' => 'Capriola',
        'Cardo' => 'Cardo',
        'Carme' => 'Carme',
        'Carrois Gothic' => 'Carrois Gothic',
        'Carrois Gothic SC' => 'Carrois Gothic SC',
        'Carter One' => 'Carter One',
        'Caudex' => 'Caudex',
        'Cedarville Cursive' => 'Cedarville Cursive',
        'Ceviche One' => 'Ceviche One',
        'Changa One' => 'Changa One',
        'Chango' => 'Chango',
        'Chau Philomene One' => 'Chau Philomene One',
        'Chela One' => 'Chela One',
        'Chelsea Market' => 'Chelsea Market',
        'Chenla' => 'Chenla',
        'Cherry Cream Soda' => 'Cherry Cream Soda',
        'Cherry Swash' => 'Cherry Swash',
        'Chewy' => 'Chewy',
        'Chicle' => 'Chicle',
        'Chivo' => 'Chivo',
        'Cinzel' => 'Cinzel',
        'Cinzel Decorative' => 'Cinzel Decorative',
        'Clicker Script' => 'Clicker Script',
        'Coda' => 'Coda',
        'Coda Caption' => 'Coda Caption',
        'Codystar' => 'Codystar',
        'Combo' => 'Combo',
        'Comfortaa' => 'Comfortaa',
        'Coming Soon' => 'Coming Soon',
        'Concert One' => 'Concert One',
        'Condiment' => 'Condiment',
        'Content' => 'Content',
        'Contrail One' => 'Contrail One',
        'Convergence' => 'Convergence',
        'Cookie' => 'Cookie',
        'Copse' => 'Copse',
        'Corben' => 'Corben',
        'Courgette' => 'Courgette',
        'Cousine' => 'Cousine',
        'Coustard' => 'Coustard',
        'Covered By Your Grace' => 'Covered By Your Grace',
        'Crafty Girls' => 'Crafty Girls',
        'Creepster' => 'Creepster',
        'Crete Round' => 'Crete Round',
        'Crimson Text' => 'Crimson Text',
        'Croissant One' => 'Croissant One',
        'Crushed' => 'Crushed',
        'Cuprum' => 'Cuprum',
        'Cutive' => 'Cutive',
        'Cutive Mono' => 'Cutive Mono',
        'Damion' => 'Damion',
        'Dancing Script' => 'Dancing Script',
        'Dangrek' => 'Dangrek',
        'Dawning of a New Day' => 'Dawning of a New Day',
        'Days One' => 'Days One',
        'Delius' => 'Delius',
        'Delius Swash Caps' => 'Delius Swash Caps',
        'Delius Unicase' => 'Delius Unicase',
        'Della Respira' => 'Della Respira',
        'Denk One' => 'Denk One',
        'Devonshire' => 'Devonshire',
        'Didact Gothic' => 'Didact Gothic',
        'Diplomata' => 'Diplomata',
        'Diplomata SC' => 'Diplomata SC',
        'Domine' => 'Domine',
        'Donegal One' => 'Donegal One',
        'Doppio One' => 'Doppio One',
        'Dorsa' => 'Dorsa',
        'Dosis' => 'Dosis',
        'Dr Sugiyama' => 'Dr Sugiyama',
        'Droid Sans' => 'Droid Sans',
        'Droid Sans Mono' => 'Droid Sans Mono',
        'Droid Serif' => 'Droid Serif',
        'Duru Sans' => 'Duru Sans',
        'Dynalight' => 'Dynalight',
        'EB Garamond' => 'EB Garamond',
        'Eagle Lake' => 'Eagle Lake',
        'Eater' => 'Eater',
        'Economica' => 'Economica',
        'Electrolize' => 'Electrolize',
        'Elsie' => 'Elsie',
        'Elsie Swash Caps' => 'Elsie Swash Caps',
        'Emblema One' => 'Emblema One',
        'Emilys Candy' => 'Emilys Candy',
        'Engagement' => 'Engagement',
        'Englebert' => 'Englebert',
        'Enriqueta' => 'Enriqueta',
        'Erica One' => 'Erica One',
        'Esteban' => 'Esteban',
        'Euphoria Script' => 'Euphoria Script',
        'Ewert' => 'Ewert',
        'Exo' => 'Exo',
        'Expletus Sans' => 'Expletus Sans',
        'Fanwood Text' => 'Fanwood Text',
        'Fascinate' => 'Fascinate',
        'Fascinate Inline' => 'Fascinate Inline',
        'Faster One' => 'Faster One',
        'Fasthand' => 'Fasthand',
        'Federant' => 'Federant',
        'Federo' => 'Federo',
        'Felipa' => 'Felipa',
        'Fenix' => 'Fenix',
        'Finger Paint' => 'Finger Paint',
        'Fjalla One' => 'Fjalla One',
        'Fjord One' => 'Fjord One',
        'Flamenco' => 'Flamenco',
        'Flavors' => 'Flavors',
        'Fondamento' => 'Fondamento',
        'Fontdiner Swanky' => 'Fontdiner Swanky',
        'Forum' => 'Forum',
        'Francois One' => 'Francois One',
        'Freckle Face' => 'Freckle Face',
        'Fredericka the Great' => 'Fredericka the Great',
        'Fredoka One' => 'Fredoka One',
        'Freehand' => 'Freehand',
        'Fresca' => 'Fresca',
        'Frijole' => 'Frijole',
        'Fruktur' => 'Fruktur',
        'Fugaz One' => 'Fugaz One',
        'GFS Didot' => 'GFS Didot',
        'GFS Neohellenic' => 'GFS Neohellenic',
        'Gabriela' => 'Gabriela',
        'Gafata' => 'Gafata',
        'Galdeano' => 'Galdeano',
        'Galindo' => 'Galindo',
        'Gentium Basic' => 'Gentium Basic',
        'Gentium Book Basic' => 'Gentium Book Basic',
        'Geo' => 'Geo',
        'Geostar' => 'Geostar',
        'Geostar Fill' => 'Geostar Fill',
        'Germania One' => 'Germania One',
        'Gilda Display' => 'Gilda Display',
        'Give You Glory' => 'Give You Glory',
        'Glass Antiqua' => 'Glass Antiqua',
        'Glegoo' => 'Glegoo',
        'Gloria Hallelujah' => 'Gloria Hallelujah',
        'Goblin One' => 'Goblin One',
        'Gochi Hand' => 'Gochi Hand',
        'Gorditas' => 'Gorditas',
        'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
        'Graduate' => 'Graduate',
        'Grand Hotel' => 'Grand Hotel',
        'Gravitas One' => 'Gravitas One',
        'Great Vibes' => 'Great Vibes',
        'Griffy' => 'Griffy',
        'Gruppo' => 'Gruppo',
        'Gudea' => 'Gudea',
        'Habibi' => 'Habibi',
        'Hammersmith One' => 'Hammersmith One',
        'Hanalei' => 'Hanalei',
        'Hanalei Fill' => 'Hanalei Fill',
        'Handlee' => 'Handlee',
        'Hanuman' => 'Hanuman',
        'Happy Monkey' => 'Happy Monkey',
        'Headland One' => 'Headland One',
        'Henny Penny' => 'Henny Penny',
        'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
        'Holtwood One SC' => 'Holtwood One SC',
        'Homemade Apple' => 'Homemade Apple',
        'Homenaje' => 'Homenaje',
        'IM Fell DW Pica' => 'IM Fell DW Pica',
        'IM Fell DW Pica SC' => 'IM Fell DW Pica SC',
        'IM Fell Double Pica' => 'IM Fell Double Pica',
        'IM Fell Double Pica SC' => 'IM Fell Double Pica SC',
        'IM Fell English' => 'IM Fell English',
        'IM Fell English SC' => 'IM Fell English SC',
        'IM Fell French Canon' => 'IM Fell French Canon',
        'IM Fell French Canon SC' => 'IM Fell French Canon SC',
        'IM Fell Great Primer' => 'IM Fell Great Primer',
        'IM Fell Great Primer SC' => 'IM Fell Great Primer SC',
        'Iceberg' => 'Iceberg',
        'Iceland' => 'Iceland',
        'Imprima' => 'Imprima',
        'Inconsolata' => 'Inconsolata',
        'Inder' => 'Inder',
        'Indie Flower' => 'Indie Flower',
        'Inika' => 'Inika',
        'Irish Grover' => 'Irish Grover',
        'Istok Web' => 'Istok Web',
        'Italiana' => 'Italiana',
        'Italianno' => 'Italianno',
        'Jacques Francois' => 'Jacques Francois',
        'Jacques Francois Shadow' => 'Jacques Francois Shadow',
        'Jim Nightshade' => 'Jim Nightshade',
        'Jockey One' => 'Jockey One',
        'Jolly Lodger' => 'Jolly Lodger',
        'Josefin Sans' => 'Josefin Sans',
        'Josefin Slab' => 'Josefin Slab',
        'Joti One' => 'Joti One',
        'Judson' => 'Judson',
        'Julee' => 'Julee',
        'Julius Sans One' => 'Julius Sans One',
        'Junge' => 'Junge',
        'Jura' => 'Jura',
        'Just Another Hand' => 'Just Another Hand',
        'Just Me Again Down Here' => 'Just Me Again Down Here',
        'Kameron' => 'Kameron',
        'Karla' => 'Karla',
        'Kaushan Script' => 'Kaushan Script',
        'Kavoon' => 'Kavoon',
        'Keania One' => 'Keania One',
        'Kelly Slab' => 'Kelly Slab',
        'Kenia' => 'Kenia',
        'Khmer' => 'Khmer',
        'Kite One' => 'Kite One',
        'Knewave' => 'Knewave',
        'Kotta One' => 'Kotta One',
        'Koulen' => 'Koulen',
        'Kranky' => 'Kranky',
        'Kreon' => 'Kreon',
        'Kristi' => 'Kristi',
        'Krona One' => 'Krona One',
        'La Belle Aurore' => 'La Belle Aurore',
        'Lancelot' => 'Lancelot',
        'Lato' => 'Lato',
        'League Script' => 'League Script',
        'Leckerli One' => 'Leckerli One',
        'Ledger' => 'Ledger',
        'Lekton' => 'Lekton',
        'Lemon' => 'Lemon',
        'Libre Baskerville' => 'Libre Baskerville',
        'Life Savers' => 'Life Savers',
        'Lilita One' => 'Lilita One',
        'Limelight' => 'Limelight',
        'Linden Hill' => 'Linden Hill',
        'Lobster' => 'Lobster',
        'Lobster Two' => 'Lobster Two',
        'Londrina Outline' => 'Londrina Outline',
        'Londrina Shadow' => 'Londrina Shadow',
        'Londrina Sketch' => 'Londrina Sketch',
        'Londrina Solid' => 'Londrina Solid',
        'Lora' => 'Lora',
        'Love Ya Like A Sister' => 'Love Ya Like A Sister',
        'Loved by the King' => 'Loved by the King',
        'Lovers Quarrel' => 'Lovers Quarrel',
        'Luckiest Guy' => 'Luckiest Guy',
        'Lusitana' => 'Lusitana',
        'Lustria' => 'Lustria',
        'Macondo' => 'Macondo',
        'Macondo Swash Caps' => 'Macondo Swash Caps',
        'Magra' => 'Magra',
        'Maiden Orange' => 'Maiden Orange',
        'Mako' => 'Mako',
        'Marcellus' => 'Marcellus',
        'Marcellus SC' => 'Marcellus SC',
        'Marck Script' => 'Marck Script',
        'Margarine' => 'Margarine',
        'Marko One' => 'Marko One',
        'Marmelad' => 'Marmelad',
        'Marvel' => 'Marvel',
        'Mate' => 'Mate',
        'Mate SC' => 'Mate SC',
        'Maven Pro' => 'Maven Pro',
        'McLaren' => 'McLaren',
        'Meddon' => 'Meddon',
        'MedievalSharp' => 'MedievalSharp',
        'Medula One' => 'Medula One',
        'Megrim' => 'Megrim',
        'Meie Script' => 'Meie Script',
        'Merienda' => 'Merienda',
        'Merienda One' => 'Merienda One',
        'Merriweather' => 'Merriweather',
        'Merriweather Sans' => 'Merriweather Sans',
        'Metal' => 'Metal',
        'Metal Mania' => 'Metal Mania',
        'Metamorphous' => 'Metamorphous',
        'Metrophobic' => 'Metrophobic',
        'Michroma' => 'Michroma',
        'Milonga' => 'Milonga',
        'Miltonian' => 'Miltonian',
        'Miltonian Tattoo' => 'Miltonian Tattoo',
        'Miniver' => 'Miniver',
        'Miss Fajardose' => 'Miss Fajardose',
        'Modern Antiqua' => 'Modern Antiqua',
        'Molengo' => 'Molengo',
        'Molle' => 'Molle',
        'Monda' => 'Monda',
        'Monofett' => 'Monofett',
        'Monoton' => 'Monoton',
        'Monsieur La Doulaise' => 'Monsieur La Doulaise',
        'Montaga' => 'Montaga',
        'Montez' => 'Montez',
        'Montserrat' => 'Montserrat',
        'Montserrat Alternates' => 'Montserrat Alternates',
        'Montserrat Subrayada' => 'Montserrat Subrayada',
        'Moul' => 'Moul',
        'Moulpali' => 'Moulpali',
        'Mountains of Christmas' => 'Mountains of Christmas',
        'Mouse Memoirs' => 'Mouse Memoirs',
        'Mr Bedfort' => 'Mr Bedfort',
        'Mr Dafoe' => 'Mr Dafoe',
        'Mr De Haviland' => 'Mr De Haviland',
        'Mrs Saint Delafield' => 'Mrs Saint Delafield',
        'Mrs Sheppards' => 'Mrs Sheppards',
        'Muli' => 'Muli',
        'Mystery Quest' => 'Mystery Quest',
        'Neucha' => 'Neucha',
        'Neuton' => 'Neuton',
        'New Rocker' => 'New Rocker',
        'News Cycle' => 'News Cycle',
        'Niconne' => 'Niconne',
        'Nixie One' => 'Nixie One',
        'Nobile' => 'Nobile',
        'Nokora' => 'Nokora',
        'Norican' => 'Norican',
        'Nosifer' => 'Nosifer',
        'Nothing You Could Do' => 'Nothing You Could Do',
        'Noticia Text' => 'Noticia Text',
        'Nova Cut' => 'Nova Cut',
        'Nova Flat' => 'Nova Flat',
        'Nova Mono' => 'Nova Mono',
        'Nova Oval' => 'Nova Oval',
        'Nova Round' => 'Nova Round',
        'Nova Script' => 'Nova Script',
        'Nova Slim' => 'Nova Slim',
        'Nova Square' => 'Nova Square',
        'Numans' => 'Numans',
        'Nunito' => 'Nunito',
        'Odor Mean Chey' => 'Odor Mean Chey',
        'Offside' => 'Offside',
        'Old Standard TT' => 'Old Standard TT',
        'Oldenburg' => 'Oldenburg',
        'Oleo Script' => 'Oleo Script',
        'Oleo Script Swash Caps' => 'Oleo Script Swash Caps',
        'Open Sans' => 'Open Sans',
        'Open Sans Condensed' => 'Open Sans Condensed',
        'Oranienbaum' => 'Oranienbaum',
        'Orbitron' => 'Orbitron',
        'Oregano' => 'Oregano',
        'Orienta' => 'Orienta',
        'Original Surfer' => 'Original Surfer',
        'Oswald' => 'Oswald',
        'Over the Rainbow' => 'Over the Rainbow',
        'Overlock' => 'Overlock',
        'Overlock SC' => 'Overlock SC',
        'Ovo' => 'Ovo',
        'Oxygen' => 'Oxygen',
        'Oxygen Mono' => 'Oxygen Mono',
        'PT Mono' => 'PT Mono',
        'PT Sans' => 'PT Sans',
        'PT Sans Caption' => 'PT Sans Caption',
        'PT Sans Narrow' => 'PT Sans Narrow',
        'PT Serif' => 'PT Serif',
        'PT Serif Caption' => 'PT Serif Caption',
        'Pacifico' => 'Pacifico',
        'Paprika' => 'Paprika',
        'Parisienne' => 'Parisienne',
        'Passero One' => 'Passero One',
        'Passion One' => 'Passion One',
        'Patrick Hand' => 'Patrick Hand',
        'Patrick Hand SC' => 'Patrick Hand SC',
        'Patua One' => 'Patua One',
        'Paytone One' => 'Paytone One',
        'Peralta' => 'Peralta',
        'Permanent Marker' => 'Permanent Marker',
        'Petit Formal Script' => 'Petit Formal Script',
        'Petrona' => 'Petrona',
        'Philosopher' => 'Philosopher',
        'Piedra' => 'Piedra',
        'Pinyon Script' => 'Pinyon Script',
        'Pirata One' => 'Pirata One',
        'Plaster' => 'Plaster',
        'Play' => 'Play',
        'Playball' => 'Playball',
        'Playfair Display' => 'Playfair Display',
        'Playfair Display SC' => 'Playfair Display SC',
        'Podkova' => 'Podkova',
        'Poiret One' => 'Poiret One',
        'Poller One' => 'Poller One',
        'Poly' => 'Poly',
        'Pompiere' => 'Pompiere',
        'Pontano Sans' => 'Pontano Sans',
        'Port Lligat Sans' => 'Port Lligat Sans',
        'Port Lligat Slab' => 'Port Lligat Slab',
        'Prata' => 'Prata',
        'Preahvihear' => 'Preahvihear',
        'Press Start 2P' => 'Press Start 2P',
        'Princess Sofia' => 'Princess Sofia',
        'Prociono' => 'Prociono',
        'Prosto One' => 'Prosto One',
        'Puritan' => 'Puritan',
        'Purple Purse' => 'Purple Purse',
        'Quando' => 'Quando',
        'Quantico' => 'Quantico',
        'Quattrocento' => 'Quattrocento',
        'Quattrocento Sans' => 'Quattrocento Sans',
        'Questrial' => 'Questrial',
        'Quicksand' => 'Quicksand',
        'Quintessential' => 'Quintessential',
        'Qwigley' => 'Qwigley',
        'Racing Sans One' => 'Racing Sans One',
        'Radley' => 'Radley',
        'Raleway' => 'Raleway',
        'Raleway Dots' => 'Raleway Dots',
        'Rambla' => 'Rambla',
        'Rammetto One' => 'Rammetto One',
        'Ranchers' => 'Ranchers',
        'Rancho' => 'Rancho',
        'Rationale' => 'Rationale',
        'Redressed' => 'Redressed',
        'Reenie Beanie' => 'Reenie Beanie',
        'Revalia' => 'Revalia',
        'Ribeye' => 'Ribeye',
        'Ribeye Marrow' => 'Ribeye Marrow',
        'Righteous' => 'Righteous',
        'Risque' => 'Risque',
        'Roboto' => 'Roboto',
        'Roboto Condensed' => 'Roboto Condensed',
        'Rochester' => 'Rochester',
        'Rock Salt' => 'Rock Salt',
        'Rokkitt' => 'Rokkitt',
        'Romanesco' => 'Romanesco',
        'Ropa Sans' => 'Ropa Sans',
        'Rosario' => 'Rosario',
        'Rosarivo' => 'Rosarivo',
        'Rouge Script' => 'Rouge Script',
        'Ruda' => 'Ruda',
        'Rufina' => 'Rufina',
        'Ruge Boogie' => 'Ruge Boogie',
        'Ruluko' => 'Ruluko',
        'Rum Raisin' => 'Rum Raisin',
        'Ruslan Display' => 'Ruslan Display',
        'Russo One' => 'Russo One',
        'Ruthie' => 'Ruthie',
        'Rye' => 'Rye',
        'Sacramento' => 'Sacramento',
        'Sail' => 'Sail',
        'Salsa' => 'Salsa',
        'Sanchez' => 'Sanchez',
        'Sancreek' => 'Sancreek',
        'Sansita One' => 'Sansita One',
        'Sarina' => 'Sarina',
        'Satisfy' => 'Satisfy',
        'Scada' => 'Scada',
        'Schoolbell' => 'Schoolbell',
        'Seaweed Script' => 'Seaweed Script',
        'Sevillana' => 'Sevillana',
        'Seymour One' => 'Seymour One',
        'Shadows Into Light' => 'Shadows Into Light',
        'Shadows Into Light Two' => 'Shadows Into Light Two',
        'Shanti' => 'Shanti',
        'Share' => 'Share',
        'Share Tech' => 'Share Tech',
        'Share Tech Mono' => 'Share Tech Mono',
        'Shojumaru' => 'Shojumaru',
        'Short Stack' => 'Short Stack',
        'Siemreap' => 'Siemreap',
        'Sigmar One' => 'Sigmar One',
        'Signika' => 'Signika',
        'Signika Negative' => 'Signika Negative',
        'Simonetta' => 'Simonetta',
        'Sintony' => 'Sintony',
        'Sirin Stencil' => 'Sirin Stencil',
        'Six Caps' => 'Six Caps',
        'Skranji' => 'Skranji',
        'Slackey' => 'Slackey',
        'Smokum' => 'Smokum',
        'Smythe' => 'Smythe',
        'Sniglet' => 'Sniglet',
        'Snippet' => 'Snippet',
        'Snowburst One' => 'Snowburst One',
        'Sofadi One' => 'Sofadi One',
        'Sofia' => 'Sofia',
        'Sonsie One' => 'Sonsie One',
        'Sorts Mill Goudy' => 'Sorts Mill Goudy',
        'Source Code Pro' => 'Source Code Pro',
        'Source Sans Pro' => 'Source Sans Pro',
        'Special Elite' => 'Special Elite',
        'Spicy Rice' => 'Spicy Rice',
        'Spinnaker' => 'Spinnaker',
        'Spirax' => 'Spirax',
        'Squada One' => 'Squada One',
        'Stalemate' => 'Stalemate',
        'Stalinist One' => 'Stalinist One',
        'Stardos Stencil' => 'Stardos Stencil',
        'Stint Ultra Condensed' => 'Stint Ultra Condensed',
        'Stint Ultra Expanded' => 'Stint Ultra Expanded',
        'Stoke' => 'Stoke',
        'Strait' => 'Strait',
        'Sue Ellen Francisco' => 'Sue Ellen Francisco',
        'Sunshiney' => 'Sunshiney',
        'Supermercado One' => 'Supermercado One',
        'Suwannaphum' => 'Suwannaphum',
        'Swanky and Moo Moo' => 'Swanky and Moo Moo',
        'Syncopate' => 'Syncopate',
        'Tangerine' => 'Tangerine',
        'Taprom' => 'Taprom',
        'Tauri' => 'Tauri',
        'Telex' => 'Telex',
        'Tenor Sans' => 'Tenor Sans',
        'Text Me One' => 'Text Me One',
        'The Girl Next Door' => 'The Girl Next Door',
        'Tienne' => 'Tienne',
        'Tinos' => 'Tinos',
        'Titan One' => 'Titan One',
        'Titillium Web' => 'Titillium Web',
        'Trade Winds' => 'Trade Winds',
        'Trocchi' => 'Trocchi',
        'Trochut' => 'Trochut',
        'Trykker' => 'Trykker',
        'Tulpen One' => 'Tulpen One',
        'Ubuntu' => 'Ubuntu',
        'Ubuntu Condensed' => 'Ubuntu Condensed',
        'Ubuntu Mono' => 'Ubuntu Mono',
        'Ultra' => 'Ultra',
        'Uncial Antiqua' => 'Uncial Antiqua',
        'Underdog' => 'Underdog',
        'Unica One' => 'Unica One',
        'UnifrakturCook' => 'UnifrakturCook',
        'UnifrakturMaguntia' => 'UnifrakturMaguntia',
        'Unkempt' => 'Unkempt',
        'Unlock' => 'Unlock',
        'Unna' => 'Unna',
        'VT323' => 'VT323',
        'Vampiro One' => 'Vampiro One',
        'Varela' => 'Varela',
        'Varela Round' => 'Varela Round',
        'Vast Shadow' => 'Vast Shadow',
        'Vibur' => 'Vibur',
        'Vidaloka' => 'Vidaloka',
        'Viga' => 'Viga',
        'Voces' => 'Voces',
        'Volkhov' => 'Volkhov',
        'Vollkorn' => 'Vollkorn',
        'Voltaire' => 'Voltaire',
        'Waiting for the Sunrise' => 'Waiting for the Sunrise',
        'Wallpoet' => 'Wallpoet',
        'Walter Turncoat' => 'Walter Turncoat',
        'Warnes' => 'Warnes',
        'Wellfleet' => 'Wellfleet',
        'Wendy One' => 'Wendy One',
        'Wire One' => 'Wire One',
        'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
        'Yellowtail' => 'Yellowtail',
        'Yeseva One' => 'Yeseva One',
        'Yesteryear' => 'Yesteryear',
        'Zeyada' => 'Zeyada'
    );

    $font_atts_int = array
        (
        'ABeeZee' => array
            ('0' => 'regular', '1' => 'italic'),
        'Abel' => array
            ('0' => 'regular'),
        'Abril Fatface' => array
            ('0' => 'regular'),
        'Aclonica' => array
            ('0' => 'regular'),
        'Acme' => array
            ('0' => 'regular'),
        'Actor' => array
            ('0' => 'regular'),
        'Adamina' => array
            ('0' => 'regular'),
        'Advent Pro' => array
            ('0' => '100', '1' => '200', '2' => '300', '3' => 'regular', '4' => '500', '5' => '600', '6' => '700'),
        'Aguafina Script' => array
            ('0' => 'regular'),
        'Akronim' => array
            ('0' => 'regular'),
        'Aladin' => array
            ('0' => 'regular'),
        'Aldrich' => array
            ('0' => 'regular'),
        'Alegreya' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic', '4' => '900', '5' => '900italic'),
        'Alegreya SC' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic', '4' => '900', '5' => '900italic'),
        'Alex Brush' => array
            ('0' => 'regular'),
        'Alfa Slab One' => array
            ('0' => 'regular'),
        'Alice' => array
            ('0' => 'regular'),
        'Alike' => array
            ('0' => 'regular'),
        'Alike Angular' => array
            ('0' => 'regular'),
        'Allan' => array
            ('0' => 'regular', '1' => '700'),
        'Allerta' => array
            ('0' => 'regular'),
        'Allerta Stencil' => array
            ('0' => 'regular'),
        'Allura' => array
            ('0' => 'regular'),
        'Almendra' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Almendra Display' => array
            ('0' => 'regular'),
        'Almendra SC' => array
            ('0' => 'regular'),
        'Amarante' => array
            ('0' => 'regular'),
        'Amaranth' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Amatic SC' => array
            ('0' => 'regular', '1' => '700'),
        'Amethysta' => array
            ('0' => 'regular'),
        'Anaheim' => array
            ('0' => 'regular'),
        'Andada' => array
            ('0' => 'regular'),
        'Andika' => array
            ('0' => 'regular'),
        'Angkor' => array
            ('0' => 'regular'),
        'Annie Use Your Telescope' => array
            ('0' => 'regular'),
        'Anonymous Pro' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Antic' => array
            ('0' => 'regular'),
        'Antic Didone' => array
            ('0' => 'regular'),
        'Antic Slab' => array
            ('0' => 'regular'),
        'Anton' => array
            ('0' => 'regular'),
        'Arapey' => array
            ('0' => 'regular', '1' => 'italic'),
        'Arbutus' => array
            ('0' => 'regular'),
        'Arbutus Slab' => array
            ('0' => 'regular'),
        'Architects Daughter' => array
            ('0' => 'regular'),
        'Archivo Black' => array
            ('0' => 'regular'),
        'Archivo Narrow' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Arimo' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Arizonia' => array
            ('0' => 'regular'),
        'Armata' => array
            ('0' => 'regular'),
        'Artifika' => array
            ('0' => 'regular'),
        'Arvo' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Asap' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Asset' => array
            ('0' => 'regular'),
        'Astloch' => array
            ('0' => 'regular', '1' => '700'),
        'Asul' => array
            ('0' => 'regular', '1' => '700'),
        'Atomic Age' => array
            ('0' => 'regular'),
        'Aubrey' => array
            ('0' => 'regular'),
        'Audiowide' => array
            ('0' => 'regular'),
        'Autour One' => array
            ('0' => 'regular'),
        'Average' => array
            ('0' => 'regular'),
        'Average Sans' => array
            ('0' => 'regular'),
        'Averia Gruesa Libre' => array
            ('0' => 'regular'),
        'Averia Libre' => array
            ('0' => '300', '1' => '300italic', '2' => 'regular', '3' => 'italic', '4' => '700', '5' => '700italic'),
        'Averia Sans Libre' => array
            ('0' => '300', '1' => '300italic', '2' => 'regular', '3' => 'italic', '4' => '700', '5' => '700italic'),
        'Averia Serif Libre' => array
            ('0' => '300', '1' => '300italic', '2' => 'regular', '3' => 'italic', '4' => '700', '5' => '700italic'),
        'Bad Script' => array
            ('0' => 'regular'),
        'Balthazar' => array
            ('0' => 'regular'),
        'Bangers' => array
            ('0' => 'regular'),
        'Basic' => array
            ('0' => 'regular'),
        'Battambang' => array
            ('0' => 'regular', '1' => '700'),
        'Baumans' => array
            ('0' => 'regular'),
        'Bayon' => array
            ('0' => 'regular'),
        'Belgrano' => array
            ('0' => 'regular'),
        'Belleza' => array
            ('0' => 'regular'),
        'BenchNine' => array
            ('0' => '300', '1' => 'regular', '2' => '700'),
        'Bentham' => array
            ('0' => 'regular'),
        'Berkshire Swash' => array
            ('0' => 'regular'),
        'Bevan' => array
            ('0' => 'regular'),
        'Bigelow Rules' => array
            ('0' => 'regular'),
        'Bigshot One' => array
            ('0' => 'regular'),
        'Bilbo' => array
            ('0' => 'regular'),
        'Bilbo Swash Caps' => array
            ('0' => 'regular'),
        'Bitter' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700'),
        'Black Ops One' => array
            ('0' => 'regular'),
        'Bokor' => array
            ('0' => 'regular'),
        'Bonbon' => array
            ('0' => 'regular'),
        'Boogaloo' => array
            ('0' => 'regular'),
        'Bowlby One' => array
            ('0' => 'regular'),
        'Bowlby One SC' => array
            ('0' => 'regular'),
        'Brawler' => array
            ('0' => 'regular'),
        'Bree Serif' => array
            ('0' => 'regular'),
        'Bubblegum Sans' => array
            ('0' => 'regular'),
        'Bubbler One' => array
            ('0' => 'regular'),
        'Buda' => array
            ('0' => '300'),
        'Buenard' => array
            ('0' => 'regular', '1' => '700'),
        'Butcherman' => array
            ('0' => 'regular'),
        'Butterfly Kids' => array
            ('0' => 'regular'),
        'Cabin' => array
            ('0' => 'regular', '1' => 'italic', '2' => '500', '3' => '500italic', '4' => '600', '5' => '600italic', '6' => '700', '7' => '700italic'),
        'Cabin Condensed' => array
            ('0' => 'regular', '1' => '500', '2' => '600', '3' => '700'),
        'Cabin Sketch' => array
            ('0' => 'regular', '1' => '700'),
        'Caesar Dressing' => array
            ('0' => 'regular'),
        'Cagliostro' => array
            ('0' => 'regular'),
        'Calligraffitti' => array
            ('0' => 'regular'),
        'Cambo' => array
            ('0' => 'regular'),
        'Candal' => array
            ('0' => 'regular'),
        'Cantarell' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Cantata One' => array
            ('0' => 'regular'),
        'Cantora One' => array
            ('0' => 'regular'),
        'Capriola' => array
            ('0' => 'regular'),
        'Cardo' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700'),
        'Carme' => array
            ('0' => 'regular'),
        'Carrois Gothic' => array
            ('0' => 'regular'),
        'Carrois Gothic SC' => array
            ('0' => 'regular'),
        'Carter One' => array
            ('0' => 'regular'),
        'Caudex' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Cedarville Cursive' => array
            ('0' => 'regular'),
        'Ceviche One' => array
            ('0' => 'regular'),
        'Changa One' => array
            ('0' => 'regular', '1' => 'italic'),
        'Chango' => array
            ('0' => 'regular'),
        'Chau Philomene One' => array
            ('0' => 'regular', '1' => 'italic'),
        'Chela One' => array
            ('0' => 'regular'),
        'Chelsea Market' => array
            ('0' => 'regular'),
        'Chenla' => array
            ('0' => 'regular'),
        'Cherry Cream Soda' => array
            ('0' => 'regular'),
        'Cherry Swash' => array
            ('0' => 'regular', '1' => '700'),
        'Chewy' => array
            ('0' => 'regular'),
        'Chicle' => array
            ('0' => 'regular'),
        'Chivo' => array
            ('0' => 'regular', '1' => 'italic', '2' => '900', '3' => '900italic'),
        'Cinzel' => array
            ('0' => 'regular', '1' => '700', '2' => '900'),
        'Cinzel Decorative' => array
            ('0' => 'regular', '1' => '700', '2' => '900'),
        'Clicker Script' => array
            ('0' => 'regular'),
        'Coda' => array
            ('0' => 'regular', '1' => '800'),
        'Coda Caption' => array
            ('0' => '800'),
        'Codystar' => array
            ('0' => '300', '1' => 'regular'),
        'Combo' => array
            ('0' => 'regular'),
        'Comfortaa' => array
            ('0' => '300', '1' => 'regular', '2' => '700'),
        'Coming Soon' => array
            ('0' => 'regular'),
        'Concert One' => array
            ('0' => 'regular'),
        'Condiment' => array
            ('0' => 'regular'),
        'Content' => array
            ('0' => 'regular', '1' => '700'),
        'Contrail One' => array
            ('0' => 'regular'),
        'Convergence' => array
            ('0' => 'regular'),
        'Cookie' => array
            ('0' => 'regular'),
        'Copse' => array
            ('0' => 'regular'),
        'Corben' => array
            ('0' => 'regular', '1' => '700'),
        'Courgette' => array
            ('0' => 'regular'),
        'Cousine' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Coustard' => array
            ('0' => 'regular', '1' => '900'),
        'Covered By Your Grace' => array
            ('0' => 'regular'),
        'Crafty Girls' => array
            ('0' => 'regular'),
        'Creepster' => array
            ('0' => 'regular'),
        'Crete Round' => array
            ('0' => 'regular', '1' => 'italic'),
        'Crimson Text' => array
            ('0' => 'regular', '1' => 'italic', '2' => '600', '3' => '600italic', '4' => '700', '5' => '700italic'),
        'Croissant One' => array
            ('0' => 'regular'),
        'Crushed' => array
            ('0' => 'regular'),
        'Cuprum' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Cutive' => array
            ('0' => 'regular'),
        'Cutive Mono' => array
            ('0' => 'regular'),
        'Damion' => array
            ('0' => 'regular'),
        'Dancing Script' => array
            ('0' => 'regular', '1' => '700'),
        'Dangrek' => array
            ('0' => 'regular'),
        'Dawning of a New Day' => array
            ('0' => 'regular'),
        'Days One' => array
            ('0' => 'regular'),
        'Delius' => array
            ('0' => 'regular'),
        'Delius Swash Caps' => array
            ('0' => 'regular'),
        'Delius Unicase' => array
            ('0' => 'regular', '1' => '700'),
        'Della Respira' => array
            ('0' => 'regular'),
        'Denk One' => array
            ('0' => 'regular'),
        'Devonshire' => array
            ('0' => 'regular'),
        'Didact Gothic' => array
            ('0' => 'regular'),
        'Diplomata' => array
            ('0' => 'regular'),
        'Diplomata SC' => array
            ('0' => 'regular'),
        'Domine' => array
            ('0' => 'regular', '1' => '700'),
        'Donegal One' => array
            ('0' => 'regular'),
        'Doppio One' => array
            ('0' => 'regular'),
        'Dorsa' => array
            ('0' => 'regular'),
        'Dosis' => array
            ('0' => '200', '1' => '300', '2' => 'regular', '3' => '500', '4' => '600', '5' => '700', '6' => '800'),
        'Dr Sugiyama' => array
            ('0' => 'regular'),
        'Droid Sans' => array
            ('0' => 'regular', '1' => '700'),
        'Droid Sans Mono' => array
            ('0' => 'regular'),
        'Droid Serif' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Duru Sans' => array
            ('0' => 'regular'),
        'Dynalight' => array
            ('0' => 'regular'),
        'EB Garamond' => array
            ('0' => 'regular'),
        'Eagle Lake' => array
            ('0' => 'regular'),
        'Eater' => array
            ('0' => 'regular'),
        'Economica' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Electrolize' => array
            ('0' => 'regular'),
        'Elsie' => array
            ('0' => 'regular', '1' => '900'),
        'Elsie Swash Caps' => array
            ('0' => 'regular', '1' => '900'),
        'Emblema One' => array
            ('0' => 'regular'),
        'Emilys Candy' => array
            ('0' => 'regular'),
        'Engagement' => array
            ('0' => 'regular'),
        'Englebert' => array
            ('0' => 'regular'),
        'Enriqueta' => array
            ('0' => 'regular', '1' => '700'),
        'Erica One' => array
            ('0' => 'regular'),
        'Esteban' => array
            ('0' => 'regular'),
        'Euphoria Script' => array
            ('0' => 'regular'),
        'Ewert' => array
            ('0' => 'regular'),
        'Exo' => array
            ('0' => '100', '1' => '100italic', '2' => '200', '3' => '200italic', '4' => '300', '5' => '300italic', '6' => 'regular', '7' => 'italic', '8' => '500', '9' => '500italic', '10' => '600', '11' => '600italic', '12' => '700', '13' => '700italic', '14' => '800', '15' => '800italic', '16' => '900', '17' => '900italic'),
        'Expletus Sans' => array
            ('0' => 'regular', '1' => 'italic', '2' => '500', '3' => '500italic', '4' => '600', '5' => '600italic', '6' => '700', '7' => '700italic'),
        'Fanwood Text' => array
            ('0' => 'regular', '1' => 'italic'),
        'Fascinate' => array
            ('0' => 'regular'),
        'Fascinate Inline' => array
            ('0' => 'regular'),
        'Faster One' => array
            ('0' => 'regular'),
        'Fasthand' => array
            ('0' => 'regular'),
        'Federant' => array
            ('0' => 'regular'),
        'Federo' => array
            ('0' => 'regular'),
        'Felipa' => array
            ('0' => 'regular'),
        'Fenix' => array
            ('0' => 'regular'),
        'Finger Paint' => array
            ('0' => 'regular'),
        'Fjalla One' => array
            ('0' => 'regular'),
        'Fjord One' => array
            ('0' => 'regular'),
        'Flamenco' => array
            ('0' => '300', '1' => 'regular'),
        'Flavors' => array
            ('0' => 'regular'),
        'Fondamento' => array
            ('0' => 'regular', '1' => 'italic'),
        'Fontdiner Swanky' => array
            ('0' => 'regular'),
        'Forum' => array
            ('0' => 'regular'),
        'Francois One' => array
            ('0' => 'regular'),
        'Freckle Face' => array
            ('0' => 'regular'),
        'Fredericka the Great' => array
            ('0' => 'regular'),
        'Fredoka One' => array
            ('0' => 'regular'),
        'Freehand' => array
            ('0' => 'regular'),
        'Fresca' => array
            ('0' => 'regular'),
        'Frijole' => array
            ('0' => 'regular'),
        'Fruktur' => array
            ('0' => 'regular'),
        'Fugaz One' => array
            ('0' => 'regular'),
        'GFS Didot' => array
            ('0' => 'regular'),
        'GFS Neohellenic' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Gabriela' => array
            ('0' => 'regular'),
        'Gafata' => array
            ('0' => 'regular'),
        'Galdeano' => array
            ('0' => 'regular'),
        'Galindo' => array
            ('0' => 'regular'),
        'Gentium Basic' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Gentium Book Basic' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Geo' => array
            ('0' => 'regular', '1' => 'italic'),
        'Geostar' => array
            ('0' => 'regular'),
        'Geostar Fill' => array
            ('0' => 'regular'),
        'Germania One' => array
            ('0' => 'regular'),
        'Gilda Display' => array
            ('0' => 'regular'),
        'Give You Glory' => array
            ('0' => 'regular'),
        'Glass Antiqua' => array
            ('0' => 'regular'),
        'Glegoo' => array
            ('0' => 'regular'),
        'Gloria Hallelujah' => array
            ('0' => 'regular'),
        'Goblin One' => array
            ('0' => 'regular'),
        'Gochi Hand' => array
            ('0' => 'regular'),
        'Gorditas' => array
            ('0' => 'regular', '1' => '700'),
        'Goudy Bookletter 1911' => array
            ('0' => 'regular'),
        'Graduate' => array
            ('0' => 'regular'),
        'Grand Hotel' => array
            ('0' => 'regular'),
        'Gravitas One' => array
            ('0' => 'regular'),
        'Great Vibes' => array
            ('0' => 'regular'),
        'Griffy' => array
            ('0' => 'regular'),
        'Gruppo' => array
            ('0' => 'regular'),
        'Gudea' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700'),
        'Habibi' => array
            ('0' => 'regular'),
        'Hammersmith One' => array
            ('0' => 'regular'),
        'Hanalei' => array
            ('0' => 'regular'),
        'Hanalei Fill' => array
            ('0' => 'regular'),
        'Handlee' => array
            ('0' => 'regular'),
        'Hanuman' => array
            ('0' => 'regular', '1' => '700'),
        'Happy Monkey' => array
            ('0' => 'regular'),
        'Headland One' => array
            ('0' => 'regular'),
        'Henny Penny' => array
            ('0' => 'regular'),
        'Herr Von Muellerhoff' => array
            ('0' => 'regular'),
        'Holtwood One SC' => array
            ('0' => 'regular'),
        'Homemade Apple' => array
            ('0' => 'regular'),
        'Homenaje' => array
            ('0' => 'regular'),
        'IM Fell DW Pica' => array
            ('0' => 'regular', '1' => 'italic'),
        'IM Fell DW Pica SC' => array
            ('0' => 'regular'),
        'IM Fell Double Pica' => array
            ('0' => 'regular', '1' => 'italic'),
        'IM Fell Double Pica SC' => array
            ('0' => 'regular'),
        'IM Fell English' => array
            ('0' => 'regular', '1' => 'italic'),
        'IM Fell English SC' => array
            ('0' => 'regular'),
        'IM Fell French Canon' => array
            ('0' => 'regular', '1' => 'italic'),
        'IM Fell French Canon SC' => array
            ('0' => 'regular'),
        'IM Fell Great Primer' => array
            ('0' => 'regular', '1' => 'italic'),
        'IM Fell Great Primer SC' => array
            ('0' => 'regular'),
        'Iceberg' => array
            ('0' => 'regular'),
        'Iceland' => array
            ('0' => 'regular'),
        'Imprima' => array
            ('0' => 'regular'),
        'Inconsolata' => array
            ('0' => 'regular', '1' => '700'),
        'Inder' => array
            ('0' => 'regular'),
        'Indie Flower' => array
            ('0' => 'regular'),
        'Inika' => array
            ('0' => 'regular', '1' => '700'),
        'Irish Grover' => array
            ('0' => 'regular'),
        'Istok Web' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Italiana' => array
            ('0' => 'regular'),
        'Italianno' => array
            ('0' => 'regular'),
        'Jacques Francois' => array
            ('0' => 'regular'),
        'Jacques Francois Shadow' => array
            ('0' => 'regular'),
        'Jim Nightshade' => array
            ('0' => 'regular'),
        'Jockey One' => array
            ('0' => 'regular'),
        'Jolly Lodger' => array
            ('0' => 'regular'),
        'Josefin Sans' => array
            ('0' => '100', '1' => '100italic', '2' => '300', '3' => '300italic', '4' => 'regular', '5' => 'italic', '6' => '600', '7' => '600italic', '8' => '700', '9' => '700italic'),
        'Josefin Slab' => array
            ('0' => '100', '1' => '100italic', '2' => '300', '3' => '300italic', '4' => 'regular', '5' => 'italic', '6' => '600', '7' => '600italic', '8' => '700', '9' => '700italic'),
        'Joti One' => array
            ('0' => 'regular'),
        'Judson' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700'),
        'Julee' => array
            ('0' => 'regular'),
        'Julius Sans One' => array
            ('0' => 'regular'),
        'Junge' => array
            ('0' => 'regular'),
        'Jura' => array
            ('0' => '300', '1' => 'regular', '2' => '500', '3' => '600'),
        'Just Another Hand' => array
            ('0' => 'regular'),
        'Just Me Again Down Here' => array
            ('0' => 'regular'),
        'Kameron' => array
            ('0' => 'regular', '1' => '700'),
        'Karla' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Kaushan Script' => array
            ('0' => 'regular'),
        'Kavoon' => array
            ('0' => 'regular'),
        'Keania One' => array
            ('0' => 'regular'),
        'Kelly Slab' => array
            ('0' => 'regular'),
        'Kenia' => array
            ('0' => 'regular'),
        'Khmer' => array
            ('0' => 'regular'),
        'Kite One' => array
            ('0' => 'regular'),
        'Knewave' => array
            ('0' => 'regular'),
        'Kotta One' => array
            ('0' => 'regular'),
        'Koulen' => array
            ('0' => 'regular'),
        'Kranky' => array
            ('0' => 'regular'),
        'Kreon' => array
            ('0' => '300', '1' => 'regular', '2' => '700'),
        'Kristi' => array
            ('0' => 'regular'),
        'Krona One' => array
            ('0' => 'regular'),
        'La Belle Aurore' => array
            ('0' => 'regular'),
        'Lancelot' => array
            ('0' => 'regular'),
        'Lato' => array
            ('0' => '100', '1' => '100italic', '2' => '300', '3' => '300italic', '4' => 'regular', '5' => 'italic', '6' => '700', '7' => '700italic', '8' => '900', '9' => '900italic'),
        'League Script' => array
            ('0' => 'regular'),
        'Leckerli One' => array
            ('0' => 'regular'),
        'Ledger' => array
            ('0' => 'regular'),
        'Lekton' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700'),
        'Lemon' => array
            ('0' => 'regular'),
        'Libre Baskerville' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700'),
        'Life Savers' => array
            ('0' => 'regular', '1' => '700'),
        'Lilita One' => array
            ('0' => 'regular'),
        'Limelight' => array
            ('0' => 'regular'),
        'Linden Hill' => array
            ('0' => 'regular', '1' => 'italic'),
        'Lobster' => array
            ('0' => 'regular'),
        'Lobster Two' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Londrina Outline' => array
            ('0' => 'regular'),
        'Londrina Shadow' => array
            ('0' => 'regular'),
        'Londrina Sketch' => array
            ('0' => 'regular'),
        'Londrina Solid' => array
            ('0' => 'regular'),
        'Lora' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Love Ya Like A Sister' => array
            ('0' => 'regular'),
        'Loved by the King' => array
            ('0' => 'regular'),
        'Lovers Quarrel' => array
            ('0' => 'regular'),
        'Luckiest Guy' => array
            ('0' => 'regular'),
        'Lusitana' => array
            ('0' => 'regular', '1' => '700'),
        'Lustria' => array
            ('0' => 'regular'),
        'Macondo' => array
            ('0' => 'regular'),
        'Macondo Swash Caps' => array
            ('0' => 'regular'),
        'Magra' => array
            ('0' => 'regular', '1' => '700'),
        'Maiden Orange' => array
            ('0' => 'regular'),
        'Mako' => array
            ('0' => 'regular'),
        'Marcellus' => array
            ('0' => 'regular'),
        'Marcellus SC' => array
            ('0' => 'regular'),
        'Marck Script' => array
            ('0' => 'regular'),
        'Margarine' => array
            ('0' => 'regular'),
        'Marko One' => array
            ('0' => 'regular'),
        'Marmelad' => array
            ('0' => 'regular'),
        'Marvel' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Mate' => array
            ('0' => 'regular', '1' => 'italic'),
        'Mate SC' => array
            ('0' => 'regular'),
        'Maven Pro' => array
            ('0' => 'regular', '1' => '500', '2' => '700', '3' => '900'),
        'McLaren' => array
            ('0' => 'regular'),
        'Meddon' => array
            ('0' => 'regular'),
        'MedievalSharp' => array
            ('0' => 'regular'),
        'Medula One' => array
            ('0' => 'regular'),
        'Megrim' => array
            ('0' => 'regular'),
        'Meie Script' => array
            ('0' => 'regular'),
        'Merienda' => array
            ('0' => 'regular', '1' => '700'),
        'Merienda One' => array
            ('0' => 'regular'),
        'Merriweather' => array
            ('0' => '300', '1' => 'regular', '2' => '700', '3' => '900'),
        'Merriweather Sans' => array
            ('0' => '300', '1' => 'regular', '2' => '700', '3' => '800'),
        'Metal' => array
            ('0' => 'regular'),
        'Metal Mania' => array
            ('0' => 'regular'),
        'Metamorphous' => array
            ('0' => 'regular'),
        'Metrophobic' => array
            ('0' => 'regular'),
        'Michroma' => array
            ('0' => 'regular'),
        'Milonga' => array
            ('0' => 'regular'),
        'Miltonian' => array
            ('0' => 'regular'),
        'Miltonian Tattoo' => array
            ('0' => 'regular'),
        'Miniver' => array
            ('0' => 'regular'),
        'Miss Fajardose' => array
            ('0' => 'regular'),
        'Modern Antiqua' => array
            ('0' => 'regular'),
        'Molengo' => array
            ('0' => 'regular'),
        'Molle' => array
            ('0' => 'italic'),
        'Monda' => array
            ('0' => 'regular', '1' => '700'),
        'Monofett' => array
            ('0' => 'regular'),
        'Monoton' => array
            ('0' => 'regular'),
        'Monsieur La Doulaise' => array
            ('0' => 'regular'),
        'Montaga' => array
            ('0' => 'regular'),
        'Montez' => array
            ('0' => 'regular'),
        'Montserrat' => array
            ('0' => 'regular', '1' => '700'),
        'Montserrat Alternates' => array
            ('0' => 'regular', '1' => '700'),
        'Montserrat Subrayada' => array
            ('0' => 'regular', '1' => '700'),
        'Moul' => array
            ('0' => 'regular'),
        'Moulpali' => array
            ('0' => 'regular'),
        'Mountains of Christmas' => array
            ('0' => 'regular', '1' => '700'),
        'Mouse Memoirs' => array
            ('0' => 'regular'),
        'Mr Bedfort' => array
            ('0' => 'regular'),
        'Mr Dafoe' => array
            ('0' => 'regular'),
        'Mr De Haviland' => array
            ('0' => 'regular'),
        'Mrs Saint Delafield' => array
            ('0' => 'regular'),
        'Mrs Sheppards' => array
            ('0' => 'regular'),
        'Muli' => array
            ('0' => '300', '1' => '300italic', '2' => 'regular', '3' => 'italic'),
        'Mystery Quest' => array
            ('0' => 'regular'),
        'Neucha' => array
            ('0' => 'regular'),
        'Neuton' => array
            ('0' => '200', '1' => '300', '2' => 'regular', '3' => 'italic', '4' => '700', '5' => '800'),
        'New Rocker' => array
            ('0' => 'regular'),
        'News Cycle' => array
            ('0' => 'regular', '1' => '700'),
        'Niconne' => array
            ('0' => 'regular'),
        'Nixie One' => array
            ('0' => 'regular'),
        'Nobile' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Nokora' => array
            ('0' => 'regular', '1' => '700'),
        'Norican' => array
            ('0' => 'regular'),
        'Nosifer' => array
            ('0' => 'regular'),
        'Nothing You Could Do' => array
            ('0' => 'regular'),
        'Noticia Text' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Nova Cut' => array
            ('0' => 'regular'),
        'Nova Flat' => array
            ('0' => 'regular'),
        'Nova Mono' => array
            ('0' => 'regular'),
        'Nova Oval' => array
            ('0' => 'regular'),
        'Nova Round' => array
            ('0' => 'regular'),
        'Nova Script' => array
            ('0' => 'regular'),
        'Nova Slim' => array
            ('0' => 'regular'),
        'Nova Square' => array
            ('0' => 'regular'),
        'Numans' => array
            ('0' => 'regular'),
        'Nunito' => array
            ('0' => '300', '1' => 'regular', '2' => '700'),
        'Odor Mean Chey' => array
            ('0' => 'regular'),
        'Offside' => array
            ('0' => 'regular'),
        'Old Standard TT' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700'),
        'Oldenburg' => array
            ('0' => 'regular'),
        'Oleo Script' => array
            ('0' => 'regular', '1' => '700'),
        'Oleo Script Swash Caps' => array
            ('0' => 'regular', '1' => '700'),
        'Open Sans' => array
            ('0' => '300', '1' => '300italic', '2' => 'regular', '3' => 'italic', '4' => '600', '5' => '600italic', '6' => '700', '7' => '700italic', '8' => '800', '9' => '800italic'),
        'Open Sans Condensed' => array
            ('0' => '300', '1' => '300italic', '2' => '700'),
        'Oranienbaum' => array
            ('0' => 'regular'),
        'Orbitron' => array
            ('0' => 'regular', '1' => '500', '2' => '700', '3' => '900'),
        'Oregano' => array
            ('0' => 'regular', '1' => 'italic'),
        'Orienta' => array
            ('0' => 'regular'),
        'Original Surfer' => array
            ('0' => 'regular'),
        'Oswald' => array
            ('0' => '300', '1' => 'regular', '2' => '700'),
        'Over the Rainbow' => array
            ('0' => 'regular'),
        'Overlock' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic', '4' => '900', '5' => '900italic'),
        'Overlock SC' => array
            ('0' => 'regular'),
        'Ovo' => array
            ('0' => 'regular'),
        'Oxygen' => array
            ('0' => '300', '1' => 'regular', '2' => '700'),
        'Oxygen Mono' => array
            ('0' => 'regular'),
        'PT Mono' => array
            ('0' => 'regular'),
        'PT Sans' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'PT Sans Caption' => array
            ('0' => 'regular', '1' => '700'),
        'PT Sans Narrow' => array
            ('0' => 'regular', '1' => '700'),
        'PT Serif' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'PT Serif Caption' => array
            ('0' => 'regular', '1' => 'italic'),
        'Pacifico' => array
            ('0' => 'regular'),
        'Paprika' => array
            ('0' => 'regular'),
        'Parisienne' => array
            ('0' => 'regular'),
        'Passero One' => array
            ('0' => 'regular'),
        'Passion One' => array
            ('0' => 'regular', '1' => '700', '2' => '900'),
        'Patrick Hand' => array
            ('0' => 'regular'),
        'Patrick Hand SC' => array
            ('0' => 'regular'),
        'Patua One' => array
            ('0' => 'regular'),
        'Paytone One' => array
            ('0' => 'regular'),
        'Peralta' => array
            ('0' => 'regular'),
        'Permanent Marker' => array
            ('0' => 'regular'),
        'Petit Formal Script' => array
            ('0' => 'regular'),
        'Petrona' => array
            ('0' => 'regular'),
        'Philosopher' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Piedra' => array
            ('0' => 'regular'),
        'Pinyon Script' => array
            ('0' => 'regular'),
        'Pirata One' => array
            ('0' => 'regular'),
        'Plaster' => array
            ('0' => 'regular'),
        'Play' => array
            ('0' => 'regular', '1' => '700'),
        'Playball' => array
            ('0' => 'regular'),
        'Playfair Display' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic', '4' => '900', '5' => '900italic'),
        'Playfair Display SC' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic', '4' => '900', '5' => '900italic'),
        'Podkova' => array
            ('0' => 'regular', '1' => '700'),
        'Poiret One' => array
            ('0' => 'regular'),
        'Poller One' => array
            ('0' => 'regular'),
        'Poly' => array
            ('0' => 'regular', '1' => 'italic'),
        'Pompiere' => array
            ('0' => 'regular'),
        'Pontano Sans' => array
            ('0' => 'regular'),
        'Port Lligat Sans' => array
            ('0' => 'regular'),
        'Port Lligat Slab' => array
            ('0' => 'regular'),
        'Prata' => array
            ('0' => 'regular'),
        'Preahvihear' => array
            ('0' => 'regular'),
        'Press Start 2P' => array
            ('0' => 'regular'),
        'Princess Sofia' => array
            ('0' => 'regular'),
        'Prociono' => array
            ('0' => 'regular'),
        'Prosto One' => array
            ('0' => 'regular'),
        'Puritan' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Purple Purse' => array
            ('0' => 'regular'),
        'Quando' => array
            ('0' => 'regular'),
        'Quantico' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Quattrocento' => array
            ('0' => 'regular', '1' => '700'),
        'Quattrocento Sans' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Questrial' => array
            ('0' => 'regular'),
        'Quicksand' => array
            ('0' => '300', '1' => 'regular', '2' => '700'),
        'Quintessential' => array
            ('0' => 'regular'),
        'Qwigley' => array
            ('0' => 'regular'),
        'Racing Sans One' => array
            ('0' => 'regular'),
        'Radley' => array
            ('0' => 'regular', '1' => 'italic'),
        'Raleway' => array
            ('0' => '100', '1' => '200', '2' => '300', '3' => 'regular', '4' => '500', '5' => '600', '6' => '700', '7' => '800', '8' => '900'),
        'Raleway Dots' => array
            ('0' => 'regular'),
        'Rambla' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Rammetto One' => array
            ('0' => 'regular'),
        'Ranchers' => array
            ('0' => 'regular'),
        'Rancho' => array
            ('0' => 'regular'),
        'Rationale' => array
            ('0' => 'regular'),
        'Redressed' => array
            ('0' => 'regular'),
        'Reenie Beanie' => array
            ('0' => 'regular'),
        'Revalia' => array
            ('0' => 'regular'),
        'Ribeye' => array
            ('0' => 'regular'),
        'Ribeye Marrow' => array
            ('0' => 'regular'),
        'Righteous' => array
            ('0' => 'regular'),
        'Risque' => array
            ('0' => 'regular'),
        'Roboto' => array
            ('0' => '100', '1' => '100italic', '2' => '300', '3' => '300italic', '4' => 'regular', '5' => 'italic', '6' => '500', '7' => '500italic', '8' => '700', '9' => '700italic', '10' => '900', '11' => '900italic'),
        'Roboto Condensed' => array
            ('0' => '300', '1' => '300italic', '2' => 'regular', '3' => 'italic', '4' => '700', '5' => '700italic'),
        'Rochester' => array
            ('0' => 'regular'),
        'Rock Salt' => array
            ('0' => 'regular'),
        'Rokkitt' => array
            ('0' => 'regular', '1' => '700'),
        'Romanesco' => array
            ('0' => 'regular'),
        'Ropa Sans' => array
            ('0' => 'regular', '1' => 'italic'),
        'Rosario' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Rosarivo' => array
            ('0' => 'regular', '1' => 'italic'),
        'Rouge Script' => array
            ('0' => 'regular'),
        'Ruda' => array
            ('0' => 'regular', '1' => '700', '2' => '900'),
        'Rufina' => array
            ('0' => 'regular', '1' => '700'),
        'Ruge Boogie' => array
            ('0' => 'regular'),
        'Ruluko' => array
            ('0' => 'regular'),
        'Rum Raisin' => array
            ('0' => 'regular'),
        'Ruslan Display' => array
            ('0' => 'regular'),
        'Russo One' => array
            ('0' => 'regular'),
        'Ruthie' => array
            ('0' => 'regular'),
        'Rye' => array
            ('0' => 'regular'),
        'Sacramento' => array
            ('0' => 'regular'),
        'Sail' => array
            ('0' => 'regular'),
        'Salsa' => array
            ('0' => 'regular'),
        'Sanchez' => array
            ('0' => 'regular', '1' => 'italic'),
        'Sancreek' => array
            ('0' => 'regular'),
        'Sansita One' => array
            ('0' => 'regular'),
        'Sarina' => array
            ('0' => 'regular'),
        'Satisfy' => array
            ('0' => 'regular'),
        'Scada' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Schoolbell' => array
            ('0' => 'regular'),
        'Seaweed Script' => array
            ('0' => 'regular'),
        'Sevillana' => array
            ('0' => 'regular'),
        'Seymour One' => array
            ('0' => 'regular'),
        'Shadows Into Light' => array
            ('0' => 'regular'),
        'Shadows Into Light Two' => array
            ('0' => 'regular'),
        'Shanti' => array
            ('0' => 'regular'),
        'Share' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Share Tech' => array
            ('0' => 'regular'),
        'Share Tech Mono' => array
            ('0' => 'regular'),
        'Shojumaru' => array
            ('0' => 'regular'),
        'Short Stack' => array
            ('0' => 'regular'),
        'Siemreap' => array
            ('0' => 'regular'),
        'Sigmar One' => array
            ('0' => 'regular'),
        'Signika' => array
            ('0' => '300', '1' => 'regular', '2' => '600', '3' => '700'),
        'Signika Negative' => array
            ('0' => '300', '1' => 'regular', '2' => '600', '3' => '700'),
        'Simonetta' => array
            ('0' => 'regular', '1' => 'italic', '2' => '900', '3' => '900italic'),
        'Sintony' => array
            ('0' => 'regular', '1' => '700'),
        'Sirin Stencil' => array
            ('0' => 'regular'),
        'Six Caps' => array
            ('0' => 'regular'),
        'Skranji' => array
            ('0' => 'regular', '1' => '700'),
        'Slackey' => array
            ('0' => 'regular'),
        'Smokum' => array
            ('0' => 'regular'),
        'Smythe' => array
            ('0' => 'regular'),
        'Sniglet' => array
            ('0' => '800'),
        'Snippet' => array
            ('0' => 'regular'),
        'Snowburst One' => array
            ('0' => 'regular'),
        'Sofadi One' => array
            ('0' => 'regular'),
        'Sofia' => array
            ('0' => 'regular'),
        'Sonsie One' => array
            ('0' => 'regular'),
        'Sorts Mill Goudy' => array
            ('0' => 'regular', '1' => 'italic'),
        'Source Code Pro' => array
            ('0' => '200', '1' => '300', '2' => 'regular', '3' => '500', '4' => '600', '5' => '700', '6' => '900'),
        'Source Sans Pro' => array
            ('0' => '200', '1' => '200italic', '2' => '300', '3' => '300italic', '4' => 'regular', '5' => 'italic', '6' => '600', '7' => '600italic', '8' => '700', '9' => '700italic', '10' => '900', '11' => '900italic'),
        'Special Elite' => array
            ('0' => 'regular'),
        'Spicy Rice' => array
            ('0' => 'regular'),
        'Spinnaker' => array
            ('0' => 'regular'),
        'Spirax' => array
            ('0' => 'regular'),
        'Squada One' => array
            ('0' => 'regular'),
        'Stalemate' => array
            ('0' => 'regular'),
        'Stalinist One' => array
            ('0' => 'regular'),
        'Stardos Stencil' => array
            ('0' => 'regular', '1' => '700'),
        'Stint Ultra Condensed' => array
            ('0' => 'regular'),
        'Stint Ultra Expanded' => array
            ('0' => 'regular'),
        'Stoke' => array
            ('0' => '300', '1' => 'regular'),
        'Strait' => array
            ('0' => 'regular'),
        'Sue Ellen Francisco' => array
            ('0' => 'regular'),
        'Sunshiney' => array
            ('0' => 'regular'),
        'Supermercado One' => array
            ('0' => 'regular'),
        'Suwannaphum' => array
            ('0' => 'regular'),
        'Swanky and Moo Moo' => array
            ('0' => 'regular'),
        'Syncopate' => array
            ('0' => 'regular', '1' => '700'),
        'Tangerine' => array
            ('0' => 'regular', '1' => '700'),
        'Taprom' => array
            ('0' => 'regular'),
        'Tauri' => array
            ('0' => 'regular'),
        'Telex' => array
            ('0' => 'regular'),
        'Tenor Sans' => array
            ('0' => 'regular'),
        'Text Me One' => array
            ('0' => 'regular'),
        'The Girl Next Door' => array
            ('0' => 'regular'),
        'Tienne' => array
            ('0' => 'regular', '1' => '700', '2' => '900'),
        'Tinos' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Titan One' => array
            ('0' => 'regular'),
        'Titillium Web' => array
            ('0' => '200', '1' => '200italic', '2' => '300', '3' => '300italic', '4' => 'regular', '5' => 'italic', '6' => '600', '7' => '600italic', '8' => '700', '9' => '700italic', '10' => '900'),
        'Trade Winds' => array
            ('0' => 'regular'),
        'Trocchi' => array
            ('0' => 'regular'),
        'Trochut' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700'),
        'Trykker' => array
            ('0' => 'regular'),
        'Tulpen One' => array
            ('0' => 'regular'),
        'Ubuntu' => array
            ('0' => '300', '1' => '300italic', '2' => 'regular', '3' => 'italic', '4' => '500', '5' => '500italic', '6' => '700', '7' => '700italic'),
        'Ubuntu Condensed' => array
            ('0' => 'regular'),
        'Ubuntu Mono' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Ultra' => array
            ('0' => 'regular'),
        'Uncial Antiqua' => array
            ('0' => 'regular'),
        'Underdog' => array
            ('0' => 'regular'),
        'Unica One' => array
            ('0' => 'regular'),
        'UnifrakturCook' => array
            ('0' => '700'),
        'UnifrakturMaguntia' => array
            ('0' => 'regular'),
        'Unkempt' => array
            ('0' => 'regular', '1' => '700'),
        'Unlock' => array
            ('0' => 'regular'),
        'Unna' => array
            ('0' => 'regular'),
        'VT323' => array
            ('0' => 'regular'),
        'Vampiro One' => array
            ('0' => 'regular'),
        'Varela' => array
            ('0' => 'regular'),
        'Varela Round' => array
            ('0' => 'regular'),
        'Vast Shadow' => array
            ('0' => 'regular'),
        'Vibur' => array
            ('0' => 'regular'),
        'Vidaloka' => array
            ('0' => 'regular'),
        'Viga' => array
            ('0' => 'regular'),
        'Voces' => array
            ('0' => 'regular'),
        'Volkhov' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Vollkorn' => array
            ('0' => 'regular', '1' => 'italic', '2' => '700', '3' => '700italic'),
        'Voltaire' => array
            ('0' => 'regular'),
        'Waiting for the Sunrise' => array
            ('0' => 'regular'),
        'Wallpoet' => array
            ('0' => 'regular'),
        'Walter Turncoat' => array
            ('0' => 'regular'),
        'Warnes' => array
            ('0' => 'regular'),
        'Wellfleet' => array
            ('0' => 'regular'),
        'Wendy One' => array
            ('0' => 'regular'),
        'Wire One' => array
            ('0' => 'regular'),
        'Yanone Kaffeesatz' => array
            ('0' => '200', '1' => '300', '2' => 'regular', '3' => '700'),
        'Yellowtail' => array
            ('0' => 'regular'),
        'Yeseva One' => array
            ('0' => 'regular'),
        'Yesteryear' => array
            ('0' => 'regular'),
        'Zeyada' => array
            ('0' => 'regular'),
    );

    update_option('cs_font_list', $font_list_init);
    update_option('cs_font_attribute', $font_atts_int);
}

add_action('after_setup_theme', 'cs_theme_setup');

function cs_theme_setup() {
    global $wpdb;
    /* Add theme-supported features. */
    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();
    // Make theme available for translation
    // Translations can be filed in the /languages/ directory
    load_theme_textdomain('goalklub', get_template_directory() . '/languages');

    if (!isset($content_width)) {
        $content_width = 1170;
    }

    $args = array(
        'default-color' => '',
        'flex-width' => true,
        'flex-height' => true,
        'default-image' => '',
    );
    add_theme_support('custom-background', $args);

    add_theme_support('custom-header', $args);
    // This theme uses post thumbnails
    add_theme_support('post-thumbnails');
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');
    /* Add custom actions. */
    add_theme_support("title-tag");

    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    global $pagenow;
    if (!session_id()) {
        //session_start();
    }
    if (!get_option('cs_font_list') || !get_option('cs_font_attribute')) {
        cs_get_google_init_arrays();
    }

    if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php') {

        if (!get_option('cs_theme_options')) {

            add_action('init', 'cs_activation_data');
        }
        add_action('admin_head', 'cs_activate_widget');
        if (!get_option('cs_theme_options')) {
            wp_redirect(admin_url('themes.php?page=cs_demo_importer'));
        }
        //wp_redirect( admin_url( 'themes.php?page=cs_demo_importer' ) );
    }
    add_action('admin_enqueue_scripts', 'cs_admin_scripts_enqueue');
    //wp_enqueue_scripts
    add_action('wp_enqueue_scripts', 'cs_front_scripts_enqueue');
    add_action('pre_get_posts', 'cs_get_search_results');

    /* Add custom filters. */
    add_filter('widget_text', 'do_shortcode');
    //add_filter('edit_user_profile','cs_contact_options',10,1);
    //add_filter('show_user_profile','cs_contact_options',10,1);
    //add_action('edit_user_profile_update', 'cs_contact_options_save' );
    //add_action('personal_options_update', 'cs_contact_options_save' );
    add_filter('user_contactmethods', 'cs_profile_fields', 10, 1);
    add_action('wp_login', 'cs_user_login', 10, 2);
    add_filter('login_message', 'cs_user_login_message');
    add_filter('the_password_form', 'cs_password_form');
    add_filter('wp_page_menu', 'cs_add_menuid');
    add_filter('wp_page_menu', 'cs_remove_div');
    add_filter('nav_menu_css_class', 'cs_add_parent_css', 10, 2);
    add_filter('pre_get_posts', 'cs_change_query_vars');
    add_action('init', 'cs_add_oembed_soundcloud');
}

// tgm class for (internal and WordPress repository) plugin activation start
require_once dirname(__FILE__) . '/include/theme-components/cs-activation-plugins/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'cs_register_required_plugins');

function cs_register_required_plugins() {
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name' => 'Revolution Slider',
            'slug' => 'revslider',
            'source' => 'http://chimpgroup.com/wp-demo/download-plugin/revslider.zip',
            'required' => false,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
        ),
        array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'required' => false,
        ),
        array(
            'name' => 'Loco Translate',
            'slug' => 'loco-translate',
            'required' => false,
            'source' => 'https://downloads.wordpress.org/plugin/loco-translate.1.5.1.zip',
        ),
        array(
            'name' => 'Woocommerce',
            'slug' => 'woocommerce',
            'required' => false,
        ),
        array(
            'name' => 'Envato Wordpress Toolkit',
            'slug' => 'envato-wordpress-toolkit',
            'source' => 'https://github.com/envato/envato-wordpress-toolkit/archive/master.zip',
            'required' => false,
        ),  
		array(
            'name' => 'cs framework',
            'slug' => 'cs-framework',
            'source' => get_template_directory_uri().'/include/theme-components/cs-activation-plugins/cs-framework.zip',
            'required' => true,
        ),
    );
    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'goalklub';
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain' => 'goalklub', // Text domain - likely want to be the same as your theme.
        'default_path' => '', // Default absolute path to pre-packaged plugins
        'parent_slug' => 'themes.php', // Default parent Parent slug
        'menu' => 'install-required-plugins', // Menu slug
        'has_notices' => true, // Show admin notices or not
        'is_automatic' => true, // Automatically activate plugins after installation or not
        'message' => '', // Message to output right before the plugins table
        'strings' => array(
            'page_title' => __('Install Required Plugins', 'goalklub'),
            'menu_title' => __('Install Plugins', 'goalklub'),
            'installing' => __('Installing Plugin: %s', 'goalklub'), // %1$s = plugin name
            'oops' => __('Something went wrong with the plugin API.', 'goalklub'),
            'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'goalklub'), // %1$s = plugin name(s)
            'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'goalklub'), // %1$s = plugin name(s)
            'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'goalklub'), // %1$s = plugin name(s)
            'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'goalklub'), // %1$s = plugin name(s)
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'goalklub'), // %1$s = plugin name(s)
            'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'goalklub'), // %1$s = plugin name(s)
            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'goalklub'), // %1$s = plugin name(s)
            'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'goalklub'), // %1$s = plugin name(s)
            'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins', 'goalklub'),
            'activate_link' => _n_noop('Activate installed plugin', 'Activate installed plugins', 'goalklub'),
            'return' => __('Return to Required Plugins Installer', 'goalklub'),
            'plugin_activated' => __('Plugin activated successfully.', 'goalklub'),
            'complete' => __('All plugins installed and activated successfully. %s', 'goalklub'), // %1$s = dashboard link
            'nag_type' => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );
    tgmpa($plugins, $config);
}

// tgm class for (internal and WordPress repository) plugin activation end
// Match Detail
add_image_size('cs_media_1', 1920, 736, true);

// Blog Detail, Bloag Lage, Math Detail, Result & Fixtures
add_image_size('cs_media_2', 816, 459, true);

// About Stadium
add_image_size('cs_media_3', 390, 293, true);

// Player Info
add_image_size('cs_media_4', 374, 547, true);

// Blog Home
add_image_size('cs_media_5', 365, 201, true);

// Blog Medium
add_image_size('cs_media_6', 360, 360, true);

// Other Players
add_image_size('cs_media_7', 262, 385, true);

// Blog Grid, Related Posts
add_image_size('cs_media_8', 250, 188, true);

// Gallery
add_image_size('cs_media_9', 190, 143, true);

// Function Title
//Single files paths
function cs_get_custom_post_type_template($single_template) {
    global $post;
    $single_path = dirname(__FILE__);
    if ($post->post_type == 'player') {
        $single_template = $single_path . '/cs-templates/player-styles/single-player.php';
    }
    if ($post->post_type == 'match') {
        $single_template = $single_path . '/cs-templates/match-styles/single-match.php';
    }

    return $single_template;
}

add_filter('single_template', 'cs_get_custom_post_type_template');

/// Next post link class
function cs_posts_link_next_class($format) {
    $format = str_replace('href=', 'class="pix-nextpost" href=', $format);
    return $format;
}

add_filter('next_post_link', 'cs_posts_link_next_class');

/// prev post link class
function cs_posts_link_prev_class($format) {
    $format = str_replace('href=', 'class="pix-prevpost" href=', $format);
    return $format;
}

add_filter('previous_post_link', 'cs_posts_link_prev_class');

// Get src URL from avatar <img> tag (add to functions.php)
function cs_get_avatar_url($author_id, $size) {
    $get_avatar = get_avatar($author_id, $size);
    preg_match("/src='(.*?)'/i", $get_avatar, $matches);
    return ( $matches[1] );
}

// author description custom function
if (!function_exists('cs_author_description')) {

    function cs_author_description($type = '') {
        global $cs_theme_options;
        ?>
        <style scoped>
            .cs-about-author {
                width: 100%;
                float: left;
                padding: 60px 30px 40px 30px;
            }
        </style>
        <div class="cs-about-author">
            <figure>
                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                    <?php
                    $current_user = wp_get_current_user();
                    $custom_image_url = get_user_meta(get_the_author_meta('ID'), 'user_avatar_display', true);
                    $size = 230;
                    if (isset($custom_image_url) && $custom_image_url <> '') {
                        echo '<img src="' . $custom_image_url . '" class="avatar photo" width="' . $size . '" height="' . $size . '" alt="' . $current_user->display_name . '" />';
                    } else {
                        echo get_avatar(get_the_author_meta('ID'), apply_filters('CS_author_bio_avatar_size', 150));
                    }
                    ?>
                </a>
            </figure>

            <div class="text">
                <header>
                    <h5><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author(); ?></a></h5>
                </header>

                <?php
                $author_meta = get_the_author_meta('description');
                $twitter = get_the_author_meta('twitter');
                if (strlen($author_meta) > 200) {
                    echo '<p>' . substr($author_meta, 0, 200) . '...' . '</p>';
                } else {
                    echo '<p>' . cs_allow_special_char($author_meta) . '</p>';
                }

                if ($type == 'show') {
                    ?>
                    <a class="custom-btn" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php _e('All Posts', 'goalklub'); ?></a>
                    <?php if (isset($twitter) && $twitter != '') { ?>
                        <a class="custom-btn" target="_blank" href="<?php echo esc_url($twitter); ?>"><?php _e('Follow me', 'goalklub'); ?></a>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>

        <?php
    }

}

// tgm class for (internal and WordPress repository) plugin activation end
// stripslashes / htmlspecialchars for theme option save start
function cs_stripslashes_htmlspecialchars($value) {
    $value = is_array($value) ? array_map('cs_stripslashes_htmlspecialchars', $value) : stripslashes(htmlspecialchars($value));
    return $value;
}

// stripslashes / htmlspecialchars for theme option save end
//Home Page Services
function cs_services() {
    global $cs_theme_option;
    if (isset($cs_theme_option['varto_services_shortcode']) and $cs_theme_option['varto_services_shortcode'] <> "") {
        ?>
        <div class="parallax-fullwidth services-container">
            <div class="container">
                <?php if ($cs_theme_option['varto_sevices_title'] <> "") { ?>
                    <header class="cs-heading-title">
                        <h2 class="cs-section-title"><?php echo cs_allow_special_char($cs_theme_option['varto_sevices_title']); ?></h2>
                    </header>
                    <?php
                }
                echo do_shortcode($cs_theme_option['varto_services_shortcode']);
                ?>
            </div>
        </div>
        <div class="clear"></div>
        <?php
    }
}

//Countries Array
if (!function_exists('cs_get_countries')) {

    function cs_get_countries() {

        $get_countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan",
            "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "British Virgin Islands",
            "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China",
            "Colombia", "Comoros", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Democratic People's Republic of Korea", "Democratic Republic of the Congo", "Denmark", "Djibouti",
            "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "England", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Fiji", "Finland", "France", "French Polynesia",
            "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong",
            "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kosovo", "Kuwait", "Kyrgyzstan",
            "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Macedonia", "Madagascar", "Malawi", "Malaysia",
            "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique",
            "Myanmar(Burma)", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Northern Ireland",
            "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Puerto Rico",
            "Qatar", "Republic of the Congo", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa",
            "San Marino", "Saudi Arabia", "Scotland", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa",
            "South Korea", "Spain", "Sri Lanka", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga",
            "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "US Virgin Islands", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay",
            "Uzbekistan", "Vanuatu", "Vatican", "Venezuela", "Vietnam", "Wales", "Yemen", "Zambia", "Zimbabwe");

        return $get_countries;
    }

}
// installing tables on theme activating start
global $pagenow;

// Admin scripts enqueue

function force_back($input){
    $output = $input;
    return $output;
}

function cs_admin_scripts_enqueue() {
	
	global $post;
	// for pages ** contact us, TypoGraphy, Common Elements
	if(isset($post->ID) && ($post->ID == 333 || $post->ID == 535 || $post->ID == 539)){ 
		/*Enqueue style*/
        wp_enqueue_style( 'short_code_css', get_theme_file_uri( '/assets/css/shortcode.css' ));
	}
	
    wp_enqueue_style('fonts_googleapis_1', 'http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600&subset=latin,cyrillic-ext');
    wp_enqueue_style('fonts_googleapis_2', 'http://fonts.googleapis.com/css?family=Lato:400,300,700,900,100&subset=latin,latin-ext');
    wp_enqueue_style('fonts_googleapis_3', 'http://fonts.googleapis.com/css?family=Asap:400,700&subset=latin,latin-ext');
    wp_enqueue_style('responsive2', get_template_directory_uri() . '/assets/css/responsive2.css');
    wp_enqueue_style('shortcode_css', get_template_directory_uri() . '/assets/css/shortcode.css');

	
    if (is_admin()) {
        $template_path = get_template_directory_uri() . '/include/assets/scripts/media_upload.js';
        wp_enqueue_media();
        wp_enqueue_script('my-upload', $template_path, array('jquery', 'media-upload', 'thickbox', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-slider', 'wp-color-picker'));
        wp_enqueue_script('datetimepicker1_js', get_template_directory_uri() . '/include/assets/scripts/jquery_datetimepicker.js', '', '', true);
        wp_enqueue_script('admin_theme-option-fucntion_js', get_template_directory_uri() . '/include/assets/scripts/theme_option_fucntion.js', '', '', true);

        wp_enqueue_style('custom_wp_admin_style', get_template_directory_uri() . '/include/assets/css/admin_style.css');
        wp_enqueue_script('custom_wp_admin_script', get_template_directory_uri() . '/include/assets/scripts/cs_functions.js');

        wp_enqueue_script('custom_page_builder_wp_admin_script', get_template_directory_uri() . '/include/assets/scripts/cs_page_builder_functions.js');
        wp_enqueue_script('bootstrap.min_script', get_template_directory_uri() . '/include/assets/scripts/bootstrap.min.js');
        wp_enqueue_style('wp-color-picker');

        // load icon moon
        wp_enqueue_script('fonticonpicker_js', get_template_directory_uri() . '/include/assets/icon/js/jquery.fonticonpicker.min.js');
        wp_enqueue_style('fonticonpicker_css', get_template_directory_uri() . '/include/assets/icon/css/jquery.fonticonpicker.min.css');
        wp_enqueue_style('iconmoon_css', get_template_directory_uri() . '/include/assets/icon/css/iconmoon.css');
        wp_enqueue_style('fonticonpicker_bootstrap_css', get_template_directory_uri() . '/include/assets/icon/theme/bootstrap-theme/jquery.fonticonpicker.bootstrap.css');
    }
}

// Backend functionality files
require_once (get_template_directory() . '/functions-theme.php');
require_once (get_template_directory() . '/include/page_builder.php');
require_once (get_template_directory() . '/include/post_meta.php');
require_once (get_template_directory() . '/include/page_options.php');
require_once (get_template_directory() . '/include/admin_functions.php');
require_once (get_template_directory() . '/include/theme-components/cs-importer/theme_importer.php');
/* include files for post types */
require_once (get_template_directory() . '/include/theme-components/cs-posttypes/pt_match.php');
require_once (get_template_directory() . '/include/theme-components/cs-posttypes/pt_player.php');
require_once (get_template_directory() . '/include/theme-components/cs-posttypes/pt_pointtables.php');

// Result/Reports listing for Instructors

require_once (get_template_directory() . '/cs-templates/match-styles/match_element.php');
require_once (get_template_directory() . '/cs-templates/match-styles/match_functions.php');
require_once (get_template_directory() . '/cs-templates/match-styles/match_templates.php');

require_once (get_template_directory() . '/cs-templates/player-styles/player_element.php');
require_once (get_template_directory() . '/cs-templates/player-styles/player_functions.php');
require_once (get_template_directory() . '/cs-templates/player-styles/player_templates.php');

require_once (get_template_directory() . '/cs-templates/pointtable-styles/pointtable_element.php');
require_once (get_template_directory() . '/cs-templates/pointtable-styles/pointtable_functions.php');
require_once (get_template_directory() . '/cs-templates/pointtable-styles/pointtable_templates.php');

require_once (get_template_directory() . '/cs-templates/blog-styles/blog_element.php');
require_once (get_template_directory() . '/cs-templates/blog-styles/blog_functions.php');
require_once (get_template_directory() . '/cs-templates/blog-styles/blog_templates.php');

require_once (get_template_directory() . '/include/theme-components/cs-mega-menu/custom_walker.php');
require_once (get_template_directory() . '/include/theme-components/cs-mega-menu/edit_custom_walker.php');
require_once (get_template_directory() . '/include/theme-components/cs-mega-menu/menu_functions.php');

require_once (get_template_directory() . '/include/theme-components/cs-widgets/widgets.php');
require_once (TEMPLATEPATH . '/include/theme-components/cs-widgets/widgets_keys.php');
require_once (get_template_directory() . '/include/theme-components/cs-header/header_functions.php');

require_once (get_template_directory() . '/include/shortcodes/shortcode_elements.php');
require_once (get_template_directory() . '/include/shortcodes/shortcode_functions.php');
require_once (get_template_directory() . '/include/shortcodes/typography_elements.php');
require_once (get_template_directory() . '/include/shortcodes/typography_function.php');
require_once (get_template_directory() . '/include/shortcodes/common_elements.php');
require_once (get_template_directory() . '/include/shortcodes/common_function.php');
require_once (get_template_directory() . '/include/shortcodes/media_elements.php');
require_once (get_template_directory() . '/include/shortcodes/media_function.php');
require_once (get_template_directory() . '/include/shortcodes/contentblock_elements.php');
require_once (get_template_directory() . '/include/shortcodes/contentblock_function.php');
require_once (get_template_directory() . '/include/shortcodes/loops_elements.php');
require_once (get_template_directory() . '/include/shortcodes/loops_function.php');

require_once (get_template_directory() . '/include/theme-components/cs-mailchimp/mailchimp.class.php');
require_once (get_template_directory() . '/include/theme-components/cs-mailchimp/mailchimp_functions.php');
require_once (get_template_directory() . '/include/theme-components/cs-googlefont/fonts.php');
require_once (get_template_directory() . '/include/theme-components/cs-googlefont/google_fonts.php');
require_once (get_template_directory() . '/include/theme_colors.php');
require_once (get_template_directory() . '/include/shortcodes/class_parse.php');
require_once (get_template_directory() . '/include/theme-options/theme_options.php');
require_once (get_template_directory() . '/include/theme-options/theme_options_fields.php');
require_once (get_template_directory() . '/include/theme-options/theme_options_functions.php');
require_once (get_template_directory() . '/include/theme-options/theme_options_arrays.php');


//._-		=======================================================================================================================	

			add_action('admin_menu', 'goalklub_pro_menu', 0);
            add_action('admin_menu',  'wp_gk_submenu', 25);
			add_action('admin_menu',  'modify_menu', 30);
			add_action('admin_head', 'modify_menu_link' );
			
			
			function modify_menu_link() {
				
				?>
				<script type="text/javascript">
					jQuery(document).ready(function ($) {
						$('#adminmenu #toplevel_page_custompage li').find('a').attr('target', '_blank');
					});
				</script>
				<?php
				
        }
			
			
			function goalklub_pro_menu() {
            add_menu_page(__('GOALKLUB', 'goalklub'), __('GOALKLUB', 'goalklub'), 'manage_options', 'custompage', 'gk_menu_callback' , get_template_directory_uri().'/assets/images/gk.png', 2);
// To go to first submenu automatically/dynamically by clicking on main menu use slug in submenu as main menu		
            add_submenu_page('custompage', '', '', 'manage_options', 'custompage', 'gk_pro_menu_callback' );
//  In remove_submenu_page() First argument is main menu's fourth argument and second argument is submenu's fifth argument.
            remove_submenu_page('custompage', 'custompage');
        }			

			function wp_gk_submenu() {

			add_submenu_page('custompage', 'Theme Support', __('Theme Support', 'goalklub'), 'manage_options', 'theme_support', 'theme_support_callback' );
            add_submenu_page('custompage', 'Customization', __('Customization', 'goalklub'), 'manage_options', 'cs_customization_request', 'customization_request_callback' );
            add_submenu_page('custompage', 'Documentation', __('Documentation', 'goalklub'), 'manage_options', 'cs_documentation', 'first_submenu_callback' );
			
        }
		
		
		 function gk_pro_menu_callback() {
            
        }
			
		
		function first_submenu_callback() {
            
        }
		
		
		function gk_menu_callback() {
            
        }
		
		function customization_request_callback() {

		}
		
		function theme_support_callback() {

		}		
		
		
		

if (class_exists('woocommerce')) {
    require_once( get_template_directory() . '/include/theme-components/cs-woocommerce/config.php' );
    require_once (get_template_directory() . '/include/theme-components/cs-woocommerce/product_meta.php');
}

/////////////////////////////////

if (current_user_can('administrator')) {
    // Addmin Menu CS Theme Option

    if (current_user_can('administrator')) {
        // Addmin Menu CS Theme Option
        add_action('admin_menu', 'cs_theme');
        if (!function_exists('cs_theme')) {

            function cs_theme() {
                add_theme_page('CS Theme Option', __('CS Theme Option', 'goalklub'), 'read', 'cs_options_page', 'cs_options_page');
                add_theme_page("Import Demo Data", __("Import Demo Data", 'goalklub'), 'read', 'cs_demo_importer', 'cs_demo_importer');
            }

        }
    }
}

/* save user profile fields */

function cs_user_login($user_login, $user) {
    // Get user meta
    $disabled = get_user_meta($user->ID, 'user_switch', true);
    // Is the use logging in disabled?
    if ($disabled == '1') {
        // Clear cookies, a.k.a log user out
        wp_clear_auth_cookie();
        // Build login URL and then redirect
        $login_url = site_url('wp-login.php', 'login');
        $login_url = add_query_arg('disabled', '1', urlencode($login_url));
        wp_redirect($login_url);
        exit;
    }
}

/* show error message */

function cs_user_login_message($message) {
    // Show the error message if it seems to be a disabled user
    if (isset($_GET['disabled']) && $_GET['disabled'] == 1)
        $message = '<div id="cs_login_error">Account Disable</div>';
    return $message;
}

// Enqueue frontend style and scripts
if (!function_exists('cs_front_scripts_enqueue')) {

    function cs_front_scripts_enqueue() {
        global $cs_theme_options;
        if (!is_admin()) {
            wp_enqueue_script('jquery');
            wp_enqueue_style('bootstrap_css', get_template_directory_uri() . '/assets/css/bootstrap.css');
            wp_enqueue_style('style_css', get_stylesheet_directory_uri() . '/style.css');
			wp_enqueue_style('themetypo_css', get_stylesheet_directory_uri() . '/assets/css/themetypo.css');
            wp_enqueue_style('animate_css', get_stylesheet_directory_uri() . '/assets/css/animate.css');
            wp_enqueue_style('iconmoon_css', get_template_directory_uri() . '/assets/css/iconmoon.css');
           // wp_enqueue_style('bootstrap-theme_css', get_template_directory_uri() . '/assets/css/bootstrap-theme.css.map');
            wp_enqueue_style('widget_css', get_template_directory_uri() . '/assets/css/widget.css');
            wp_enqueue_script('bootstrap.min_script', get_template_directory_uri() . '/assets/scripts/bootstrap.min.js', '', '', true);
            wp_enqueue_style('flexslider_css', get_template_directory_uri() . '/assets/css/flexslider.css');
            wp_enqueue_style('mediaelementplayer.min_css', get_template_directory_uri() . '/assets/css/mediaelementplayer.min.css');
            wp_enqueue_style('prettyPhoto_css', get_template_directory_uri() . '/assets/css/prettyphoto.css');
            wp_enqueue_script('jquery_fitvids', get_template_directory_uri() . '/assets/scripts/jquery.fitvids.js', '', '', true);
            wp_enqueue_script('jquery_slik_menu', get_template_directory_uri() . '/assets/scripts/slick.js', '', '', true);
            wp_enqueue_script('jquery_responsive_menu', get_template_directory_uri() . '/assets/scripts/responsive.menu.js', '', '', true);
            wp_enqueue_script('wow_effects', get_template_directory_uri() . '/assets/scripts/wow.js', '', '', true);
            
//			wp_enqueue_script('jquery_minified_production', get_template_directory_uri() . '/assets/scripts/jquery-3.3.1.min.js', '', '', true);
						
//			wp_register_script('jQuery_min_js', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', null, null, true );
//			wp_enqueue_script('jQuery_min_js');
			
            if (isset($cs_theme_options['cs_smooth_scroll']) and $cs_theme_options['cs_smooth_scroll'] == 'on') {
                wp_enqueue_script('jquery_nicescroll', get_template_directory_uri() . '/assets/scripts/jquery.nicescroll.min.js', '', '', true);
            }
            wp_enqueue_script('functions_js', get_template_directory_uri() . '/assets/scripts/functions.js', '', '', true);
            if (isset($cs_theme_options['cs_style_rtl']) and $cs_theme_options['cs_style_rtl'] == "on") {
                cs_rtl();
            }
            wp_enqueue_style('cs_woocommerce_css', get_template_directory_uri() . '/assets/css/cs_woocommerce.css');
            if (isset($cs_theme_options['cs_responsive']) && $cs_theme_options['cs_responsive'] == "on") {
                echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">';
                wp_enqueue_style('responsive_css', get_template_directory_uri() . '/assets/css/responsive.css');
            }
        }
    }

}


// Portfolio Filters
if (!function_exists('cs_filterable')) {

    function cs_filterable() {
        wp_enqueue_script('filterable_js', get_template_directory_uri() . '/assets/scripts/filterable.js', '', '', true);
    }

}

// Countdown
if (!function_exists('cs_countdown')) {

    function cs_countdown() {
        wp_enqueue_script('countdown_js', get_template_directory_uri() . '/assets/scripts/jquery.countdown.js', '', '', true);
    }

}


//RTL stylesheet enqueue
if (!function_exists('cs_rtl')) {

    function cs_rtl() {
        wp_enqueue_style('rtl_css', get_template_directory_uri() . '/assets/css/rtl.css');
    }

}

// scroll to fix
function cs_scrolltofix() {
    wp_enqueue_script('sticky_header_js', get_template_directory_uri() . '/assets/scripts/sticky_header.js', '', '', true);
}

// Prettyphoto
if (!function_exists('cs_prettyphoto_enqueue')) {

    function cs_prettyphoto_enqueue() {
        wp_enqueue_script('prettyPhoto_js', get_template_directory_uri() . '/assets/scripts/jquery.prettyphoto.js', '', '', true);
    }

}

// Flexslider Script
if (!function_exists('cs_enqueue_flexslider_script')) {

    function cs_enqueue_flexslider_script() {
        wp_enqueue_script('jquery.flexslider-min_js', get_template_directory_uri() . '/assets/scripts/jquery.flexslider.js', '', '', true);
    }

}
// Count Numbers
if (!function_exists('cs_count_numbers_script')) {

    function cs_count_numbers_script() {
        wp_enqueue_script('waypoints_js', get_template_directory_uri() . '/assets/scripts/waypoints_min.js', '', '', true);
    }

}
// Skillbar
if (!function_exists('cs_skillbar_script')) {

    function cs_skillbar_script() {
        wp_enqueue_script('waypoints_js', get_template_directory_uri() . '/assets/scripts/waypoints_min.js', '', '', true);
        wp_enqueue_script('circliful_js', get_template_directory_uri() . '/assets/scripts/jquery_circliful.js', '', '', true);
    }

}

// Add this enqueue Script
if (!function_exists('cs_addthis_script_init_method')) {

    function cs_addthis_script_init_method() {
        wp_enqueue_script('cs_addthis', 'http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e4412d954dccc64', '', '', true);
    }

}

// carousel script for related posts
if (!function_exists('cs_owl_carousel')) {

    function cs_owl_carousel() {
        wp_enqueue_script('owl.carousel_js', get_template_directory_uri() . '/assets/scripts/owl.carousel.min.js', '', '', true);
        wp_enqueue_style('owl.carousel_css', get_template_directory_uri() . '/assets/css/owl.carousel.css');
    }

}

// Favicon and header code in head tag//
if (!function_exists('cs_header_settings')) {

    function cs_header_settings() {
        global $cs_theme_options;
        ?>
        <link rel="shortcut icon" href="<?php echo trim($cs_theme_options['cs_custom_favicon']) ? $cs_theme_options['cs_custom_favicon'] : '#'; ?>">
        <?php
    }

}

// Favicon and header code in head tag//
if (!function_exists('cs_footer_settings')) {

    function cs_footer_settings() {
        global $cs_theme_options;
        ?>
        <!--[if lt IE 9]><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" /><![endif]-->
        <?php
        if (isset($cs_theme_options['analytics'])) {
            echo wp_specialchars_decode($cs_theme_options['cs_custom_js']);
        }
    }

}

// search varibales start

function cs_get_search_results($query) {

    if (!is_admin() and ( is_search())) {

        $query->set('post_type', array('post', 'match', 'player'));

        remove_action('pre_get_posts', 'cs_get_search_results');
    }
}

// password protect post/page

if (!function_exists('cs_password_form')) {

    function cs_password_form() {

        global $post, $cs_theme_option;

        $label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );

        $o = '<div class="password_protected">

				<div class="protected-icon"><a href="#"><i class="icon-unlock-alt fa-4x"></i></a></div>

				<h3>' . __("This post is password protected. To view it please enter your password below:", 'goalklub') . '</h3>';

        $o .= '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">

					<label><input name="post_password" id="' . $label . '" type="password" size="20" /></label>

					<input class="bgcolr" type="submit" name="Submit" value="' . __("Submit", "goalklub") . '" />

				</form>

			</div>';

        return $o;
    }

}
// add menu id
if (!function_exists('cs_add_menuid')) {

    function cs_add_menuid($ulid) {

        return preg_replace('/<ul>/', '<ul id="menus">', $ulid, 1);
    }

}
// remove additional div from menu
if (!function_exists('cs_remove_div')) {

    function cs_remove_div($menu) {

        return preg_replace(array('#^<div[^>]*>#', '#</div>$#'), '', $menu);
    }

}
// add parent class
if (!function_exists('cs_add_parent_css')) {

    function cs_add_parent_css($classes, $item) {
        global $cs_menu_children;
        if ($cs_menu_children)
            $classes[] = 'parent';
        return $classes;
    }

}
// change the default query variable start
if (!function_exists('cs_change_query_vars')) {

    function cs_change_query_vars($query) {

        if (is_search() || is_home()) {

            if (empty($_GET['page_id_all']))
                $_GET['page_id_all'] = 1;

            $query->query_vars['paged'] = $_GET['page_id_all'];

            return $query;
        }
    }

}
// Filter shortcode in text areas

if (!function_exists('cs_textarea_filter')) {

    function cs_textarea_filter($content = '') {

        return do_shortcode($content);
    }

}

//	Add Featured/sticky text/icon for sticky posts.

if (!function_exists('cs_featured')) {

    function cs_featured() {
        if (is_sticky()) {
            ?>
            <time><span class="featured-post">
            <?php _e('Featured', 'goalklub'); ?>
                </span></time>
            <?php
        }
    }

}
//Woocommerce Cart Count
if (!function_exists('cs_woocommerce_header_cart')) {

    function cs_woocommerce_header_cart() {
        if (class_exists('woocommerce')) {
            global $woocommerce;
            echo '<a href="' . esc_url(wc_get_cart_url()) . '"><i class="icon-cart5"></i>' . __('Cart', 'goalklub');
            ?>
            <span class="qnt">
                <?php
                if ($woocommerce->cart->cart_contents_count > 0) {
                    echo intval($woocommerce->cart->cart_contents_count);
                } else {
                    _e('0', 'goalklub');
                }
                ?>
            </span> </a>
            <?php
        }
    }

}


// display post page title
if (!function_exists('cs_post_page_title')) {

    function cs_post_page_title() {

        if (is_author()) {

            global $author;

            $userdata = get_userdata($author);

            echo __('Author', 'goalklub') . " " . __('Archives', 'goalklub') . ": " . $userdata->display_name;
        } elseif (is_tag() || is_tax('event-tag')) {

            echo __('Tags', 'goalklub') . " " . __('Archives', 'goalklub') . ": " . single_cat_title('', false);
        } elseif (is_search()) {

            printf(__('Search Results %1$s %2$s', 'goalklub'), ': ', '<span>' . get_search_query() . '</span>');
        } elseif (is_day()) {

            printf(__('Daily Archives: %s', 'goalklub'), '<span>' . get_the_date() . '</span>');
        } elseif (is_month()) {

            printf(__('Monthly Archives: %s', 'goalklub'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'goalklub')) . '</span>');
        } elseif (is_year()) {

            printf(__('Yearly Archives: %s', 'goalklub'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'goalklub')) . '</span>');
        } elseif (is_404()) {

            _e('Error 404', 'goalklub');
        } elseif (is_home()) {

            _e('Home', 'goalklub');
        } elseif (!is_page()) {

            _e('Archives', 'goalklub');
        }
    }

}
// If no content, include the "No posts found" function
if (!function_exists('cs_fnc_no_result_found')) {

    function cs_fnc_no_result_found() {
        $is_search = '';
        global $cs_theme_options;
        ?>
        <div class="page-no-search">
        <?php
        if (!is_search()) :
            ?>
                <header>
                    <h2>
                <?php _e('No results found.', 'goalklub'); ?>
                    </h2>
                </header>
                <aside class="cs-icon"> <i class="icon-frown-o"></i> </aside>
                <?php
            endif;

            if (is_home() && current_user_can('publish_posts')) :
                printf(__('<p>Ready to publish your first post? <a href="%1$s">Get Started Here</a>.</p>', 'goalklub'), admin_url('post-new.php'));

            elseif (is_search()) :
                $a =  'No pages were found containing "' . get_search_query() . '"';
                ?>
                <h2><?php echo esc_html($a); ?></h2>
                <div class="cs-seprator">
                    <div class="devider1"></div>
                </div>
                <h6><?php _e('Suggestions:', 'goalklub'); ?></h6>
                <p><?php _e('Sorry, no posts matched your criteria. Please try another search', 'goalklub'); ?> <br><?php _e('You might want to consider some of our suggestions to get better results:', 'goalklub'); ?></p>
                <ul>
                    <li><a href="#"><?php _e('Make sure all words are spelled correctly', 'goalklub'); ?></a></li>
                    <li><a href="#"><?php _e('Wildcard searches (using the asterisk *) are not supported', 'goalklub'); ?></a></li>
                    <li><a href="#"><?php _e('Try more general keywords, especially if you are attempting a name', 'goalklub'); ?></a></li>
                </ul>
                <?php
            else :
                _e('<p>It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.</p>', 'goalklub');

            endif;

            if (is_search()) :
                get_search_form();
            endif;
            ?>
            <div class="box_spreater">
            </div>
        </div>
        <?php
    }

}

function cs_wps_highlight_results($text) {
    if (is_search()) {
        $sr = get_query_var('s');
        $keys = explode(" ", $sr);
        $text = preg_replace('/(' . implode('|', $keys) . ')/iu', '' . $sr . '', $text);
    }
    return $text;
}

add_filter('get_the_excerpt', 'cs_wps_highlight_results');
//add_filter('the_title', 'wps_highlight_results');
// Custom function for next previous posts
if (!function_exists('cs_next_prev_custom_links')) {

    function cs_next_prev_custom_links($post_type = 'post') {
        global $post, $wpdb, $cs_theme_options, $cs_xmlObject;
        $previd = $nextid = '';
        $post_type = get_post_type($post->ID);
        $count_posts = wp_count_posts("$post_type")->publish;
        $px_postlist_args = array(
            'posts_per_page' => -1,
            'order' => 'ASC',
            'post_type' => "$post_type",
        );
        $px_postlist = get_posts($px_postlist_args);
        $ids = array();
        foreach ($px_postlist as $px_thepost) {
            $ids[] = $px_thepost->ID;
        }
        
      
        
        
        
        $thisindex = array_search($post->ID, $ids);
        if (isset($ids[$thisindex - 1])) {
            $previd = $ids[$thisindex - 1];
        }
        if (isset($ids[$thisindex + 1])) {
            $nextid = $ids[$thisindex + 1];
        }

        echo '<div class="prev-next-post">';
        if (isset($previd) && !empty($previd) && $previd >= 0) {
            ?>
            <article class="prev">
                <div class="text">
                    <h2><a href="<?php echo get_permalink($previd); ?>"><?php echo substr(get_the_title($previd), 0, 30);
            echo (strlen(get_the_title()) > 30) ? '...' : '';
            ?></a> </h2>
                    <a class="left-arrow" href="<?php echo get_permalink($previd); ?>"><i class="icon-angle-left"></i> </a>
                </div>
            </article>
        <?php }
        ?>
            <a onclick="javascript:window.history.back()" class="history-back-btn"><i class="icon-list8"></i></a>
        <?php
        if (isset($nextid) && !empty($nextid)) {
            ?>
            <article class="next">
                <div class="text">
                    <h2><a href="<?php echo get_permalink($nextid); ?>"><?php echo substr(get_the_title($nextid), 0, 30);
            echo (strlen(get_the_title()) > 30) ? '...' : '';
            ?></a> </h2>
                    <a class="right-arrow" href="<?php echo get_permalink($nextid); ?>"><i class="icon-angle-right"></i></a>
                </div>
            </article>
            <?php
        }
        echo '</div>';
        wp_reset_query();
    }

}

/* 	Function to get the events info on calander -- START	 */
add_action('get_header', 'cs_my_filter_head');

function cs_my_filter_head() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}

// get object array
function cs_ObjecttoArray($obj) {
    if (is_object($obj))
        $obj = (array) $obj;
    if (is_array($obj)) {
        $new = array();
        foreach ($obj as $key => $val) {
            $new[$key] = cs_ObjecttoArray($val);
        }
    } else {
        $new = $obj;
    }

    return $new;
}

// Get Google Fonts
function cs_get_google_fonts() {
    $cs_fonts = array("Abel", "Aclonica", "Acme", "Actor", "Advent Pro", "Aldrich", "Allerta", "Allerta Stencil", "Amaranth", "Andika", "Anonymous Pro", "Antic", "Anton", "Arimo", "Armata", "Asap", "Asul",
        "Basic", "Belleza", "Cabin", "Cabin Condensed", "Cagliostro", "Candal", "Cantarell", "Carme", "Chau Philomene One", "Chivo", "Coda Caption", "Comfortaa", "Convergence", "Cousine", "Cuprum", "Days One",
        "Didact Gothic", "Doppio One", "Dorsa", "Dosis", "Droid Sans", "Droid Sans Mono", "Duru Sans", "Economica", "Electrolize", "Exo", "Federo", "Francois One", "Fresca", "Galdeano", "Geo", "Gudea",
        "Hammersmith One", "Homenaje", "Imprima", "Inconsolata", "Inder", "Istok Web", "Jockey One", "Josefin Sans", "Jura", "Karla", "Krona One", "Lato", "Lekton", "Magra", "Mako", "Marmelad", "Marvel",
        "Maven Pro", "Metrophobic", "Michroma", "Molengo", "Montserrat", "Muli", "News Cycle", "Nobile", "Numans", "Nunito", "Open Sans", "Open Sans Condensed", "Orbitron", "Oswald", "Oxygen", "PT Mono",
        "PT Sans", "PT Sans Caption", "PT Sans Narrow", "Paytone One", "Philosopher", "Play", "Pontano Sans", "Port Lligat Sans", "Puritan", "Quantico", "Quattrocento Sans", "Questrial", "Quicksand", "Rationale",
        "Roboto", "Ropa Sans", "Rosario", "Ruda", "Ruluko", "Russo One", "Shanti", "Sigmar One", "Signika", "Signika Negative", "Six Caps", "Snippet", "Spinnaker", "Syncopate", "Telex", "Tenor Sans", "Ubuntu",
        "Ubuntu Condensed", "Ubuntu Mono", "Varela", "Varela Round", "Viga", "Voltaire", "Wire One", "Yanone Kaffeesatz", "Adamina", "Alegreya", "Alegreya SC", "Alice", "Alike", "Alike Angular", "Almendra",
        "Almendra SC", "Amethysta", "Andada", "Antic Didone", "Antic Slab", "Arapey", "Artifika", "Arvo", "Average", "Balthazar", "Belgrano", "Bentham", "Bevan", "Bitter", "Brawler", "Bree Serif", "Buenard",
        "Cambo", "Cantata One", "Cardo", "Caudex", "Copse", "Coustard", "Crete Round", "Crimson Text", "Cutive", "Della Respira", "Droid Serif", "EB Garamond", "Enriqueta", "Esteban", "Fanwood Text", "Fjord One",
        "Gentium Basic", "Gentium Book Basic", "Glegoo", "Goudy Bookletter 1911", "Habibi", "Holtwood One SC", "IM Fell DW Pica", "IM Fell DW Pica SC", "IM Fell Double Pica", "IM Fell Double Pica SC",
        "IM Fell English", "IM Fell English SC", "IM Fell French Canon", "IM Fell French Canon SC", "IM Fell Great Primer", "IM Fell Great Primer SC", "Inika", "Italiana", "Josefin Slab", "Judson", "Junge",
        "Kameron", "Kotta One", "Kreon", "Ledger", "Linden Hill", "Lora", "Lusitana", "Lustria", "Marko One", "Mate", "Mate SC", "Merriweather", "Montaga", "Neuton", "Noticia Text", "Old Standard TT", "Ovo",
        "PT Serif", "PT Serif Caption", "Petrona", "Playfair Display", "Podkova", "Poly", "Port Lligat Slab", "Prata", "Prociono", "Quattrocento", "Radley", "Rokkitt", "Rosarivo", "Simonetta", "Sorts Mill Goudy",
        "Stoke", "Tienne", "Tinos", "Trocchi", "Trykker", "Ultra", "Unna", "Vidaloka", "Volkhov", "Vollkorn", "Abril Fatface", "Aguafina Script", "Aladin", "Alex Brush", "Alfa Slab One", "Allan", "Allura",
        "Amatic SC", "Annie Use Your Telescope", "Arbutus", "Architects Daughter", "Arizonia", "Asset", "Astloch", "Atomic Age", "Aubrey", "Audiowide", "Averia Gruesa Libre", "Averia Libre", "Averia Sans Libre",
        "Averia Serif Libre", "Bad Script", "Bangers", "Baumans", "Berkshire Swash", "Bigshot One", "Bilbo", "Bilbo Swash Caps", "Black Ops One", "Bonbon", "Boogaloo", "Bowlby One", "Bowlby One SC",
        "Bubblegum Sans", "Buda", "Butcherman", "Butterfly Kids", "Cabin Sketch", "Caesar Dressing", "Calligraffitti", "Carter One", "Cedarville Cursive", "Ceviche One", "Changa One", "Chango", "Chelsea Market",
        "Cherry Cream Soda", "Chewy", "Chicle", "Coda", "Codystar", "Coming Soon", "Concert One", "Condiment", "Contrail One", "Cookie", "Corben", "Covered By Your Grace", "Crafty Girls", "Creepster", "Crushed",
        "Damion", "Dancing Script", "Dawning of a New Day", "Delius", "Delius Swash Caps", "Delius Unicase", "Devonshire", "Diplomata", "Diplomata SC", "Dr Sugiyama", "Dynalight", "Eater", "Emblema One",
        "Emilys Candy", "Engagement", "Erica One", "Euphoria Script", "Ewert", "Expletus Sans", "Fascinate", "Fascinate Inline", "Federant", "Felipa", "Flamenco", "Flavors", "Fondamento", "Fontdiner Swanky",
        "Forum", "Fredericka the Great", "Fredoka One", "Frijole", "Fugaz One", "Geostar", "Geostar Fill", "Germania One", "Give You Glory", "Glass Antiqua", "Gloria Hallelujah", "Goblin One", "Gochi Hand",
        "Gorditas", "Graduate", "Gravitas One", "Great Vibes", "Gruppo", "Handlee", "Happy Monkey", "Henny Penny", "Herr Von Muellerhoff", "Homemade Apple", "Iceberg", "Iceland", "Indie Flower", "Irish Grover",
        "Italianno", "Jim Nightshade", "Jolly Lodger", "Julee", "Just Another Hand", "Just Me Again Down Here", "Kaushan Script", "Kelly Slab", "Kenia", "Knewave", "Kranky", "Kristi", "La Belle Aurore",
        "Lancelot", "League Script", "Leckerli One", "Lemon", "Lilita One", "Limelight", "Lobster", "Lobster Two", "Londrina Outline", "Londrina Shadow", "Londrina Sketch", "Londrina Solid",
        "Love Ya Like A Sister", "Loved by the King", "Lovers Quarrel", "Luckiest Guy", "Macondo", "Macondo Swash Caps", "Maiden Orange", "Marck Script", "Meddon", "MedievalSharp", "Medula One", "Megrim",
        "Merienda One", "Metamorphous", "Miltonian", "Miltonian Tattoo", "Miniver", "Miss Fajardose", "Modern Antiqua", "Monofett", "Monoton", "Monsieur La Doulaise", "Montez", "Mountains of Christmas",
        "Mr Bedfort", "Mr Dafoe", "Mr De Haviland", "Mrs Saint Delafield", "Mrs Sheppards", "Mystery Quest", "Neucha", "Niconne", "Nixie One", "Norican", "Nosifer", "Nothing You Could Do", "Nova Cut",
        "Nova Flat", "Nova Mono", "Nova Oval", "Nova Round", "Nova Script", "Nova Slim", "Nova Square", "Oldenburg", "Oleo Script", "Original Surfer", "Over the Rainbow", "Overlock", "Overlock SC", "Pacifico",
        "Parisienne", "Passero One", "Passion One", "Patrick Hand", "Patua One", "Permanent Marker", "Piedra", "Pinyon Script", "Plaster", "Playball", "Poiret One", "Poller One", "Pompiere", "Press Start 2P",
        "Princess Sofia", "Prosto One", "Qwigley", "Raleway", "Rammetto One", "Rancho", "Redressed", "Reenie Beanie", "Revalia", "Ribeye", "Ribeye Marrow", "Righteous", "Rochester", "Rock Salt", "Rouge Script",
        "Ruge Boogie", "Ruslan Display", "Ruthie", "Sail", "Salsa", "Sancreek", "Sansita One", "Sarina", "Satisfy", "Schoolbell", "Seaweed Script", "Sevillana", "Shadows Into Light", "Shadows Into Light Two",
        "Share", "Shojumaru", "Short Stack", "Sirin Stencil", "Slackey", "Smokum", "Smythe", "Sniglet", "Sofia", "Sonsie One", "Special Elite", "Spicy Rice", "Spirax", "Squada One", "Stardos Stencil",
        "Stint Ultra Condensed", "Stint Ultra Expanded", "Sue Ellen Francisco", "Sunshiney", "Supermercado One", "Swanky and Moo Moo", "Tangerine", "The Girl Next Door", "Titan One", "Trade Winds", "Trochut",
        "Tulpen One", "Uncial Antiqua", "UnifrakturCook", "UnifrakturMaguntia", "Unkempt", "Unlock", "VT323", "Vast Shadow", "Vibur", "Voces", "Waiting for the Sunrise", "Wallpoet", "Walter Turncoat",
        "Wellfleet", "Yellowtail", "Yeseva One", "Yesteryear", "Zeyada");
    return $cs_fonts;
}

// enqueue timepicker scripts

function cs_enqueue_timepicker_script() {
    //if(is_admin()){
    wp_enqueue_script('datetimepicker1_js', get_template_directory_uri() . '/include/assets/scripts/jquery_datetimepicker.js', '', '', true);
    wp_enqueue_style('datetimepicker1_css', get_template_directory_uri() . '/include/assets/css/jquery_datetimepicker.css');

    //}
}

add_action('admin_enqueue_scripts', 'cs_my_admin_scripts');

// enqueue admin scripts
function cs_my_admin_scripts() {
    if (isset($_GET['page']) && $_GET['page'] == 'my_plugin_page') {
        wp_enqueue_media();
        wp_register_script('my-admin-js', WP_PLUGIN_URL . '/my-plugin/my-admin.js', array('jquery'));
        wp_enqueue_script('my-admin-js');
    }
}

// register theme menu
function cs_register_my_menus() {
    register_nav_menus(
            array(
                'main-menu' => __('Main Menu', 'goalklub'),
            )
    );
}

add_action('init', 'cs_register_my_menus');

//  Set Post Veiws Start
if (!function_exists('cs_set_post_views')) {

    function cs_set_post_views($postID) {
        //   $visited = get_transient($key); //get transient and store in variable
        if (!isset($_COOKIE["cs_count_views" . $postID])) {
            setcookie("cs_count_views" . $postID, 'post_view_count', time() + 86400);
            //  set_transient( $key, $value, 60*60*12);
            $count_key = 'cs_count_views';
            $count = get_post_meta($postID, $count_key, true);
            if ($count == '') {
                $count = 0;
                delete_post_meta($postID, $count_key);
                add_post_meta($postID, $count_key, '0');
            } else {
                $count++;
                update_post_meta($postID, $count_key, $count);
            }
        }
    }

}
//  Set Post Veiws End
//  Get Post Veiws Start
if (!function_exists('cs_get_post_views')) {

    function cs_get_post_views($postID) {
        $count_key = 'cs_count_views';
        $count = get_post_meta($postID, $count_key, true);
        if ($count == '') {
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return "0 ";
        }
        return number_format($count);
    }

}

//  Get Post Veiws End
//  Excerpt Default Length 
function cs_custom_excerpt_length($length) {
    return 200;
}

add_filter('excerpt_length', 'cs_custom_excerpt_length');
// Custom excerpt function 
if (!function_exists('cs_get_the_excerpt')) {

    function cs_get_the_excerpt($charlength = '255', $readmore = 'true', $readmore_text = 'Read More') {
        global $post, $cs_theme_option;
        $excerpt = trim(preg_replace('/<a[^>]*>(.*)<\/a>/iU', '', get_the_excerpt()));
        if (strlen($excerpt) > $charlength) {
            /* 			$subex = mb_substr( $excerpt, 0, $charlength - 5 );
              $exwords = explode( ' ', $subex );
              $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) ); */
            if ($charlength > 0) {
                $excerpt = substr($excerpt, 0, $charlength);
            } else {
                $excerpt = $excerpt;
            }
            if ($readmore == 'true') {
                $more = '... <a href="' . get_permalink() . '" class="cs-read-more colr"><i class="icon-caret-right"></i>' . $readmore_text . '</a>';
            } else {
                $more = '...';
            }
            return $excerpt . $more;
        } else {
            return $excerpt;
        }
    }

}
/* Excerpt Read More  */

function cs_excerpt_more($more = '...') {
    return '....';
}

add_filter('excerpt_more', 'cs_excerpt_more');

//=====================================================================
// Blog filtering methods
//=====================================================================
function cs_get_blog_filters($cs_blog_cat, $author_filter, $filter_category, $filter_tag, $cs_blog_filterable, $cs_custom_animation) {
    global $post, $cs_theme_options, $cs_counter_node, $wpdb;
    $nav_count = rand(40, 9999999);
    if (isset($cs_blog_filterable) && $cs_blog_filterable == 'yes') {
        ?>
        <!--Sorting Navigation-->
        <div class="col-md-12">
            <nav class="wow filter-nav <?php echo cs_allow_special_char($cs_custom_animation); ?>">
                <ul class="cs-filter-menu pull-left">
                    <li> <a href="#pager-1<?php echo cs_allow_special_char($nav_count); ?>"> <i class="icon-search"></i><?php _e('Filter By', 'goalklub'); ?>
                        </a> </li>
                    <li><a href="#pager-2<?php echo cs_allow_special_char($nav_count); ?>"><i class="icon-list"></i><?php
                    _e('Categories', 'goalklub');
                    ?></a></li>
                    <li><a href="#pager-3<?php echo cs_allow_special_char($nav_count); ?>"><i class="icon-tags"></i><?php
            _e('Tags', 'goalklub');
            ?></a></li>
                    <li><a href="#pager-4<?php echo cs_allow_special_char($nav_count); ?>"><i class="icon-user"></i><?php
                    _e('Author', 'goalklub');
                    ?></a></li>
                </ul>
                <a href="<?php the_permalink(); ?>" class="pull-right cs-btnshowall"> <i class="icon-check-circle-o"></i> 
                       <?php _e('Show All', 'goalklub'); ?>
                </a>
                <div id="pager-1<?php echo cs_allow_special_char($nav_count); ?>" class="filter-pager" style="display: none;"> 
                    <a class="<?php
                    if (isset($_GET['sort']) and $_GET['sort'] == 'asc') {
                        echo 'active';
                    }
                    ?>" href="?<?php echo 'by_author=' . $author_filter . '&amp;sort=asc&amp;filter_category=' . $filter_category . '&amp;filter-tag=' . $filter_tag; ?>"> <?php _e('Date Published', 'goalklub'); ?> </a>
                    <a class="<?php
                       if (isset($_GET['sort']) and $_GET['sort'] == 'alphabetical') {
                           echo 'active';
                       }
                       ?>" href="?<?php echo 'by_author=' . $author_filter . '&amp;sort=alphabetical&amp;filter_category=' . $filter_category . '&amp;filter_tag=' . $filter_tag; ?>"> <?php _e('Alphabetical', 'goalklub'); ?> </a> </div>
                <div id="pager-2<?php echo cs_allow_special_char($nav_count); ?>" class="filter-pager" style="display: none;">
                       <?php
                       $row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $cs_blog_cat));
                       if (isset($cs_blog_cat) && ($cs_blog_cat <> "" && $cs_blog_cat <> "0") && isset($row_cat->term_id)) {
                           $categories = get_categories(array('child_of' => "$row_cat->term_id", 'taxonomy' => 'category', 'hide_empty' => 1));
                           ?>
                        <a href="?<?php echo 'by_author=' . $author_filter . '&amp;filter_category=' . $filter_category; ?>" class="<?php
                           if (($cs_blog_cat == $filter_category)) {
                               echo 'bgcolr';
                           }
                           ?>"><?php _e('All Categories', 'goalklub'); ?></a>
            <?php
        } else {
            $categories = get_categories(array('taxonomy' => 'category', 'hide_empty' => 1));
        }
        foreach ($categories as $category) {
            ?>
                        <a href="?<?php echo "by_author=" . $author_filter . "&amp;filter_category=" . $category->slug ?>" 
                        <?php
                        if ($category->slug == $filter_category) {
                            echo 'class="active"';
                        }
                        ?>> <?php echo cs_allow_special_char($category->cat_name); ?> </a>
                    <?php } ?>
                </div>
                <div id="pager-3<?php echo cs_allow_special_char($nav_count); ?>" class="filter-pager" style="display: none;">
                    <?php cs_get_post_tags_list($filter_category, $filter_tag, $author_filter); ?>
                </div>
                <div id="pager-4<?php echo cs_allow_special_char($nav_count); ?>" class="filter-pager" style="display: none;">
                        <?php
                        $user_ids = get_users(array(
                            'fields' => 'all',
                            'orderby' => 'post_count',
                            'order' => 'DESC',
                            'who' => 'authors',
                        ));
                        foreach ($user_ids as $user) {
                            $post_count = count_user_posts($user->ID);
                            // Move on if user has not published a post (yet).
                            if ($post_count) {
                                ?>
                            <a <?php
                if (isset($_GET['by_author']) && $user->ID == $_GET['by_author']) {
                    echo 'class="active"';
                }
                ?> href="?<?php echo 'by_author=' . $user->ID . '&amp;filter_category=' . $filter_category . '&amp;filter_tag=' . $filter_tag; ?>"> <?php echo cs_allow_special_char($user->display_name); ?> </a>
                <?php
            }
        }
        ?> 
                </div>
            </nav>
        </div>
        <!--Sorting Navigation End-->
        <?php
    }
}

//=====================================================================
// Get Post tags list
//=====================================================================
function cs_get_post_tags_list($filter_category = '', $filter_tag = '', $author_filter = '') {
    global $post;
    $args = array('posts_per_page' => -1, 'post_type' => 'post', 'catgory' => $filter_category);
    $project_query = new WP_Query($args);
    while ($project_query->have_posts()) : $project_query->the_post();
        $posttags = get_the_terms($post->ID, 'post_tag');
        if ($posttags) {
            foreach ($posttags as $tag) {
                $all_tags_arr[] = $tag->name; //USING JUST $tag MAKING $all_tags_arr A MULTI-DIMENSIONAL ARRAY, WHICH DOES WORK WITH array_unique
            }
        }
    endwhile;
    wp_reset_query();
    if (is_array($all_tags_arr) && count($all_tags_arr) > 0):
        $tags_arr = array_unique($all_tags_arr); //REMOVES DUPLICATES
        foreach ($tags_arr as $tag):
            $active_class = '';
            $el = get_term_by('name', $tag, 'post_tag');
            $arr[] = '"tag-' . $el->slug . '"';
            if ($filter_tag == $el->slug) {
                $active_class = "class='active'";
            }

            echo '<a href="?by_author=' . $author_filter . '&amp;filter_category=' . $filter_category . '&amp;filter-tag=' . $el->slug . '" id="taglink-tag-' . $el->slug . '" title="tag-' . $el->slug . '" ' . $active_class . ' >' . $el->name . '</a>';
        endforeach;
    endif;
}

function cs_remove_menu_ids() {
    add_filter('nav_menu_item_id', '__return_null');
}

add_action('init', 'cs_remove_menu_ids');

// Return Seleced
if (!function_exists('cs_selected')) {

    function cs_selected($current, $orignal) {
        if ($current == $orignal) {
            echo 'selected=selected';
        }
    }

}

// page builder element size
if (!function_exists('cs_pb_element_sizes')) {

    function cs_pb_element_sizes($size = '100') {
        $element_size = 'element-size-100';
        if (isset($size) && $size == '') {
            $element_size = 'element-size-100';
        } else {
            $element_size = 'element-size-' . $size;
        }
        return $element_size;
    }

}


if (!function_exists('enable_more_buttons')) {

    function cs_enable_more_buttons($buttons) {

        $buttons[] = 'fontselect';
        $buttons[] = 'fontsizeselect';
        $buttons[] = 'styleselect';
        $buttons[] = 'backcolor';
        $buttons[] = 'newdocument';
        $buttons[] = 'cut';
        $buttons[] = 'copy';
        $buttons[] = 'charmap';
        $buttons[] = 'hr';
        $buttons[] = 'visualaid';

        return $buttons;
    }

    add_filter("mce_buttons_3", "cs_enable_more_buttons");
}
add_action('init', 'cs_my_deregister_heartbeat', 1);

function cs_my_deregister_heartbeat() {
    global $pagenow;

    if ('post.php' != $pagenow && 'post-new.php' != $pagenow)
        if(function_exists('cs_wp_der_script')){
            cs_wp_der_script('heartbeat');
        }
}

// Like Counter
if (!function_exists('cs_like_counter')) {

    function cs_like_counter($cs_likes_title = '') {
        $cs_like_counter = '';
        $cs_like_counter = get_post_meta(get_the_id(), "cs_like_counter", true);
        if (!isset($cs_like_counter) or empty($cs_like_counter))
            $cs_like_counter = 0;
        if (isset($_COOKIE["cs_like_counter" . get_the_id()])) {
            ?>
            <a> <i class="icon-heart liked-post"></i><span><?php echo cs_allow_special_char($cs_like_counter . ' ' . $cs_likes_title); ?></span></a> 
        <?php } else { ?>
            <a class="likethis<?php echo get_the_id() ?> cs-btnheart cs-btnpopover" id="like_this<?php echo get_the_id() ?>"  href="javascript:cs_like_counter('<?php echo get_template_directory_uri() ?>',<?php echo get_the_id() ?>,'<?php echo cs_allow_special_char($cs_likes_title); ?>','<?php echo admin_url('admin-ajax.php'); ?>')" data-container="body" data-toggle="tooltip" data-placement="top" title="<?php _e('Like This', 'goalklub'); ?>"><i class="icon-heart-o"></i><span><?php echo cs_allow_special_char($cs_like_counter . ' ' . $cs_likes_title); ?></span></a>

            <a class="likes likethis" id="you_liked<?php echo get_the_id() ?>" style="display:none;"><i class="icon-heart  liked-post"></i><span class="count-numbers like_counter<?php echo get_the_id() ?>"><?php echo cs_allow_special_char($cs_like_counter . ' ' . $cs_likes_title); ?></span> </a>

            <div id="loading_div<?php echo get_the_id() ?>" style="display:none;"><i class="icon-spinner icon-spin"></i></div>
            <?php
        }
    }

    //likes counter
    add_action('wp_ajax_nopriv_cs_likes_count', 'cs_likes_count');
    add_action('wp_ajax_cs_likes_count', 'cs_likes_count');
}
// Post like counter
if (!function_exists('cs_likes_count')) {

    function cs_likes_count() {

        $cs_like_counter = get_post_meta($_POST['post_id'], "cs_like_counter", true);
        if (!isset($_COOKIE["cs_like_counter" . $_POST['post_id']])) {
            setcookie("cs_like_counter" . $_POST['post_id'], 'true', time() + (10 * 365 * 24 * 60 * 60), '/');
            update_post_meta($_POST['post_id'], 'cs_like_counter', $cs_like_counter + 1);
        }
        $cs_like_counter = get_post_meta($_POST['post_id'], "cs_like_counter", true);
        if (!isset($cs_like_counter) or empty($cs_like_counter))
            $cs_like_counter = 0;
        echo cs_allow_special_char($cs_like_counter);
        die();
    }

}
//Mailchimp
add_action('wp_ajax_nopriv_cs_mailchimp', 'cs_mailchimp');
add_action('wp_ajax_cs_mailchimp', 'cs_mailchimp');

function cs_mailchimp() {
    global $cs_theme_options, $counter;
    $mailchimp_key = '';
    if (isset($cs_theme_options['cs_mailchimp_key'])) {
        $mailchimp_key = $cs_theme_options['cs_mailchimp_key'];
    }
    if (isset($_POST) and ! empty($_POST['cs_list_id']) and $mailchimp_key != '') {
        if ($mailchimp_key <> '') {
            $MailChimp = new MailChimp($mailchimp_key);
        }
        $email = $_POST['mc_email'];
        $list_id = $_POST['cs_list_id'];
        $result = $MailChimp->call('lists/subscribe', array(
            'id' => $list_id,
            'email' => array('email' => $email),
            'merge_vars' => array(),
            'double_optin' => false,
            'update_existing' => false,
            'replace_interests' => false,
            'send_welcome' => true,
        ));
        if ($result <> '') {
            if (isset($result['status']) and $result['status'] == 'error') {
                echo cs_allow_special_char($result['error']);
            } else {
                echo 'subscribe successfully';
            }
        }
    } else {
        echo 'please set API key';
    }
    die();
}

// Add SoundCloud oEmbed
function cs_add_oembed_soundcloud() {
    wp_oembed_add_provider('http://soundcloud.com/*', 'http://api.soundcloud.com/');
}

//Mailchimp
/**
 * Add TinyMCE to multiple Textareas (usually in backend).
 */
function cs_wp_editor($id = '') {
    ?>
    <script type="text/javascript">
        var fullId = "<?php echo cs_allow_special_char($id); ?>";

        //tinymce.execCommand('mceAddEditor', false, fullId);
        // use wordpress settings
        tinymce.init({
            selector: fullId,
            theme: "modern",
            skin: "lightgray",
            language: "en",
            selector:"#" + fullId,
                    resize: "vertical",
            menubar: false,
            wpautop: true,
            indent: false,
            quicktags: "em,strong,link",
            toolbar1: "bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink",
            //toolbar2:"formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help",
            tabfocus_elements: ":prev,:next",
            body_class: "id post-type-post post-status-publish post-format-standard",
        });

        //quicktags({id : fullId});
        settings = {
            id: fullId,
            // buttons: 'strong,em,link' 
        }

        quicktags(settings);
        //init tinymce
        //tinymce.init(tinyMCEPreInit.mceInit[fullId]);

        //quicktags({id : fullId});
        /*tinymce.execCommand('mceRemoveEditor', true, fullId);
         var init = tinymce.extend( {}, tinyMCEPreInit.mceInit[ fullId ] );
         try { tinymce.init( init ); } catch(e){}
         
         tinymce.execCommand( 'mceRemoveEditor', false, fullId );
         tinymce.execCommand( 'mceAddEditor', false, fullId );
         
         quicktags({id : fullId});*/
    </script><?php
}

add_action('wp_ajax_cs_select_editor', 'cs_wp_editor');


//Submit Form
add_action('wp_ajax_nopriv_cs_contact_form_submit', 'cs_contact_form_submit');
add_action('wp_ajax_cs_contact_form_submit', 'cs_contact_form_submit');

// Custom File types allowed
add_filter('upload_mimes', 'cs_custom_upload_mimes');

function cs_custom_upload_mimes($existing_mimes = array()) {

    // add the file extension to the array

    $existing_mimes['woff'] = 'mime/type';
    $existing_mimes['ttf'] = 'mime/type';
    $existing_mimes['svg'] = 'mime/type';
    $existing_mimes['eot'] = 'mime/type';

    return $existing_mimes;
}

// Contact form submit ajax
if (!function_exists('cs_contact_form_submit')) :

    function cs_contact_form_submit() {
        define('WP_USE_THEMES', false);
        $subject = '';
        $cs_contact_error_msg = '';
        $cs_contact_email = '';
        $subject_name = 'Subject';
        foreach ($_REQUEST as $keys => $values) {
            $$keys = esc_attr($values);
        }
        if (isset($phone) && $phone <> '') {
            $subject_name = 'Phone';
            $subject = $phone;
        }
        $bloginfo = get_bloginfo();
        $subjecteEmail = "(" . $bloginfo . ") Contact Form Received";
        $global_REMOTE_ADDR = '';
        if(function_exist('cs_glob_server')){
            $global_REMOTE_ADDR = cs_glob_server('REMOTE_ADDR');
        }
        $message = '
				<table width="100%" border="1">
				  <tr>
					<td width="100"><strong>Name:</strong></td>
					<td>' . esc_attr($contact_name) . '</td>
				  </tr>
				  <tr>
					<td><strong>Email:</strong></td>
					<td>' . sanitize_email($contact_email) . '</td>
				  </tr>
				  <tr>
					<td><strong>' . $subject_name . ':</strong></td>
					<td>' . esc_attr($subject) . '</td>
				  </tr>
				  <tr>
					<td><strong>Message:</strong></td>
					<td>' . force_back($contact_msg, true) . '</td>
				  </tr>
				  <tr>
					<td><strong>IP Address:</strong></td>
					<td>' . $global_REMOTE_ADDR . '</td>
				  </tr>
				</table>';
        $headers = "From: " . esc_attr($contact_name) . "\r\n";
        $headers .= "Reply-To: " . sanitize_email($contact_email) . "\r\n";
        $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $attachments = '';
        $mail_check = false;
        if(function_exists('cs_mail')){
            $mail_check = cs_mail($cs_contact_email, $subjecteEmail, $message, $headers, $attachments);
        }
        if ($mail_check) {

            $json = array();
            $json['type'] = "success";
            $json['message'] = '<p>' . cs_textarea_filter($cs_contact_succ_msg) . '</p>';
        } else {
            $json['type'] = "error";
            $json['message'] = '<p>' . cs_textarea_filter($cs_contact_error_msg) . '</p>';
        };

        echo json_encode($json);
        die();
    }

endif;

// Get user profile picture 
if (!function_exists('cs_admin_user_profile_picture_ajax')) {

    function cs_admin_user_profile_picture_ajax() {
        $picture_class = $user_id = '';
        if (isset($_POST['picture_class']))
            $picture_class = $_POST['picture_class'];
        if (isset($_POST['user_id']))
            $user_id = $_POST['user_id'];

        $update_meta = update_user_meta($user_id, 'user_avatar_display', '');
        if ($update_meta) {
            echo get_avatar(get_the_author_meta('user_email', $user_id), apply_filters('CS_author_bio_avatar_size', 134));
        } else {
            echo 'error';
        }
        exit;
    }

    add_action('wp_ajax_cs_admin_user_profile_picture_ajax', 'cs_admin_user_profile_picture_ajax');
}

/**
 *
 * @ Header Positions
 *
 * */
if (!function_exists('cs_header_position_settings')) :

    function cs_header_position_settings() {
        global $cs_xmlObject, $cs_theme_options;
        // header setting start
        if (is_page() || is_single()) {
            $header_bg_options = (isset($cs_xmlObject) and $cs_xmlObject->header_bg_options <> '') ? $cs_xmlObject->header_bg_options : '';
            $cs_rev_slider_id = (isset($cs_xmlObject) and $cs_xmlObject->cs_rev_slider_id <> '') ? $cs_xmlObject->cs_rev_slider_id : '';
            $cs_header_bg_image = (isset($cs_xmlObject) and $cs_xmlObject->cs_headerbg_image <> '') ? $cs_xmlObject->cs_headerbg_image : '';
            $cs_header_bg_color = (isset($cs_xmlObject) and $cs_xmlObject->cs_headerbg_color <> '') ? $cs_xmlObject->cs_headerbg_color : '';
        } else {
            $header_bg_options = (isset($cs_theme_options['cs_headerbg_options']) and $cs_theme_options['cs_headerbg_options'] <> '') ? $cs_theme_options['cs_headerbg_options'] : '';
            $cs_rev_slider_id = (isset($cs_theme_options['cs_headerbg_slider']) and $cs_theme_options['cs_headerbg_slider'] <> '') ? $cs_theme_options['cs_headerbg_slider'] : '';
            $cs_header_bg_image = (isset($cs_theme_options['cs_headerbg_image']) and $cs_theme_options['cs_headerbg_image'] <> '') ? $cs_theme_options['cs_headerbg_image'] : '';
            $cs_header_bg_color = (isset($cs_theme_options['cs_headerbg_color']) and $cs_theme_options['cs_headerbg_color'] <> '') ? $cs_theme_options['cs_headerbg_color'] : '';
        }
        // header setting end
        if ($cs_theme_options['cs_header_position'] == 'absolute' and ( isset($header_bg_options) and $header_bg_options <> '' and $header_bg_options != 'none')) {
            ?>
            <div class="extra">
            <?php if ($header_bg_options == 'cs_bg_image_color') { ?>
                    <style scoped>
                        #main-header{
                            background-image:url('<?php echo esc_url($cs_header_bg_image); ?>') !important;
                            background-color:<?php echo esc_attr($cs_header_bg_color); ?>;
                            min-height:250px;
                        }
                    </style>
                <?php
            } elseif ($header_bg_options == 'cs_rev_slider') {
                echo do_shortcode('[rev_slider ' . $cs_rev_slider_id . ']');
            }
            ?>
            </div>
            <?php
        }
    }

endif;

/* Start function for RevSlider Extend Class
 */
if (class_exists('RevSlider')) {

    class cs_RevSlider extends RevSlider {
        /*
         * Get sliders alias, Title, ID
         */

        public function getAllSliderAliases() {
            $arrAliases = array();
            $slider_array = array();

            $slider = new RevSlider();

            if (method_exists($slider, "get_sliders")) {
                $slider = new RevSlider();
                $objSliders = $slider->get_sliders();

                foreach ($objSliders as $arrSlider) {
                    $arrAliases['id'] = $arrSlider->id;
                    $arrAliases['title'] = $arrSlider->title;
                    $arrAliases['alias'] = $arrSlider->alias;
                    $slider_array[] = $arrAliases;
                }
            } else {
                $where = "";
                $response = $this->db->fetch(GlobalsRevSlider::$table_sliders, $where, "id");
                foreach ($response as $arrSlider) {
                    $arrAliases['id'] = $arrSlider["id"];
                    $arrAliases['title'] = $arrSlider["title"];
                    $arrAliases['alias'] = $arrSlider["alias"];
                    $slider_array[] = $arrAliases;
                }
            }
            return($slider_array);
        }

    }

}

// End function for RevSlider Extend Class
if (!function_exists('cs_get_attachment_id_by_url')) :

    function cs_get_attachment_id_by_url($url) {
        // Split the $url into two parts with the wp-content directory as the separator
        $parsed_url = explode(parse_url(WP_CONTENT_URL, PHP_URL_PATH), $url);
        // Get the host of the current site and the host of the $url, ignoring www
        $this_host = str_ireplace('www.', '', parse_url(home_url(), PHP_URL_HOST));
        $file_host = str_ireplace('www.', '', parse_url($url, PHP_URL_HOST));
        // Return nothing if there aren't any $url parts or if the current host and $url host do not match
        if (!isset($parsed_url[1]) || empty($parsed_url[1]) || ( $this_host != $file_host )) {
            return;
        }

        global $wpdb;
        $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $parsed_url[1]));
        // Returns null if no attachment is found
        return $attachment[0];
    }

endif;

//Locations callback (Removing Location Meta Box)
add_action('admin_menu', 'cs_match_location_callback');
if (!function_exists('cs_match_location_callback')) {

    function cs_match_location_callback() {
        remove_meta_box('tagsdiv-match-location', 'match', 'side');
    }

}

//add extra fields to Point Table categories
add_action('pointtable-category_edit_form_fields', 'cs_edit_cs_extra_pointtable_category_fields');
add_action('pointtable-category_add_form_fields', 'cs_extra_pointtable_category_fields');

// Add Category Fields
if (!function_exists('cs_extra_pointtable_category_fields')) :

    function cs_extra_pointtable_category_fields($tag) {    //check for existing featured ID
        if (isset($tag->term_id)) {
            $t_id = $tag->term_id;
        } else {
            $t_id = "";
        }
        $pointtable_cat_icon = '';
        ?>
        <div class="form-field">
            <label for="">Choose Icon</label>
        <?php cs_fontawsome_icons_box_cat($pointtable_cat_icon, $t_id, 'pointtable_cat'); ?>

            <p>Icon for Point Table Category</p>
        </div>
        <input type="hidden" name="pointtable_cat_meta" value="1" />
        <?php
    }

endif;


// Edit Category Fields
if (!function_exists('cs_edit_cs_extra_pointtable_category_fields')) :

    function cs_edit_cs_extra_pointtable_category_fields($tag) {    //check for existing featured ID
        if (isset($tag->term_id)) {
            $t_id = $tag->term_id;
        } else {
            $t_id = "";
        }
        $cat_meta = get_option("pointtable_cat_$t_id");
        $pointtable_cat_icon = isset($cat_meta['icon']) ? $cat_meta['icon'] : '';
        ?>
        <tr>

        <?php $box_name = 'pointtable_cat'; ?>
            <th><label for="cat_f_icon_url">Choose Icon</label></th>
            <td>
        <?php cs_fontawsome_icons_box_cat($pointtable_cat_icon, $t_id, 'pointtable_cat'); ?>
                <p>Icon for Point Table Category</p>
            </td>
        </tr>
        <input type="hidden" name="pointtable_cat_meta" value="1" />
        <?php
    }

endif;

// save cousres categories extra fields hook
add_action('create_pointtable-category', 'cs_save_pointtable_extra_category_fileds');
add_action('edited_pointtable-category', 'cs_save_pointtable_extra_category_fileds');

// save extra category extra fields callback function
if (!function_exists('cs_save_pointtable_extra_category_fileds')) :

    function cs_save_pointtable_extra_category_fileds($term_id) {

        if (isset($_POST['pointtable_cat_meta']) and $_POST['pointtable_cat_meta'] == '1') {
            $t_id = $term_id;
            $pointtable_cat_icon = '';
            if (isset($_POST['pointtable_cat'])) {
                $pointtable_cat_icon = $_POST['pointtable_cat'];
            }
            $cat_meta = array(
                'icon' => $pointtable_cat_icon,
            );
            //save the option array
            update_option("pointtable_cat_$t_id", $cat_meta);
        }
    }

endif;

//add extra fields to Team categories
add_action('player-team_edit_form_fields', 'cs_edit_cs_extra_category_fields');
add_action('player-team_add_form_fields', 'cs_extra_category_fields');

// Add Category Fields
if (!function_exists('cs_extra_category_fields')) :

    function cs_extra_category_fields($tag) {    //check for existing featured ID
        if (isset($tag->term_id)) {
            $t_id = $tag->term_id;
        } else {
            $t_id = "";
        }
        $team_image = '';
        ?>

        <div class="form-field">
            <ul class="form-elements" style="margin:0; padding:0;">
                <li class="to-field" style="width:100%;">
                    <label style="width:100%;">Image</label>
                    <input id="team_image<?php echo esc_attr($t_id) ?>" name="team_image" type="hidden" class="" value="<?php echo esc_url($team_image); ?>"/>
                    <label class="browse-icon"><input name="team_image<?php echo esc_attr($t_id) ?>"  type="button" class="uploadMedia left" value="<?php _e('Browse', 'goalklub'); ?>"/></label>
                    <div class="page-wrap" style="overflow:hidden; display:<?php echo esc_attr($team_image) && trim($team_image) != '' ? 'inline' : 'none'; ?>" id="team_image<?php echo esc_attr($t_id) ?>_box" >
                        <div class="gal-active" style="padding-left:0 !important;">
                            <div class="dragareamain" style="padding-bottom:0px;">
                                <ul id="gal-sortable" style="width:200px;">
                                    <li class="ui-state-default" id="">
                                        <div class="thumb-secs"> <img src="<?php echo esc_url($team_image); ?>"  id="team_image<?php echo esc_attr($t_id); ?>_img" width="200" />
                                            <div class="gal-edit-opts"> <a   href="javascript:del_media('team_image<?php echo esc_attr($t_id); ?>')" class="delete"></a> </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </li>
            </ul>

            <p>Image for Team</p>
        </div>
        <input type="hidden" name="team_image_meta" value="1" />
        <?php
    }

endif;

// Edit Category Fields
if (!function_exists('cs_edit_cs_extra_category_fields')) :

    function cs_edit_cs_extra_category_fields($tag) {    //check for existing featured ID
        if (isset($tag->term_id)) {
            $t_id = $tag->term_id;
        } else {
            $t_id = "";
        }
        $cs_counter = $tag->term_id;
        $cat_meta = get_option("team_image_$t_id");
        $team_image = $cat_meta['icon'];
        ?>
        <tr>
            <th><label for="cat_f_icon_url">Choose Icon</label></th>
            <td>
                <ul class="form-elements" style="margin:0; padding:0;">
                    <li class="to-field" style="width:100%;">
                        <label style="width:100%;">Image</label>
                        <input id="team_image<?php echo esc_attr($cs_counter) ?>" name="team_image" type="hidden" class="" value="<?php echo esc_url($team_image); ?>"/>
                        <label class="browse-icon"><input name="team_image<?php echo esc_attr($cs_counter) ?>"  type="button" class="uploadMedia left" value="<?php _e('Browse', 'goalklub'); ?>"/></label>
                        <div class="page-wrap" style="overflow:hidden; display:<?php echo esc_attr($team_image) && trim($team_image) != '' ? 'inline' : 'none'; ?>" id="team_image<?php echo esc_attr($cs_counter) ?>_box" >
                            <div class="gal-active" style="padding-left:0 !important;">
                                <div class="dragareamain" style="padding-bottom:0px;">
                                    <ul id="gal-sortable" style="width:200px;">
                                        <li class="ui-state-default" id="">
                                            <div class="thumb-secs"> <img src="<?php echo esc_url($team_image); ?>"  id="team_image<?php echo esc_attr($cs_counter); ?>_img" width="200" />
                                                <div class="gal-edit-opts"> <a href="javascript:del_media('team_image<?php echo esc_attr($cs_counter); ?>')" class="delete"></a> </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </li>
                </ul>

                <p>Image for Team</p>
            </td>
        </tr>
        <input type="hidden" name="team_image_meta" value="1" />
        <?php
    }

endif;

// save Team image extra fields hook
add_action('create_player-team', 'cs_save_extra_category_fileds');
add_action('edited_player-team', 'cs_save_extra_category_fileds');

// save extra category extra fields callback function
if (!function_exists('cs_save_extra_category_fileds')) :

    function cs_save_extra_category_fileds($term_id) {
        if (isset($_POST['team_image_meta']) and $_POST['team_image_meta'] == '1') {
            $t_id = $term_id;
            get_option("team_image_$t_id");
            $team_image_icon = '';
            if (isset($_POST['team_image'])) {
                $team_image_icon = $_POST['team_image'];
            }
            $cat_meta = array(
                'icon' => $team_image_icon,
            );
            //save the option array
            update_option("team_image_$t_id", $cat_meta);
        }
    }

endif;


/*
 * Add to Team init functions
 */

add_filter("manage_edit-match-location_columns", 'cs_custom_taxonomy_columns');
add_filter("manage_edit-player-department_columns", 'cs_custom_taxonomy_columns');
add_filter("manage_edit-player-team_columns", 'cs_team_taxonomy_columns');

function cs_custom_taxonomy_columns($theme_columns) {
    $new_columns = array(
        'cb' => '<input type="checkbox" />',
        'name' => __('Name', 'goalklub'),
        'slug' => __('Slug', 'goalklub'),
    );
    return $new_columns;
}

function cs_team_taxonomy_columns($theme_columns) {
    $new_columns = array(
        'cb' => '<input type="checkbox" />',
        'image' => __('Image', 'goalklub'),
        'name' => __('Name', 'goalklub'),
        'slug' => __('Slug', 'goalklub'),
    );
    return $new_columns;
}

add_action('admin_head', 'cs_remove_default_category_description');

function cs_remove_default_category_description() {

    $current_screen = isset($_GET['taxonomy']) ? $_GET['taxonomy'] : '';

    if ($current_screen == 'match-location' || $current_screen == 'player-team' || $current_screen == 'player-department') {
        ?>
        <script type="text/javascript">
            jQuery(function ($) {
                $('textarea#description').closest('tr.form-field').remove();
                $('textarea#tag-description').closest('div.form-field').remove();
                //
                $('select#parent').closest('tr.form-field').remove();
                $('select#parent').closest('div.form-field').remove();
                //
                $('select#parent').closest('tr.form-field').remove();
                $('select#parent').closest('div.form-field').remove();
            });
        </script>
        <?php
    }
}

function cs_add_team_image_column_fields($deprecated, $column_name, $term_id) {
    if ($column_name == 'image') {
        $team_image = get_option("team_image_$term_id");
        if (!empty($team_image)) {
            $team_image_id = cs_get_attachment_id_by_url($team_image['icon']);
            if (!empty($team_image_id)) {
                $team_image_src = cs_attachment_image_src($team_image_id, get_option('thumbnail_size_w'), get_option('thumbnail_size_h'));
                echo '<img src="' . $team_image_src . '" alt="' . $term_id . '" width="60" />';
            }
        }
    }
}

add_action('manage_player-team_custom_column', 'cs_add_team_image_column_fields', 10, 3);
//=====================================================================
// User Profile Custom Fields
//=====================================================================
if (!function_exists('cs_profile_fields')) {

    function cs_profile_fields($userid) {
        $userfields['tagline'] = 'Tag Line';
        ;
        $userfields['mobile'] = 'Mobile';
        $userfields['landline'] = 'Landline';
        $userfields['fax'] = 'Fax';
        $userfields['facebook'] = 'Facebook';
        $userfields['twitter'] = 'Twitter';
        $userfields['linkedin'] = 'Linkedin';
        $userfields['pinterest'] = 'Pinterest';
        $userfields['google_plus'] = 'Google Plus';
        $userfields['instagram'] = 'Instagram';
        $userfields['skype'] = 'Skype';
        $userfields['address'] = 'Home Address';
        return $userfields;
    }

}

// news ticker enqueue style and script
function cs_enqueue_newsticker() {
    wp_enqueue_script('jquery.newsticker_js', get_template_directory_uri() . '/assets/scripts/news-ticker.js', '', '', true);
}

//=====================================================================
// Home Page Announcment
//=====================================================================
if (!function_exists('cs_home_announcment')) {

    function cs_home_announcment() {
        global $cs_theme_options;
        $announcment_title = $cs_theme_options['cs_announcment_title'] <> '' ? $cs_theme_options['cs_announcment_title'] : '';
        $announcment_cat = $cs_theme_options['cs_announcment_cat'] <> '' ? $cs_theme_options['cs_announcment_cat'] : '';
        $announcment_count = $cs_theme_options['cs_announcment_count'] <> '' ? $cs_theme_options['cs_announcment_count'] : '-1';
        $cs_announcment_bgcolor = isset($cs_theme_options['cs_announcment_bgcolor']) ? $cs_theme_options['cs_announcment_bgcolor'] : '#1a1a1a';
        $cs_announcment_txtcolor = isset($cs_theme_options['cs_announcment_txtcolor']) ? $cs_theme_options['cs_announcment_txtcolor'] : '#fff';
        $args = array('post_type' => 'post', 'posts_per_page' => $announcment_count, 'post_status' => 'publish', 'order' => 'DESC');
        if (isset($announcment_cat) && $announcment_cat <> '' && $announcment_cat <> '0') {
            $announcment_category = array('category_name' => "$announcment_cat");
            $args = array_merge($args, $announcment_category);
        }
        $custom_query = new WP_Query($args);
        if ($custom_query->have_posts()) {
            ?>
            <style scoped>
                ul#news-ticker li a,.ticker-wrapp h5,.ticker-controls li a{
                    color:<?php echo cs_allow_special_char($cs_announcment_txtcolor) ?> !important;
                }
            </style>
            <section class="page-section" style="background:<?php echo cs_allow_special_char($cs_announcment_bgcolor); ?>">
                <div class="announcement-ticker" style="background:<?php echo cs_allow_special_char($cs_announcment_bgcolor); ?>">
                    <div class="container">
                        <div class="row">
                            <div class="section-fullwidth">
                                <div class="element-size-100">
                                    <div class="col-md-12">
                                        <div class="ticker-wrapp">
                                                <?php
                                                if ($announcment_title <> '') {
                                                    echo '<h5><i class="icon-newspaper4"></i>' . $announcment_title . ' :</h5>';
                                                }
                                                ?>

                                            <ul id="news-ticker" class="news-ticker">
            <?php
            cs_enqueue_newsticker();
            echo '<script>
												jQuery(document).ready(function(){
													fn_jsnewsticker("news-ticker",10,80);
												});
											</script>';
            while ($custom_query->have_posts()) : $custom_query->the_post();
                ?>
                                                    <li>
                                                        <a href="<?php the_permalink(); ?>"><span><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?></span> - <?php the_title(); ?></a>
                                                    </li>
            <?php endwhile;
            wp_reset_query();
            ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
                <?php
            }
        }

    }

// Next Previous Links
    if (!function_exists('cs_next_prev_post')) {

        function cs_next_prev_post() {
            global $post;
            posts_nav_link();
            // Don't print empty markup if there's nowhere to navigate.
            $previous = ( is_attachment() ) ? get_post($post->post_parent) : get_adjacent_post(false, '', true);
            $next = get_adjacent_post(false, '', false);
            if (!$next && !$previous)
                return;
            ?>
        <aside class="cs-post-sharebtn">
        <?php
        previous_posts_link('%link', '<i class="icon-angle-left"></i>');
        next_posts_link('%link', '<i class="icon-angle-right"></i>');
        ?>
        </aside>
        <?php
    }

}


		  function modify_menu() {

			global $submenu;

			$submenu['custompage'][1][2] = 'http://chimpgroup.com/support';
			$submenu['custompage'][2][2] = 'http://chimpgroup.com/crm/index.php/quotation';
			$submenu['custompage'][3][2] = 'http://chimpgroup.com/wp-demo/documentation/documentation/goalklub-theme-guide/';

		}



