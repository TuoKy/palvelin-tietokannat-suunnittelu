<div class="container">		
<?php

$tiedot = $dbTouch->kayttajan_postaukset($_SESSION['manageUserId']);	
echo "<h2>Postaukset</h2>";
foreach($tiedot as $rivi)
{
    echo "<div class='content'>";
    echo "<a href='index.php?page=showPost&post={$rivi['idPostaus']}'>{$rivi['otsikko']}</a>";
    echo "{$rivi['sisalto']}  Kirjoittaja:{$rivi['idKayttaja']} <br> Luotu: {$rivi['luontiAika']}<br> Muokattu: {$rivi['muokattu']} ";
    echo "</div>";
}
?> <br> <?php
$tiedot = $dbTouch->kayttajan_kommentit($_SESSION['manageUserId']);
echo "<h2>Kommentit</h2>";
foreach($tiedot as $rivi)
{
    $output = <<<OUTPUTEND
             <li>
			 <div class='content'>\n			
             {$rivi['otsikko']}
			 <br>\n
			 {$rivi['sisalto']}
			 <br>\n
			 {$rivi['idKayttaja']}
			 <br>\n
			 {$rivi['luontiAika']}
			 <br>\n
			 {$rivi['muokattu']}			
			 </div>
			 
OUTPUTEND;
		echo $output;
}			
?>					
</div>