<?php

$variables = [
	'HOME_EXCERPT_LENGTH' => 45,  // طول خلاصه پست های صفحه اصلی
	'HOME_GRID_CAT_ID' => 8562,  // آیدی دسته بندی گریدویو
	'HOME_POSTS_CAT_ID' => 209,  // آیدی دسته بندی نوشته ها
	'HOME_POSTS_PER_PAGE' => 5 , // تعداد پست در هر صفحه
	'DONATE_PAGE_SLUG' => 'donations'  // اسلاگ برگه حمایت مالی
];

foreach ($variables as $key => $value) {
	putenv("$key=$value");
}