<article class="mdl-cell mdl-cell--4-col card-container mdl-card mdl-color--white" title="<?php the_title(); ?>">
  <header class="mdl-card__title">
    <h2 class="entry-title mdl-card__title-text">
      <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
      </a>
    </h2>
  </header>
  <div class="entry-summary mdl-card__supporting-text mdl-card--expand">
    <?php the_excerpt(); ?>
  </div>
  <div class="mdl-card__supporting-text">
    <?php if (get_post_type() === 'post') { get_template_part('partials/entry-meta'); } ?>
  </div>
</article>
