<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td><strong><?=lang('Site.profile_picture')?></strong></td>
                        <td><img src='<?=getUserImg($user['avatar'])?>' height='75' width='75'></td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Auth.firstname')?></strong></td>
                        <td><?=$user['firstname']?></td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Auth.lastname')?></strong></td>
                        <td><?=$user['lastname']?></td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Auth.username')?></strong></td>
                        <td><?=$user['username']?></td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Auth.email')?></strong></td>
                        <td><?=$user['email']?></td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Auth.phone')?></strong></td>
                        <td><?=$user['phone']?></td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Site.status')?></strong></td>
                        <td><?=lang('Site.'.$user['status'])?></td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Site.is_banned')?></strong></td>
                        <td><?=lang('Site.'.$user['is_banned'])?></td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Site.is_staff')?></strong></td>
                        <td><?=lang('Site.'.$user['is_staff'])?></td>
                    </tr>
                    <tr>
                        <td><strong><?=lang('Site.is_superadmin')?></strong></td>
                        <td><?=lang('Site.'.$user['is_superadmin'])?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>