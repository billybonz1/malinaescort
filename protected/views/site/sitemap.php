<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Максим
 * Date: 29.08.13
 * Time: 17:22
 * To change this template use File | Settings | File Templates.
 * Revision: Slavikk07
 * LastMod: 19.04.19
 */
 
	header("Content-type: text/xml");
	echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

<url>
	<loc><?= $domen; ?></loc>
	<changefreq>weekly</changefreq>
	<lastmod><?= date('Y-m-d\TH:i:sP'); ?></lastmod>
	<priority>1.0</priority>
</url>


	<?php if ($articles) { ?>
		<?php foreach ($articles as $article) { ?>
			<url>
				<loc><?= strtolower($article->getLink()); ?></loc>
				<changefreq>weekly</changefreq>
				<lastmod><?= date('Y-m-d\TH:i:sP'); ?></lastmod>
				<priority>1.0</priority>
			</url>
		<?php } ?>
	<?php } ?>

	<?php if ($profiles) { ?>
		<?php foreach ($profiles as $profile) { ?>
				<url>
					<loc><?= $profile['url']; ?></loc>
					<changefreq>weekly</changefreq>
					<lastmod><?= date('Y-m-d\TH:i:sP', strtotime($profile['added'])); ?></lastmod>
					<priority>1.0</priority>
				</url>
		<?php } ?>
	<?php } ?>

	<?php if ($services) { ?>
		<?php foreach ($services as $service) { ?>
			<url>
				<loc><?= strtolower($service->getLink()); ?></loc>
				<changefreq>weekly</changefreq>
				<lastmod><?= date('Y-m-d\TH:i:sP'); ?></lastmod>
				<priority>1.0</priority>
			</url>
		<?php } ?>
	<?php } ?>

</urlset>