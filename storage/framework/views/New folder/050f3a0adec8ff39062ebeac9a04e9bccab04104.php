	<!-- Standard SEO -->
	<?php if(isset($title)): ?>
		<title><?php echo e($title); ?></title>
	<?php endif; ?>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="referrer" content="<?php echo e(!empty($referrer)? $referrer : config('meta.referrer')); ?>">
	<meta name="robots" content="<?php echo e(!empty($robots)? $robots : config('meta.robots')); ?>">
	<meta name="description" content="<?php echo e(!empty($description)? $description : config('meta.description')); ?>">
	<meta name="keywords" content="<?php echo e(!empty($keywords)? $keywords : config('meta.keywords')); ?>">
	<?php if(config('meta.geo_region') !==''): ?>
	<meta name="geo.region" content="<?php echo e(config('meta.geo_region')); ?>">
	<?php endif; ?>
	<?php if(config('meta.geo_position') !==''): ?>
	<meta name="geo.position" content="<?php echo e(config('meta.geo_position')); ?>">
	<meta name="ICBM" content="<?php echo e(config('meta.geo_position')); ?>">
	<?php endif; ?>
	<meta name="geo.placename" content="<?php echo e(config('app.name')); ?>">


	<!-- Dublin Core basic info -->
	<meta name="dcterms.Format" content="text/html">
	<meta name="dcterms.Language" content="<?php echo e(config('app.locale')); ?>">
	<meta name="dcterms.Identifier" content="<?php echo e(url()->current()); ?>">
	<meta name="dcterms.Relation" content="<?php echo e(config('app.name')); ?>">
	<meta name="dcterms.Publisher" content="<?php echo e(config('app.name')); ?>">
	<meta name="dcterms.Type" content="text/html">
	<meta name="dcterms.Coverage" content="<?php echo e(url()->current()); ?>">
	<meta name="dcterms.Title" content="<?php echo e(!empty($title)? $title : config('meta.title')); ?>">
	<meta name="dcterms.Subject" content="<?php echo e(!empty($keywords)? $keywords : config('meta.keywords')); ?>">
	<meta name="dcterms.Contributor" content="<?php echo e(!empty($author)? $author : config('meta.author')); ?>">
	<meta name="dcterms.Description" content="<?php echo e(!empty($description)? $description : config('meta.description')); ?>">


	<!-- Facebook OpenGraph -->
	<meta property="og:locale" content="<?php echo e(config('app.locale')); ?>">
	<meta property="og:type" content="<?php echo e(!empty($type)? $type : config('meta.type')); ?>">
	<meta property="og:url" content="<?php echo e(url()->current()); ?>">
	<meta property="og:title" content="<?php echo e(!empty($title)? $title : config('meta.title')); ?>">
	<meta property="og:description" content="<?php echo e(!empty($description)? $description : config('meta.description')); ?>">
	<meta property="og:image" content="<?php echo e(!empty($image)? $image : config('meta.image')); ?>">
	<meta property="og:site_name" content="<?php echo e(config('app.name')); ?>">

	<?php if(config('meta.fb_app_id') !==''): ?>
	<meta property="fb:app_id" content="<?php echo e(config('meta.fb_app_id')); ?>"/>
	<?php endif; ?>

	<!-- Twitter Card -->
	<?php if(config('meta.twitter_card') !==''): ?>
	<meta name="twitter:card" content="<?php echo e(!empty($twitter_card)? $twitter_card : config('meta.twitter_card')); ?>">
	<?php endif; ?>
	<?php if(config('meta.twitter_site') !=='' || !empty($twitter_site)): ?>
	<meta name="twitter:site" content="<?php echo e(!empty($twitter_site)? $twitter_site : config('meta.twitter_site')); ?>">
	<?php endif; ?>
	<meta name="twitter:title" content="<?php echo e(!empty($title)? $title : config('meta.title')); ?>">
	<meta name="twitter:description" content="<?php echo e(!empty($description)? $description : config('meta.description')); ?>">
	<meta name="twitter:image" content="<?php echo e(!empty($image)? $image : config('meta.image')); ?>">

<?php /**PATH /home/mumar/Projects/openfraudcart/vendor/davmixcool/laravel-meta-manager/src/views/manager.blade.php ENDPATH**/ ?>