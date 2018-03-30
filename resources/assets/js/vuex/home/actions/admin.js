import * as types from 'store/types';
export const SidebarToggle = ({commit})=>{
    commit(types.ADMIN_TOGGLE);
};
export const getUploadImg = ({commit},payload)=>{
  commit(types.GET_UPLOAD_IMG,payload);
}
