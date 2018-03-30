import {includes} from 'lodash'
export const hasRoles = (roles,data)=>{
    return includes(roles,data)?true:false;
};
export const hasPermission = (permission,data)=>{
    return includes(permission,data)?true:false;
};