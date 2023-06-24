<script setup>
import { ref, reactive } from "vue";
import useLines from "@/composables/useLines";
import CreateLineModal from "../components/CreateLineModal.vue";
import EditLineModal from "../components/EditLineModal.vue";

const { lines, getLines, saveLine, updateLine, deleteLine, isLoading } = useLines();

const createFormVisible = ref(false);
const editFormVisible = ref(false);
const form = reactive({
    name: "",
    short_name: "",
    max_in_lineup: "",
});
const editForm = reactive({});

const editLine = (line) => {
    editForm.id = line.id;
    editForm.name = line.name;
    editForm.short_name = line.short_name;
    editForm.max_in_lineup = line.max_in_lineup;
    editFormVisible.value = true;
};

const update = async () => {
    try {
        await updateLine(editForm);
        editFormVisible.value = false;
    } catch {}
};

const save = async () => {
    try {
        await saveLine(form);
        createFormVisible.value = false;
    } catch {}
}

getLines();
</script>

<template>
    <!-- Form -->
    <el-button @click="createFormVisible = true" type="primary">
        Add new line
    </el-button>

    <EditLineModal
        :is-visiable="editFormVisible"
        :form="editForm"
        @confirm="update"
        @cancel="editFormVisible = false"
    />

    <CreateLineModal
        :is-visiable="createFormVisible"
        :form="form"
        @confirm="save"
        @cancel="createFormVisible = false"
    />

    <el-scrollbar>
        <el-table :data="lines" v-loading="isLoading">
            <el-table-column prop="id" label="#" width="140" />
            <el-table-column prop="name" label="Name" width="120" />
            <el-table-column prop="short_name" label="Short name" />
            <el-table-column prop="max_in_lineup" label="Max. in Lineup" />
            <el-table-column fixed="right" label="Operations">
                <template #default="scope">
                    <el-button
                        type="primary"
                        size="small"
                        @click="editLine(scope.row)"
                        >Edit</el-button
                    >
                    <el-popconfirm
                        width="250"
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
