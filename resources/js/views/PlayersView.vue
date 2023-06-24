<script setup>
import { ref, reactive } from "vue";
import usePlayers from "@/composables/usePlayers";
import CreatePlayerModal from "@/components/CreatePlayerModal.vue";
import EditPlayerModal from "@/components/EditPlayerModal.vue";

const { players, getPlayers, savePlayer, updatePlayer, deletePlayer, isLoading } = usePlayers();

const createFormVisible = ref(false);
const editFormVisible = ref(false);

const form = reactive({
    name: "",
    shirt_number: "",
    line_id: "",
    in_lineup: false,
});

const editForm = ref({});

const save = async () => {
    try {
        await savePlayer(form);
        createFormVisible.value = false;
    } catch {}
}

const update = async () => {
    try {
        await updatePlayer(editForm.value);
        editFormVisible.value = false;
    } catch {}
}

const edit = (player) => {
    editFormVisible.value = true;
    editForm.value = player;
};

getPlayers();
</script>

<template>
    <!-- Form -->
    <el-button @click="createFormVisible = true" type="primary">
        Add new player
    </el-button>

    <EditPlayerModal
        :is-visiable="editFormVisible"
        :form="editForm"
        @cancel="editFormVisible = false"
        @confirm="update"
    />

    <CreatePlayerModal
        :is-visiable="createFormVisible"
        :form="form"
        @cancel="createFormVisible = false"
        @confirm="save"
    />

    <el-scrollbar>
        <el-table :data="players" v-loading="isLoading">
            <el-table-column prop="id" label="#" />
            <el-table-column prop="name" label="Name" />
            <el-table-column prop="shirt_number" label="Shirt Number" />
            <el-table-column label="Line">
                <template #default="scope">
                    {{ scope.row.line.name }}
                </template>
            </el-table-column>
            <el-table-column label="In Lineup?">
                <template #default="scope">
                    <el-tag
                        class="ml-2"
                        type="success"
                        v-if="scope.row.in_lineup"
                        >Yes</el-tag
                    >
                    <el-tag
                        class="ml-2"
                        type="error"
                        v-else="scope.row.in_lineup"
                        >No</el-tag
                    >
                </template>
            </el-table-column>
            <el-table-column fixed="right" label="Actions" width="300">
                <template #default="scope">
                    <el-button
                        type="primary"
                        size="small"
                        @click="edit(scope.row)"
                        >Edit</el-button
                    >
                    <el-popconfirm
                        width="250"
                        confirm-button-text="OK"
                        cancel-button-text="No, Thanks"
                        icon-color="#ff5e5e"
                        title="Are you sure you want to delete this?"
                        @confirm="deletePlayer(scope.row.id)"
                    >
                        <template #reference>
                            <el-button type="danger" size="small">
                                Delete
                            </el-button>
                        </template>
                    </el-popconfirm>
                </template>
            </el-table-column>
        </el-table>
    </el-scrollbar>
</template>
