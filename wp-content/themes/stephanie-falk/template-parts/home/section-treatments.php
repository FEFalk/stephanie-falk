<?php
$page = get_page_by_path('behandlingar');
?>
<section class="section text-center"
        id="treatments-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="post-content">
                    <div class="section-title">
                        <h1><?php echo $page->post_title;?></h1>
                    </div>
                    <div class="section-content">
                        <p><?php echo $page->post_content;?></p>
                    </div>
                </div>
                <div class="treatments">
                    <?php 
                        $param = array(
                            'limit' => -1,
                            'orderby' => 'date DESC'
                        );
                        $treatments = pods('behandling', $param);
                        $categories = array();
                        //check that total values (given limit) returned is greater than zero
                        if ( $treatments->total() > 0 ) {
                            //loop through items pods:fetch acts like the_post()
                            while ($treatments->fetch() ) {
                                $treatmentCategories = get_the_category($treatments->get_field('id'));

                                foreach($treatmentCategories as $cat){
                                    $categories[] = $cat->name;
                                }
                            }
                        }

                        $categories = array_unique($categories);

                        foreach($categories as $category){
                            ?>
                            <ul class="category-prices col-md-6">
                            <h2 class="category-name">
                                <?php
                                echo $category;
                                ?>
                            </h2>
                            <?php


                            $treatments->reset();
                            //check that total values (given limit) returned is greater than zero
                            if ( $treatments->total() > 0 ) {
                                //loop through items pods:fetch acts like the_post()
                                while ($treatments->fetch() ) {
                                    if(get_the_category($treatments->field('id'))[0]->name == $category)
                                    {
                                        ?>
                                        <li class="treatment">
                                            <h3 class="treatment-name">
                                                <?php echo $treatments->field('post_title'); ?>
                                            </h2>
                                            <p class="treatment-price"><?php echo $treatments->field('pris'); ?>kr</p>
                                        </li>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            </ul>
                            <?php
                        }
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

