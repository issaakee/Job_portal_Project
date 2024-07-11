<?php if(file_exists(APPPATH.'controllers/admin/booking.php')):?>
<div class="col-6 clearfix form-group-data" >
    <div class="row" >
        <div class="col-sm-6">
            <div class="form-group field_select field_select_booking_date_from">
                <label for="booking_date_from" class="control-label text-color-secondary"><?php _l('Fromdate'); ?></label>
                <input id="booking_date_from" type="text" class="form-control" value="<?php echo search_value('date_from'); ?>"  placeholder="<?php _l('Fromdate'); ?>" autocomplete="off" />
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group field_select field_select_booking_date_to">
                <label for="booking_date_to" class="control-label text-color-secondary"><?php _l('Todate'); ?></label>
                <input id="booking_date_to" type="text" class="form-control" value="<?php echo search_value('date_to'); ?>"  placeholder="<?php _l('Todate'); ?>" autocomplete="off" />
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
