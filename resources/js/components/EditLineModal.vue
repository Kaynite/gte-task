<script setup>
    import { defineProps } from 'vue';

    defineProps({
        isVisiable: Boolean,
        form: Object
    })
</script>

<template>
    <el-dialog v-model="isVisiable" title="Edit Line">
        <el-form :model="form">
            <el-form-item label="Name" label-width="140px">
                <el-input v-model="form.name" autocomplete="off" />
            </el-form-item>
            <el-form-item label="Short Name" label-width="140px">
                <el-input v-model="form.short_name" autocomplete="off" />
            </el-form-item>
            <el-form-item label="Max. in Lineup" label-width="140px">
                <el-input type="number" v-model="form.max_in_lineup" autocomplete="off" />
            </el-form-item>
        </el-form>
        <template #footer>
            <span class="dialog-footer">
                <el-button @click="$emit('cancel')">Cancel</el-button>
                <el-button type="primary" @click="$emit('confirm')">
                    Update
                </el-button>
            </span>
        </template>
    </el-dialog>
</template>
