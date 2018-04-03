<div class="stm_single_event__panel tbc">
    <div class="stm_flex stm_flex_center stm_flex_last">
        <div class="stm_single_event__categories">
            <?php
            $terms = event_get_terms_array(
                get_the_ID(),
                'event_category',
                'name',
                true,
                array('class' => 'wtc mtc_h no_deco')
            );
            ?>
            <span class="stm_mf"><?php echo implode(' ', $terms); ?></span>
            <span class="wtc stm_mf"><?php echo implode(', ', $terms); ?></span>
        </div>
        <div class="stm_single_event__share">
            <?php stm_motors_events_load_template('content/post/single/_share'); ?>
        </div>
    </div>
</div>