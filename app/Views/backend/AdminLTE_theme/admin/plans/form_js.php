<script>
    let added_extra = <?= $added_extra ?? 1 ?>;
    function addExtraFeature()
    {
        extra_id = 'extra_'+added_extra;
        field =
        `<div class="input-group mt-1" id="${extra_id}">
            <input type="text" name="features[]" class="form-control" placeholder="<?=lang('Site.feature')?>" value="" required>
            <div class="input-group-append">
                <span class="input-group-text" onclick="removeExtraFeature('${extra_id}')"><i class="fas fa-trash text-danger cusor"></i></span>
            </div>
         </div>`;

        $("#extra_feature").append(field);

        added_extra++;
    }

    function removeExtraFeature(field_id)
    {
        $('#'+field_id).remove();
    }
</script>