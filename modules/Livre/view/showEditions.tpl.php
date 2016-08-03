<?php
foreach ($model->infos['editions'] AS $edition) {
	echo "\n\t".'<p>'.$edition->infos['titre'].' ('.$edition->infos['nbpage'].')<br />'.$edition->infos['langname'].'<br />'.$edition->infos['formatname'].'</p>';
}
