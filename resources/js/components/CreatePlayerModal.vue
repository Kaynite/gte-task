<script setup>
    import useLines from "@/composables/useLines";
    import { defineProps } from 'vue';
    const { lines, getLines } = useLines();

    defineProps({
        isVisiable: Boolean,
        form: Object
    })

    getLines();
</script>

<template>
    <el-dialog v-model="isVisiable" title="Add new player">
        <el-form :model="form">
            <el-form-item label="Name" label-width="140px">
                <el-input v-model="form.name" autocomplete="off" />
            </el-form-item>
            <el-form-item label="Shirt Number" label-width="140px">
                <el-input v-model="form.shirt_number" autocomplete="off" />
            </el-form-item>
            <el-form-item label="Line" label-width="140px">
                <el-select
                    v-model="form.line_id"
                    class="m-2"
                    style="width: 100%;"
                    placeholder="Select"
                >
                    <el-option
                        v-for="line in lines"
                        :key="line.id"
                        :label="line.name"
                        :value="line.id"
                    />
                </el-select>
            </el-form-item>
            <el-form-item label="In lineup?" label-width="140px">
                <el-switch v-model="form.in_lineup" />
            </el-form-item>
        </el-form>
        <template #footer>
            <span class="dialog-footer">
                <el-button @click="$emit('cancel')">Cancel</el-button>
                <el-button type="primary" @click="$emit('confirm')">
                    Confirm
                </el-button>
            </span>
        </template>
    </el-dialog>
</template>
