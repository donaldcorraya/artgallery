<form id="range_filter" method="GET">
    <div class="form-row d-flex mb-4 gap-2">
        <div class="form-group col-md-6">
            <label>{{ __('messages.Min') }}</label>
            <input name="min" class="form-control" value="100" placeholder="$0" type="number">
            <input name="page" class="form-control" value="1" type="hidden">
        </div>
        <div class="form-group text-right col-md-6">
            <label>{{ __('messages.Max') }}</label>
            <input name="max" id="max" class="form-control" min="100" max="50000" value="<?= isset($_GET['max']) ? $_GET['max'] : '';; ?>" placeholder="$1,0000" type="number">
        </div>
    </div>
    <button type="submit" class="btn">{{ __('messages.Filter') }}</button>
</form>