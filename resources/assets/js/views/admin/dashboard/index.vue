<template>
    <div class="dashboard-container">
        <EditorDashboard></EditorDashboard>
    </div>
</template>

<script>
    // import { mapGetters } from 'vuex';
    import EditorDashboard from './editor/index';
    export default {
      name: 'dashboard',
      components: { EditorDashboard }
    }
</script>
