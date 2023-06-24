<script setup>
import { ref, reactive } from "vue";
import axios from "axios";
import useLines from "@/composables/useLines";

const { deleteLine, getLines, lines } = useLines();

const dialogFormVisible = ref(false);
const form = reactive({
    name: "",
    short_name: "",
});

const saveLine = () => {
    axios
        .post("api/lines", form)
        .then(() => {
            dialogFormVisible.value = false;
            ElNotification({
                title: "Success",
                message: "Line was saved successfully!",
                type: "success",
            });
            getLines();
        })
        .catch(({ response }) => {
            ElNotification({
                title: "Error",
                message: response.data.message,
                type: "error",
            });
        });
};

getLines();
</script>

<template>
    <!-- Form -->
    <el-button @click="dialogFormVisible = true" type="primary">
        Add new line
    </el-button>

    <el-dialog v-model="dialogFormVisible" title="Add new line">
        <el-form :model="form">
            <el-form-item label="Name" label-width="140px">
                <el-input v-model="form.name" autocomplete="off" />
            </el-form-item>
            <el-form-item label="Short Name" label-width="140px">
                <el-input v-model="form.short_name" autocomplete="off" />
            </el-form-item>
        </el-form>
        <template #footer>
            <span class="dialog-footer">
                <el-button @click="dialogFormVisible = false">Cancel</el-button>
                <el-button type="primary" @click="saveLine">
                    Confirm
                </el-button>
            </span>
        </template>
    </el-dialog>

    <el-scrollbar>
        <el-table :data="lines">
            <el-table-column prop="id" label="#" width="140" />
            <el-table-column prop="name" label="Name" width="120" />
            <el-table-column prop="short_name" label="Short name" />
            <el-table-column fixed="right" label="Operations">
                <template #default="scope">
                    <el-button type="primary" size="small">Edit</el-button>
                    <el-popconfirm
                        width="250"
                        confirm-button-text="OK"
                        cancel-button-text="No, Thanks"
                        :icon="InfoFilled"
                        icon-color="#ff5e5e"
                        title="Are you sure you want to delete this?"
                        @confirm="deleteLine(scope.row.id)"
                    >
                        <template #reference>
                            <el-button type="danger" size="small"
                                >Delete</el-button
                            >
                        </template>
                    </el-popconfirm>
                </template>
            </el-table-column>
        </el-table>
    </el-scrollbar>
</template>
