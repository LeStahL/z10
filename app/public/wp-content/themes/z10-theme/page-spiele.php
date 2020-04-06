<?php

get_header();

pageBanner(); ?>

  <div class="container container--narrow page-section">	

  	<?php 
    get_template_part('template-parts/content', 'metabox');
    get_template_part('template-parts/content-sidemenu'); ?>
  	

  	<p>Ihr könnt die Spiele bei uns im Café ausleihen und spielen - nahezu 200 Spiele und Erweiterungen stehen euch dazu zur Verfügung, darunter auch alle Spiele des Jahres. Um Spiele aus dem Spieleschrank zu erhalten, fragt einfach beim Ausschänker nach. Ihr habt herausgefunden, dass ein Teil fehlt? Dann teilt es uns mit, damit wir Ersatz besorgen können :) .</p>
  	<hr class="section-break">
  	<h2 class="headline headline--small-plus">Liste der Spiele</h2>
  	<?php

  	$table = get_field( 'spiele' );

		if ( ! empty ( $table ) ) {

		    echo '<table border="2" cellspacing="0" cellpadding="20">';

		        if ( ! empty( $table['caption'] ) ) {

		            echo '<caption>' . $table['caption'] . '</caption>';
		        }

		        if ( ! empty( $table['header'] ) ) {

		            echo '<thead>';

		                echo '<tr>';

		                    foreach ( $table['header'] as $th ) {

		                        echo '<th>';
		                            echo $th['c'];
		                        echo '</th>';
		                    }

		                echo '</tr>';

		            echo '</thead>';
		        }

		        echo '<tbody>';

		            foreach ( $table['body'] as $tr ) {

		                echo '<tr>';

		                    foreach ( $tr as $td ) {

		                        echo '<td>';
		                            echo $td['c'];
		                        echo '</td>';
		                    }

		                echo '</tr>';
		            }

		        echo '</tbody>';

		    echo '</table>';
		} ?>





	</div>

  <?php get_footer(); 

  ?>