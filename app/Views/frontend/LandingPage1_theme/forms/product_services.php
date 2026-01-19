<?php
    foreach($product_services as $service):
?>
        <option value='<?=$service['service_id']?>'><?=$service['name']?></option>
<?php
    endforeach
?>