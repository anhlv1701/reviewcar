<div class="stm_single_event__panel tbc">
    <div class="stm_flex stm_flex_center stm_flex_last">
        <div class="stm_single_event__categories">
            <?php
            $terms = motors_get_terms_array(
                get_the_ID(),
                'event_category',
                'name',
                true,
                array('class' => 'wtc mtc_h no_deco')
            );
            ?>
            <i class="stmicon-tag2 __icon icon_20px mtc"></i>
            <span class="wtc stm_mf"><?php echo implode(', ', $terms); ?></span>
        </div>
        <div class="stm_single_event__share">
            <?php stm_motors_events_load_template('content/post/single/_share'); ?>
        </div>
    </div>
</div>