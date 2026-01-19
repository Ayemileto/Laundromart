<?php

    function permissions()
    {
        if(isSuperAdmin())
        {
            return "all";
        }
        
        if(isStaff())
        {
            $StaffRoleModel       = new \App\Models\StaffRoleModel;
            $role = $StaffRoleModel->where("user_id", userId())->first();
            
            if(empty($role["role_id"]))
            {
                return null;
            }
            
            $role_id = $role["role_id"];
            $cacheName = "Role_".$role_id."_permissions";

            //CHECK IF A PERMISSION CACHE EXIST FOR THIS ROLE AND RETURN IT.
            if(!$rolecache = cache($cacheName))
            {
                $RolesPermissionsModel = new \App\Models\RolesPermissionsModel();
                $PermissionsModel      = new \App\Models\PermissionsModel();
                $permissions =  $PermissionsModel->select("name")
                                    ->whereIn("id", function($PermissionsModel)
                                        use($role_id) {
                                            return $PermissionsModel
                                                ->select("permission_id")
                                                ->from('roles_permissions')
                                                ->where("role_id", $role_id);
                                        }
                                    )
                                    ->get()->getResultArray();
                
                $permissions = array_column($permissions, 'name') ?? [];

                cache()->save($cacheName, $permissions,  86400);
                return $permissions;
            }

            return $rolecache;
        }
        
        return null;
    }

    function has_permission($permission)
    {
        $permissions = permissions();

        if($permissions === "all")
        {
            return true;
        }

        if(is_array($permissions) && in_array($permission, $permissions, true))
        {
            return true;
        }

        return false;
    }