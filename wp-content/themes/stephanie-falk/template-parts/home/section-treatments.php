

<section class="section text-center"
        id="treatments-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="post-content">
                    <div class="section-title">
                        <h1>Behandlingar</h1>
                    </div>
                </div>
                <div class="treatments">
                    <?php 
                        $param = array(
                            'limit' => -1,
                            'orderby' => 'date DESC'
                        );
                        $treatments = pods('behandling', $param);
                        if (0 < $treatments->total()) {
                            while ($treatments->fetch()) {
                                ?>
                                <div class="treatment">
                                    <h2 class="treatment-name">
                                        <?php echo $treatments->field('post_title'); ?>
                                    </h2>
                                    <h3 class="treatment-price"><?php echo $treatments->field('pris'); ?>kr</h3>
                                </div>
                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

