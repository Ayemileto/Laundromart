<?=view('includes/css/table')?>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?=$title?></h3>
                            <?php
                                if(has_permission('add_page')):
                            ?>
                                <a href="<?=fullUrl(route_to('admin_route_create_page'))?>" class="btn btn-primary float-right"><?=lang('Site.create_page')?></a>
                            <?php
                                endif;
                            ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped use-datatable">
                                <thead>
                                    <tr>
                                        <th><?=lang('Site.name')?></th>
                                        <th><?=lang('Site.title')?></th>
                                        <th><?=lang('Site.menu')?></th>
                                        <th><?=lang('Site.status')?></th>
                                        <th><?=lang('Site.actions')?></th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
    foreach($pages as $page):
        $page_id     = $page['id'];
        $menu = $page['top_menu'] == 'yes'?lang('Site.top'): '';

        if($page['bottom_menu'] == 'yes')
        {
            if(!empty($menu))
            {
                $menu.= ', '.lang('Site.bottom');
            }
            else
            {
                $menu = lang('Site.bottom');
            }
        }
?>
                                    <tr>
                                        <td>
                                            <a href="<?=fullUrl(route_to('page', $page['slug']))?>" target="_blank" data-toggle="tooltip" title="<?=lang('Site.view_page')?>">
                                                <?=$page['name']?>
                                            </a>
                                        </td>
                                        <td><?=$page['title']?></td>
                                        <td><?=$menu?></td>
                                        <td><?=lang('Site.'.$page['status'])?></td>
                                        <td>
                                            <a href="<?=fullUrl(route_to('page', $page['slug']))?>" target="_blank" data-toggle="tooltip" title="<?=lang('Site.view_page')?>">
                                                <i class='fas fa-eye'></i>
                                            </a>
<?php
    if(has_permission('update_page')):
?>
                                            <a href="<?=fullUrl(route_to('admin_route_edit_page', $page_id))?>" class="mx-1" data-toggle="tooltip" title="<?=lang('Site.edit_page')?>">
                                                <i class='fas fa-pen'></i>
                                            </a>
<?php
    endif;
    if(has_permission('delete_page')):
?>
                                            <a href="#" id='delete_page_<?=$page_id?>' class="mx-1" onclick="confirmModal('<?=fullUrl(route_to('admin_route_delete_page', $page_id))?>', this.id, true, '', 'tr', 'btn-danger')" data-toggle="tooltip" title="<?=lang("Site.delete_page")?>"><i class='fas fa-trash text-danger'></i></a>
<?php
    endif;
?>
                                        </td>
                                    </tr>
<?php
    endforeach;
?>

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <?=$pager->links()?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?=view('includes/js/table')?>
<?=view('includes/js/modal')?>