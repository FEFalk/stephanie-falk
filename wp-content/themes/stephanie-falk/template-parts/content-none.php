        <div class="container">
            <div class="row">
                <div class="post-content">
                    <br class="clear" />
                    <br class="clear" />

                    <h1><?php echo __('No entries found!', 'yoga'); ?></h1>
                    <?php if(is_search()): ?>
                        <h5><?php echo __('Try searching with a different keyword.', 'yoga'); ?></h5>
                    <?php else: ?>
                        <p><?php echo __('Try a search instead', 'yoga'); ?>:</p>
                        <?php get_search_form(); ?>
                    <?php endif; ?>
                    <br class="clear" />
                    <br class="clear" />
                </div>
            </div>
        </div>