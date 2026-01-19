<script>
    let added_extra = <?= $added_extra ?? 1 ?>;
    function addExtraItem()
    {
        extra_id = 'extra_'+added_extra;
        field =
        `<div class="input-group my-2" id="${extra_id}">
            <div style="flex: 1;">
                <input type="text" name="items[]" maxlength="255" id="items" class="form-control" placeholder="<?=lang('Site.item')?>" required>
            </div>
            <div style="flex: 1;">
                <input type="number" name="prices[]" id="prices" class="form-control" placeholder="<?=lang('Site.amount')?>" required>
            </div>
            <div class="input-group-append">
                <span class="input-group-text" onclick="removeExtraItem('${extra_id}')"><i class="fas fa-trash text-danger cusor"></i></span>
            </div>
        </div>`;

        $("#extra_item").append(field);

        added_extra++;
    }

    function removeExtraItem(field_id)
    {
        $('#'+field_id).remove();
    }
</script>