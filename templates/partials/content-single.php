<?php while (have_posts()) : the_post(); ?>
<?php
global $Schema;
$Schema->make_blog_posting();
?>
<article class="entry card" data-page-id="<?= get_the_ID(); ?>">
<template v-if="title">
  <header>
    <h1 class="entry-title">{{title}}</h1>
    <?php get_template_part('partials/entry/meta'); ?>
  </header>
  <?= get_the_post_thumbnail(null, 'full', ['class' => 'eyecatch']); ?>
  <section class="entry-content"></section>
  <?php get_template_part('partials/entry/amazon_product'); ?>
  <footer>
    <?php get_template_part('partials/entry/paginated'); ?>
    <?php get_template_part('partials/entry/breadcrumb'); ?>
    <?php get_template_part('partials/entry/tag'); ?>
    <?php Kiku\Components\the_share(); ?>
  </footer>
</template>
<template v-else>
  <?php get_template_part('partials/placeholder/single'); ?>
</template>
</article>
<?php endwhile; ?>
