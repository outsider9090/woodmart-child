<?php

$variables = [
	'DONATE_PAGE_SLUG' => 'DONATE_PAGE_SLUG'
];

foreach ($variables as $key => $value) {
	putenv("$key=$value");
}
?>