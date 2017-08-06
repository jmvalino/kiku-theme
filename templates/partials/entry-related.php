<section v-cloak v-if="relateds">
  <h2 class="related-heading">Related Posts</h2>
  <div class="entry-related">
    <div class="related-container" v-for="(related,index) in relateds">
      <a v-bind:href="related.uri">
        <div class="related-title">{{ related.title }}</div>
        <div class="related-description">{{ related.description }}</div>
      </a>
    </div>
  </div>
</section>